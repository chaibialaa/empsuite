<div class="row">
    <div class="col-md-12">
        <form method="post" action="">
            <h3>Join a class</h3>

                @foreach($classList as $class)
                {{ $class->level_title }}
                    <input name="class[]" type="checkbox"
                           value="{{ $class->id }}">{{$class->title}}
                @endforeach

            <button type="submit">Submit</button>
            <button type="reset">Reset</button>
        </form>
    </div>
</div>