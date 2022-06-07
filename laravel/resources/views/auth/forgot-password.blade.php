<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>renitialiser mot de passe</h1>

    <form action="{{route('password.email')}}" method="POST">
    @csrf
    @if (session('status'))
        <div>
            {{ session('status') }}
        </div>
    @endif

        <input type="email" name="email" placeholder="email">
        @error('email')
            <span>{{$message}}</span>
        @enderror

        <br> <br>
        <button type="submit">Envoyer</button>
    </form>
</body>
</html>
