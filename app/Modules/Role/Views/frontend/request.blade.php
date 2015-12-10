<div class="row">
    <div class="col-md-12">
    @if ($requested == 0)
        <div>
            <form action="/user/role/request" method="post">
                {!! csrf_field() !!}
            <label>Join a role to gain special abilities</label>
            @foreach($roleList as $role)
            <input name="roles[]" type="checkbox" value="{{ $role->id }}">{{$role->display_name}}
            @endforeach
            <textarea name="additional_infos">Any additional infos will be good</textarea>
            <button  class="btn btn-default" type="submit">Send Request</button>
            </form>
        </div>
        @elseif ($requested > 0)
            <div>The role(s) you requested are being validated. Please wait</div>
    @endif
    </div>
</div>
