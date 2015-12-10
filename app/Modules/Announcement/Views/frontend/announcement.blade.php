<h1>{{$announcement->title}}</h1>
<hr>
<p><span class="glyphicon glyphicon-time"></span> Posted on {{$announcement->created_at}} <span
            class="glyphicon glyphicon-user"></span> by <a href="#">{{$user->nom}}</a> <span class="glyphicon glyphicon-list-alt"></span><a href="{{ url('/').'/announcement/'.$category}}">{{ $category }}</a>

</p>
<hr>
<p class="lead">{!! $announcement->content !!}</p>
<hr>
<div id="share"></div>
<script>
    $("#share").jsSocials({
        url: "{{ Request::url() }}",
        text: "{{$announcement->title}}",
        showCount: true,
        showLabel: true,
        shares: [
            {share: "twitter", via: "artem_tabalin", hashtags: "search,google"},
            "facebook",
            "googleplus",
            "linkedin",
            "pinterest"
        ]
    });
</script>
@if ($announcement->comments == 1)
    <script>
        var disqus_config = function () {
            this.language = "{{ Config::get('app.locale') }}";
        };

    </script>
    <div id="disqus_thread"></div>
    <script src="{{ asset("/assets/libraries/disqus/disqus.js") }}"></script>
@endif