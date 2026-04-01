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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();

            // relation to quiz
            $table->foreignId('quiz_id')->constrained()->onDelete('cascade');

            // type of question
            $table->string('type'); // binary, single, multiple, number, text

            // question content
            $table->text('question_text');

            // media support
            $table->string('image_path')->nullable();
            $table->string('video_url')->nullable();

            // marks
            $table->integer('marks')->default(1);

            // for text/number answers
            $table->text('correct_answer')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
