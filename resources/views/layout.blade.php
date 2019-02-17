<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Primeiro argumento é a section e o segundo é um default caso não haja section -->
    <title>@yield('title', 'Laravel by Laracasts')</title>
</head>
<body>
    @yield('content')

    <ul>
        <li><a href="">Home</a></li>
        <li><a href="about">About Us</a></li>
        <li><a href="contact">Contact</a></li>
    </ul>
</body>
</html>