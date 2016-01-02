@foreach ($notices as $notice)
    <p><a href="{{ url('/').'/notice/'.$notice->title_cat.'/'.$notice->id.'/'.$notice->link  }}">{{$notice->title}}</a></p>

@endforeach