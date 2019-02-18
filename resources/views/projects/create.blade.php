<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Create a new project:</h1>

    <form action="{{ url('projects') }}" method="POST">
        {{ csrf_field() }}
        <div>
            <input type="text" name="title" placeholder="Project Title" id="">
        </div>
        <div>
            <textarea name="description" id="" cols="30" rows="10"></textarea>
        </div>
        <div>
            <button type="submit">Create</button>
        </div>
    </form>
</body>
</html>