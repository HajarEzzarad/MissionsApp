<!DOCTYPE html>
<html>
    <head>
        Accepter Votre Registration
    </head>
    <body>
        <h1>Bienvenue Dans Notre App</h1>
        <p>Bonjour {{$client->prenom}} {{$client->nom}} </p>
        <p>Détails de votre Login</p>
        <p>Email : {{$client->email}}</p>
        <p>password :{{$password}}</p>
        <a href="{{ route('login') }}" style="display:inline-block; background-color: #4CAF50; color: white;">Go To Login</a>
    </body>
</html>