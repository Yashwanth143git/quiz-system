<!DOCTYPE html>
<html>
<head>
    <title>Add Questions</title>
</head>
<body style="font-family: Arial; padding:20px;">

<h2>Add Questions to: {{ $quiz->title }}</h2>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<form method="POST" action="/quiz/{{ $quiz->id }}/questions">
    @csrf

    <div style="border:1px solid #ccc; padding:15px; margin-bottom:20px;">
        
        <label>Question:</label><br>
        <textarea name="question_text" style="width:100%; height:80px;"></textarea><br><br>

        <label>Question Type:</label><br>
        <select name="type">
            <option value="binary">Binary (Yes/No)</option>
            <option value="single">Single Choice</option>
            <option value="multiple">Multiple Choice</option>
            <option value="text">Text</option>
            <option value="number">Number</option>
        </select><br><br>

        <label>Marks:</label><br>
        <input type="number" name="marks" value="1"><br><br>

        <label>Options (for MCQ):</label><br>
        <input type="text" name="options[]"><br>
        <input type="text" name="options[]"><br>
        <input type="text" name="options[]"><br>
        <input type="text" name="options[]"><br><br>

        <label>Correct Answer:</label><br>
        <input type="text" name="correct_answer"><br><br>

        <button type="submit">Add Question</button>

    </div>

</form>

</body>
</html>