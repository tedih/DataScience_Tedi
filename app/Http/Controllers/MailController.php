<?php

namespace App\Http\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\EmailLog; // Add this to interact with the email_logs table

class MailController extends Controller
{
    public function Email(Request $request)
    {
        $sender_email = $request->input('sender_email');
        $receiver_email = $request->input('receiver_email');

        // Ensure both sender and receiver email addresses are provided
        if (!$sender_email || !$receiver_email) {
            return redirect()
                ->route('send.email.view')
                ->with('error', 'Both sender and receiver email addresses are required.');
        }

        try {
            // Generate a secure token
            $token = Str::random(32);

            // Initialize PHPMailer
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = env('MAIL_HOST', 'smtp.gmail.com');
            $mail->SMTPAuth = true;
            $mail->Username = env('MAIL_USERNAME'); // Your Gmail email
            $mail->Password = env('MAIL_PASSWORD'); // App-specific password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = env('MAIL_PORT', 587);

            // Set sender and recipient
            $mail->setFrom(env('MAIL_FROM_ADDRESS', 'default@example.com'), env('MAIL_FROM_NAME', 'Your App Name'));
            $mail->addAddress($receiver_email);

            // Generate the tokenized secure link
            $url = url('/submit/' . $token);

            // Email content
            $mail->isHTML(true);
            $mail->Subject = 'Reference Letter Invitation';
            $mail->Body = "
                <p>Dear $receiver_email,</p>
                <p>You have been invited by $sender_email to submit a reference letter. Please click the secure link below to complete the process:</p>
                <p><a href='$url'>Submit Reference Letter</a></p>
                <p>This link is valid for 24 hours.</p>
                <p>Best regards,<br>Your Company Name</p>
            ";

            // Send email and log result in the database
            if ($mail->send()) {
                // Log success and insert record in database
                Log::info('Email sent successfully to ' . $receiver_email);

                // Save the email status to the database
                EmailLog::create([
                    'sender_email' => $sender_email,
                    'receiver_email' => $receiver_email,
                    'status' => 'sent',
                    'error_message' => null, // No error message if sent successfully
                ]);

                return redirect()
                    ->route('send.email.view')
                    ->with('success', 'Email sent successfully!');
            } else {
                // Log failure and send error message
                Log::error('Failed to send email: ' . $mail->ErrorInfo);

                // Save the failure status to the database
                EmailLog::create([
                    'sender_email' => $sender_email,
                    'receiver_email' => $receiver_email,
                    'status' => 'failed',
                    'error_message' => $mail->ErrorInfo,
                ]);

                return redirect()
                    ->route('send.email.view')
                    ->with('error', 'Failed to send the email: ' . $mail->ErrorInfo);
            }
        } catch (Exception $e) {
            // Log exception and send error message
            Log::error("Error sending email: " . $e->getMessage());

            // Save the exception details to the database
            EmailLog::create([
                'sender_email' => $sender_email,
                'receiver_email' => $receiver_email,
                'status' => 'failed',
                'error_message' => $e->getMessage(),
            ]);

            return redirect()
                ->route('send.email.view')
                ->with('error', 'An error occurred while sending the email: ' . $e->getMessage());
        }
    }
}
