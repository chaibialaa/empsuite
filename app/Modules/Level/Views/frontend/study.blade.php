<div class="row">
    <div class="col-md-12">
        <form method="post" action="">
            <h3>Join a class</h3>
            <select name="class">

                @foreach($classList as $class)
                <optgroup label="{{ $class->level_title }}">
                <option></option>
                </optgroup>
                @endforeach

            </select>
            <button type="submit">Submit</button>
            <button type="reset">Reset</button>
        </form>
    </div>
</div>