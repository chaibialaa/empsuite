<script>
    $(document).ready(function(){
        $('[data-toggle="popover"]').popover();
    });
</script>
@if (!Auth::check())
    <form role=form method='POST' action='/user/login'>
        {!! csrf_field() !!}
        <a class="" data-toggle="popover" data-placement="bottom" data-html="true" data-content="


                                    <input placeholder=Email  required type='email'  name='email'  />
                            <input placeholder='Password' required type='password' name='password' id='password'/>
                            <button type='submit' class='btn btn-default btn-block'><i class='fa fa-user'></i> Sign in
                            </button>
                            <a href='/user/social/google' type='submit' class='btn btn-danger btn-block'><i
                                        class='fa fa-google'></i> Sign in using Google</a>
                            <a href='/user/social/facebook' type='submit' class='btn btn-primary btn-block'
                               style='background-color: rgb(41, 93, 138); !important'><i class='fa fa-facebook-square'></i>
                                Sign in using Facebook
                            </a>



                                <a href='/user/'>Register</a> - <a href='/user/forgot'>Forgot Password</a>
                            "><i class='fa fa-user'></i> Login
        </a>
    </form>
@else

    <a href="/user/logout"><i class="fa fa-power-off danger"></i> Deconnexion</a>

@endif