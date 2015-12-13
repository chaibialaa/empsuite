<script>
    $(document).ready(function () {

        var table2 = $('#uo').DataTable();
        @foreach($uoList as $user)
            $('#uo tbody').on('click', '#affect-{{$user->id }}', function () {
                    var tr = $(this).closest('tr');
                    var row = table2.row(tr);
                    if (row.child.isShown()) {
                        row.child.hide();
                        tr.removeClass('shown');
                    } else {
                        row.child(uoaffect{!! $user->id !!} ()).show();
                        tr.addClass('shown');
                    }
                });
        @endforeach

        var table = $('#uh').DataTable();
        @foreach($uhList as $user)
            $('#uh tbody').on('click', '#affect-{{$user->id }}', function () {
                    var tr = $(this).closest('tr');
                    var row = table.row(tr);
                    if (row.child.isShown()) {
                        row.child.hide();
                        tr.removeClass('shown');
                    } else {
                        row.child(uhaffect{!! $user->id !!} ()).show();
                        tr.addClass('shown');
                    }
                });
        @endforeach


    });
</script>
<div class="row">
    <div class="col-md-9">
        <div class="panel panel-danger ">
            <div class="panel-heading"><i class="fa fa-bell"></i> Users Requesting Roles</div>
            <div class="panel-body">

                <table id="uh" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>

                        <th>User</th>
                        <th>eMail</th>
                        <th>Roles</th>

                        <th>Requested Roles</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>

                        <th>User</th>
                        <th>eMail</th>
                        <th>Roles</th>

                        <th>Requested Roles</th>
                    </tr>
                    </tfoot>
                    <tbody>


                    @foreach($uhList as $user)
                        <tr>

                            <td><img src="{{$user->imagepath}}" class="img-circle" width="20px"> {{$user->nom}}</td>
                            <td>{{$user->email}}</td>
                            <td id="affect-{{$user->id }}" class=" details-control"><a
                                        class="btn btn-block btn-xs btn-success btn-flat">
                                    Affect
                                </a>
                                <script>
                                    function uhaffect{!! $user->id !!} () {
                                        return  '<form method="POST" action="/admin/role/affect/manageRequested/{{$user->id}}">{!! csrf_field() !!}'+
                                                '<table class="table table-striped table-bordered">' +
                                                '<th width="15%">Accept/Refuse</th>'+
                                                '<th width="20%">Role Title</th>'+
                                                '<th width="30%">Role Description</th>'+
                                                '<th width="35%">Additional Informations of Request</th>'+
                                                '@foreach($rList as $role)' +
                                                '@foreach($rrList as $rr) @if (($rr->role_id == $role->id) and ($rr->user_id == $user->id))'+
                                                '<tr>' +
                                                '<td><input name="requestedRoles[]" checked type="checkbox" value="{{$role->id}}"/> '+
                                                '</td>' +
                                                '<td>{{$role->display_name}}</td>'+
                                                '<td>{{$role->description}}</td>'+
                                                '<td>@foreach($rrList as $rr) @if (($rr->role_id == $role->id) and ($rr->user_id == $user->id)) {{$rr->additional_infos}} @endif @endforeach</td>'+
                                                '</tr>' +
                                                '@endif @endforeach '+
                                                '@endforeach' +
                                                '</table>'+
                                                '<input value="Update User" type="submit" class="btn btn-primary pull-right">'+
                                                '</form>';

                                    }
                                </script>
                            </td>

                            <td>{{$user->pending_roles_count}}</td>

                        </tr>
                    @endforeach


                    </tbody>
                </table>

            </div>

        </div>

        <div class="panel panel-default ">
            <div class="panel-heading"><i class="fa fa-list"></i> Manage Users Roles</div>
            <div class="panel-body">

                <table id="uo" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>

                        <th>User</th>
                        <th>eMail</th>
                        <th>Roles</th>

                        <th>Member since</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>

                        <th>User</th>
                        <th>eMail</th>
                        <th>Roles</th>

                        <th>Member since</th>
                    </tr>
                    </tfoot>
                    <tbody>

                    @foreach($uoList as $user)
                        <tr>

                            <td><img src="{{$user->imagepath}}" class="img-circle" width="20px"> {{$user->nom}}</td>
                            <td>{{$user->email}}</td>
                            <td id="affect-{{$user->id }}" class=" details-control"><a
                                        class="btn btn-block btn-xs btn-success btn-flat">
                                    Manage
                                </a>
                                <script>
                                    function uoaffect{!! $user->id !!} () {
                                        return   '<form method="POST" action="/admin/role/affect/manageUserRoles/{{$user->id}}">{!! csrf_field() !!}'+
                                                '<table class="table table-striped table-bordered">' +
                                                '<th width="15%">Affect/Revoke</th>'+
                                                '<th width="20%">Role Title</th>'+
                                                '<th width="65%">Role Description</th>'+
                                                '@foreach($rList as $role)' +
                                                '<tr>' +
                                                '<td><input name="Roles[]" @foreach($oList as $o) @if (($o->role_id == $role->id) and ($o->user_id == $user->id))'+
                                                'checked @endif @endforeach type="checkbox" value="{{$role->id}}"/>  '+
                                                '</td>' +
                                                '<td>{{$role->display_name}}</td>'+
                                                '<td>{{$role->description}}</td>'+
                                                '</tr>' +
                                                '@endforeach' +
                                                '</table>'+
                                                '<input value="Update User" type="submit" class="btn btn-primary pull-right">'+
                                                '</form>';
                                    }
                                </script>
                            </td>
                            <td>{{$user->created_at}}</td>


                        </tr>
                    @endforeach


                    </tbody>
                </table>

            </div>

        </div>
    </div>
    <div class="col-md-3">
        Button manage roles
    </div>
</div>

