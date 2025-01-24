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
        Schema::create('submitted_letters', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('token')->nullable()->unique('token');
            $table->string('submitter_name');
            $table->string('student_name');
            $table->text('message')->nullable();
            $table->string('file_path');
            $table->timestamp('submitted_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submitted_letters');
    }
};
