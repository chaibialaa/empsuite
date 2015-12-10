@if((isset($usersList)) and (count($usersList)>0))
    @foreach($usersList as $user)
       {{ $user->email }}
    @endforeach
@endif