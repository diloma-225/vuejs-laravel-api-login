<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{route('password.update')}}" method="post">

        @csrf
        @if (session('status'))
            <div>
                {{ session('status') }}
            </div>
        @endif
        <input type="hidden" name="token" value="{{$request->token}}">

        <input type="email" name="email" value="{{$request->email}}"> <br><br>
        <input type="password" name="password" id="" placeholder="nouveau mot de passe">
            @error('password')
                {{$message}}
            @enderror
        <br><br>
        <input type="password" name="password_confirmation" placeholder="confirmation mot de passe"> <br><br>
        <button>Envoyer</button>
    </form>
</body>
</html>
