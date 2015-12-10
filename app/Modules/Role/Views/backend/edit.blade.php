<form method="POST" action="/admin/role/edit/{{$role->id}}" enctype="multipart/form-data" class="form"
      id="role-edit-form">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default ">
                <div class="panel-body">

                    {!! csrf_field() !!}
                    <div>
                        <div>
                            <label>Name </label> <input type="text" id="name" name="name" class="form-control"
                                                        value="{{$role->name }}">
                        </div>
                    </div>
                    <div>
                        <div>
                            <label>Display Name </label> <input id="displayname" name="displayname"
                                                                class="form-control" value="{{$role->display_name }}">
                        </div>

                    </div>
                    <div>
                        <div>
                            <label>Description</label> <input id="description" name="description"
                                                              class="form-control" value="{{$role->description }}">
                        </div>

                    </div>
                    <div>
                        @foreach($permissionList as $permission)

                            <div>
                                <input name="permission[]"
                                       @foreach($permissionChecked as $permissionC)
                                       @if ($permissionC->permission_id == $permission->id) checked @endif
                                       @endforeach type="checkbox"
                                       value="{{ $permission->id }}">{{$permission->display_name}}
                            </div>

                        @endforeach
                    </div>
                    <div>
                        <input value="Update role" type="submit" class="btn btn-primary pull-right">
                    </div>

                </div>
            </div>
        </div>
    </div>
</form>