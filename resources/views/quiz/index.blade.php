<!DOCTYPE html>
<html>
<head>
    <title>All Quizzes</title>
</head>
<body>

<h2>All Quizzes</h2>

@foreach($quizzes as $quiz)
    <div style="border:1px solid black; margin:10px; padding:10px;">
        <h3>{{ $quiz->title }}</h3>
        <p>{{ $quiz->description }}</p>
    </div>
@endforeach

</body>
</html>