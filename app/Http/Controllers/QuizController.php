<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Option;
use App\Models\Attempt;
use App\Models\Answer;

class QuizController extends Controller
{
    public function create()
    {
        return view('quiz.create');
    }

    public function store(Request $request)
    {
        Quiz::create([
            'title' => $request->title,
            'description' => $request->description
        ]);

        return "Quiz Saved!";
    }

    public function index()
    {
        $quizzes = Quiz::all();
        return view('quiz.index', compact('quizzes'));
    }

    public function addQuestions($id)
    {
        $quiz = Quiz::with('questions.options')->findOrFail($id);
        return view('quiz.add_questions', compact('quiz'));
    }

    public function storeQuestion(Request $request, $id)
    {
        $question = Question::create([
            'quiz_id' => $id,
            'type' => $request->type,
            'question_text' => $request->question_text,
            'marks' => $request->marks,
            'correct_answer' => $request->correct_answer
        ]);

        if ($request->options) {
            foreach ($request->options as $opt) {
                if ($opt) {
                    Option::create([
                        'question_id' => $question->id,
                        'text' => $opt,
                        'is_correct' => ($opt == $request->correct_answer)
                    ]);
                }
            }
        }

        return back()->with('success', 'Question Added!');
    }

    public function attempt($id)
    {
        $quiz = Quiz::with('questions.options')->findOrFail($id);
        return view('quiz.attempt', compact('quiz'));
    }

    public function submitQuiz(Request $request, $id)
    {
        $quiz = Quiz::with('questions.options')->findOrFail($id);

        $score = 0;

        // create attempt
        $attempt = Attempt::create([
            'quiz_id' => $id,
            'score' => 0
        ]);

        foreach ($quiz->questions as $q) {

            $userAnswer = $request->answers[$q->id] ?? null;

            // save answer
            Answer::create([
                'attempt_id' => $attempt->id,
                'question_id' => $q->id,
                'answer' => is_array($userAnswer) ? json_encode($userAnswer) : $userAnswer
            ]);

            // evaluation
            if ($q->type == 'single' || $q->type == 'binary') {
                $correct = $q->options->where('is_correct', true)->first();
                if ($correct && $correct->id == $userAnswer) {
                    $score += $q->marks;
                }
            }

            elseif ($q->type == 'multiple') {
                $correct = $q->options->where('is_correct', true)->pluck('id')->toArray();
                sort($correct);
                $user = $userAnswer ?? [];
                sort($user);

                if ($correct == $user) {
                    $score += $q->marks;
                }
            }

            elseif ($q->type == 'text' || $q->type == 'number') {
                if ($q->correct_answer == $userAnswer) {
                    $score += $q->marks;
                }
            }
        }

        $attempt->update(['score' => $score]);

        return "Your Score: " . $score;
    }
}