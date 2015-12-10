    <form method="POST" action="/user/login" class="form" id="user-login-form">
        {!! csrf_field() !!}

        <div>
            {{ trans('User::user.mail')}}
            <input type="email" name="email" value="{{ old('email') }}">
        </div>

        <div>
            {{ trans('User::user.password')}}
            <input type="password" name="password" id="password">
        </div>

        <div>
            <input value="{{ trans('User::user.login')}}" type="submit">  <input type="checkbox" name="remember"> {{ trans('User::user.rememberme')}}
        </div>

    </form>