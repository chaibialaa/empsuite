<script>
    $(function () {
        $("#datenaissance").datepicker({
            format: 'yyyy-mm-dd'
        });
    });
</script>
<form method="POST" action="/user/register" enctype="multipart/form-data" class="form" id="user-registration-form">
    {!! csrf_field() !!}

    <div style="padding: 0px !important;">
        <div style="float:left;width: 50%;padding-right: 15px;">
            Nom
            <input type="text" name="nom" value="{{ old('nom') }}">
        </div>
        <div style="float:right;width: 50%;padding-left: 15px;">
            Date de Naissance
            <input type="text" name="datenaissance" value="{{ old('datenaissance') }}" id="datenaissance"
                   data-date-format="yyyy-mm-dd">
        </div>
        <div style="float:left;"></div>
    </div>
    <div>
        Email
        <input type="email" name="email" value="{{ old('email') }}">
    </div>

    <div>
        Image
        <input type="file" name="imagepath" accept="image/*"/>
    </div>

    <div style="padding: 0px !important;">
        <div style="float:left;width: 50%;padding-right: 15px;">
            Password
            <input type="password" name="password">
        </div>
        <div style="float:right;width: 50%;padding-left: 15px;">
            Confirm Password
            <input type="password" name="password_confirmation">
        </div>
        <div style="float:left;"></div>
    </div>

    <div>
        <input value="create an account" type="submit">
    </div>
</form>
