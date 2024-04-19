

<body>
@foreach($users as $user) 
<ul>
    <li>{{$user->nom }}</li>
</ul>
</body>
@endforeach