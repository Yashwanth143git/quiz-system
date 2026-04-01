<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();

            // which attempt
            $table->foreignId('attempt_id')->constrained()->onDelete('cascade');

            // which question
            $table->foreignId('question_id')->constrained()->onDelete('cascade');

            // user answer (flexible)
            $table->text('answer');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
