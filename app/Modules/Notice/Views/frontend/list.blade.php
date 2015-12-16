@if((isset($announcements)) and (count($announcements)>0))
    @foreach($announcements as $announcement)


            <div class="row">
                <div class="col-xs-2"><img class="img-thumbnail" src="{{ $announcement->thumbpath }}" ></div>

                    <div class="col-xs-10">
                        <div class="row">
                            <div><h3><a href="{{ url('/').'/announcement/'.$announcement->title_cat.'/'.$announcement->id.'/'.$announcement->link  }}">
                                        {{ $announcement->title }}</a></h3></div>
                            <div>
                                <small><p><span class="glyphicon glyphicon-time"></span> Posted
                                        on {{$announcement->created_at}} <span
                                                class="glyphicon glyphicon-user"></span> by <a
                                                href="#"></a>{{$announcement->nom}} <span
                                                class="glyphicon glyphicon-list-alt"></span><a href="{{ url('/').'/announcement/'.$announcement->title_cat}}">{{$announcement->title_cat}}</a>
                                </small>
                            </div>


                                @if (strlen(strip_tags($announcement->content))>300)
                                    <div>
                                        {{
                                        $stringCut = substr(strip_tags($announcement->content), 0, 300),

                                        $announcement->content = substr($stringCut, 0, strrpos($stringCut, ' '))
                                        }} ...
                                        <a href="{{ url('/').'/announcement/'.$announcement->title_cat.'/'.$announcement->id.'/'.$announcement->link  }}">read
                                            more</a>
                                    </div>
                                @else
                                    <div>
                                        {{ strip_tags($announcement->content) }}
                                    </div>
                                @endif



                        </div>
                    </div>

            </div>

    @endforeach
@endif
{!! $announcements->render() !!}