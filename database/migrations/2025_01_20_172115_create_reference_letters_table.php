<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reference_letters', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('sender_email');
            $table->string('receiver_email');
            $table->text('reference_letter')->nullable();
            $table->string('message', 2000)->nullable();
            $table->string('token')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reference_letters');
    }
};
