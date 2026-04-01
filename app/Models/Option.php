<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Question;

class Option extends Model
{
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    protected $fillable = [
        'question_id', 'text', 'is_correct'
    ];
}