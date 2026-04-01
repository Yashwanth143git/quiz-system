<!DOCTYPE html>
<html>
<head>
    <title>Attempt Quiz</title>
</head>
<body style="font-family: Arial; padding:20px;">

<h2>{{ $quiz->title }}</h2>
<p>{{ $quiz->description }}</p>

<form method="POST" action="/quiz/{{ $quiz->id }}/submit">
    @csrf

    @foreach($quiz->questions as $q)
        <div style="border:1px solid #ccc; padding:10px; margin-bottom:15px;">
            <p><b>{{ $q->question_text }}</b></p>

            @if($q->type == 'single' || $q->type == 'binary')
                @foreach($q->options as $opt)
                    <input type="radio" name="answers[{{ $q->id }}]" value="{{ $opt->id }}">
                    {{ $opt->text }}<br>
                @endforeach

            @elseif($q->type == 'multiple')
                @foreach($q->options as $opt)
                    <input type="checkbox" name="answers[{{ $q->id }}][]" value="{{ $opt->id }}">
                    {{ $opt->text }}<br>
                @endforeach

            @elseif($q->type == 'text')
                <input type="text" name="answers[{{ $q->id }}]">

            @elseif($q->type == 'number')
                <input type="number" name="answers[{{ $q->id }}]">
            @endif
        </div>
    @endforeach

    <button type="submit">Submit Quiz</button>
</form>

</body>
</html>