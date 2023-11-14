<!DOCTYPE html>
<html>
    <head>
        Welcome Manager
    </head>
    <body>
        <h1>Welcome to our App </h1>
        <p>Hi {{$managers->prenom}} {{$managers->nom}} </p>
        <p>Your Login Details</p>
        <p>Email : {{$managers->email}}</p>
        <p>password :{{$managers->password}}</p>
        <a href="{{ route('login') }}" style="display:inline-block; background-color: #4CAF50; color: white;">Go To Login</a>
    </body>
</html>