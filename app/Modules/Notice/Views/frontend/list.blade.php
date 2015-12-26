@if((isset($notices)) and (count($notices)>0))
    @foreach($notices as $notice)


            <div class="row">
                <div class="col-xs-2"><img class="img-thumbnail" src="{{ $notice->thumbpath }}" ></div>

                    <div class="col-xs-10">
                        <div class="row">
                            <div><h3><a href="{{ url('/').'/notice/'.$notice->title_cat.'/'.$notice->id.'/'.$notice->link  }}">
                                        {{ $notice->title }}</a></h3></div>
                            <div>
                                <small><p><span class="glyphicon glyphicon-time"></span> Posted
                                        on {{$notice->created_at}} <span
                                                class="glyphicon glyphicon-user"></span> by <a
                                                href="#"></a>{{$notice->nom}} <span
                                                class="glyphicon glyphicon-list-alt"></span><a href="{{ url('/').'/notice/'.$notice->title_cat}}">{{$notice->title_cat}}</a>
                                </small>
                            </div>


                                @if (strlen(strip_tags($notice->content))>300)
                                    <div>
                                        {{
                                        $stringCut = substr(strip_tags($notice->content), 0, 300),

                                        $notice->content = substr($stringCut, 0, strrpos($stringCut, ' '))
                                        }} ...
                                        <a href="{{ url('/').'/notice/'.$notice->title_cat.'/'.$notice->id.'/'.$notice->link  }}">read
                                            more</a>
                                    </div>
                                @else
                                    <div>
                                        {{ strip_tags($notice->content) }}
                                    </div>
                                @endif



                        </div>
                    </div>

            </div>

    @endforeach
@endif
{!! $notices->render() !!}