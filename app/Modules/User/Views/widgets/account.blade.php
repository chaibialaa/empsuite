<div class="col-md-12" >

    <div>
        <div class="panel panel-default">

            <div class="panel-body">
                <div align="center">
                    <img class="img-circle img-responsive" src="{{ Auth::user()->imagepath }}" style="height: 120px;width: 120px;">
                </div>

                <div  >
                    <hr>
                    <strong>{{ trans('User::user.mail')}}</strong> : {{ Auth::user()->email }}
                    </div>

                <div  >
                    <hr>
                    <strong>Nom</strong> : {{ Auth::user()->nom }}
                </div>

                <div  >
                    <hr>
                    <strong>Member Since</strong> : {{ Auth::user()->created_at }}
                </div>

                <div>
                    <form method="GET" action="/user/logout" id="user-logout-form">
                        <button type="submit" class="btn btn-block btn-danger"><i class="fa fa-power-off"></i> logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

        </div>
        </div>
</div>