<h2>{{$notice->title}}</h2>
<br>
<hr>
<p><i class="fa fa-user"></i> <a href="../../../user/profile-{{$user->id}}" target="_blank">{{$user->nom}}</a> <i class="fa fa-clock-o"></i> {{ trans('common.created_at') }} {{$notice->created_at}}  <i class="fa fa-list"></i><a href="{{ url('/').'/notice/'.$category}}"> {{ $category }}</a>

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
            {share: "twitter", via: "empsuite", hashtags: "search,google"},
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