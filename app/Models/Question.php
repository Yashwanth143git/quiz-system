<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Quiz;
use App\Models\Option; // ✅ REQUIRED

class Question extends Model
{
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }

    protected $fillable = [
        'quiz_id', 'type', 'question_text', 'marks', 'correct_answer'
    ];
}