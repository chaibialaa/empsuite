<i class="fa fa-phone"></i> Switch Language :
@foreach ($languages as $l)
   <img src="{{$l->flag}}" width="30px" height="20px"/> <a href="/lang/{{$l->code}}" >{{ $l->title }}</a>
@endforeach