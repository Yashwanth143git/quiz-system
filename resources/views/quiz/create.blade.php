<!DOCTYPE html>
<html>
<head>
    <title>Create Quiz</title>
</head>
<body>

<h2>Create Quiz</h2>

<form method="POST" action="/quiz/store">
    @csrf

    <label>Title:</label><br>
    <input type="text" name="title"><br><br>

    <label>Description:</label><br>
    <textarea name="description"></textarea><br><br>

    <button type="submit">Create Quiz</button>
</form>

</body>
</html>