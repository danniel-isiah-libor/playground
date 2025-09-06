<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('register.store') }}" method="POST">
        @csrf

        <input type="text" name="name" placeholder="Name" required>

        @error('name')
            <p style="color: red;">{{ $message }}</p>
        @enderror

        <br>

        <input type="email" name="email" placeholder="Email" required>

        @error('email')
            <p style="color: red;">{{ $message }}</p>
        @enderror

        <br>

        <input type="password" name="password" placeholder="Password" required>

        @error('password')
            <p style="color: red;">{{ $message }}</p>
        @enderror

        <br>

        <input type="password" name="password_confirmation" placeholder="Confirm Password" required>

        <br>

        <button type="submit">Register</button>
    </form>
</body>
</html>
