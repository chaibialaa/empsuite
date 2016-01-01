Switch Language :
@foreach ($languages as $l)
   <a href="/lang/{{$l->code}}" ><img src="{{$l->flag}}" width="30px" height="20px" alt="{{ $l->title }}"/> </a>
@endforeach