<h1>{{$notice->title}}</h1><small> {{ trans('common.by') }} <a href="../../../user/profile-{{$user->id}}" target="_blank">{{$user->nom}}</a></small>
<hr>
<p><span class="glyphicon glyphicon-time"></span> {{ trans('common.created_at') }}{{$notice->created_at}}  <span class="glyphicon glyphicon-list-alt"></span><a href="{{ url('/').'/notice/'.$category}}">{{ $category }}</a>

</p>
<hr>
<p class="lead">{!! $notice->content !!}</p>
<hr>
<div id="share"></div>
<script>
    $("#share").jsSocials({
        url: "{{ Request::url() }}",
        text: "{{$notice->title}}",
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
@if ($notice->comments == 1)
    <script>
        var disqus_config = function () {
            this.language = "{{ Config::get('app.locale') }}";
        };

    </script>
    <div id="disqus_thread"></div>
    <script src="{{ asset("/assets/libraries/disqus/disqus.js") }}"></script>
@endif