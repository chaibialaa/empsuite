<form method="POST" action="/admin/role/add" enctype="multipart/form-data" class="form" id="role-add-form">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default ">
                <div class="panel-body">

                    {!! csrf_field() !!}

                    <div>
                        <div>
                            <label>Name </label> <input type="text" id="name" name="name" class="form-control">
                        </div>
                    </div>
                    <div>
                        <div>
                            <label>Display Name </label> <input id="displayname" name="displayname"
                                                                class="form-control">
                        </div>

                    </div>
                    <div>
                        <div>
                            <label>Description</label> <input id="description" name="description"
                                                              class="form-control">
                        </div>

                    </div>
                    <div>
                        <div>

                            @foreach($permissionList as $permission)
                                <input name="permission[]" type="checkbox"
                                       value="{{ $permission->id }}">{{$permission->display_name}}
                            @endforeach

                        </div>
                    </div>
                    <button type="submit" name="send" class="btn btn-primary pull-right">Add</button>
                </div>
            </div>
        </div>
    </div>
</form>