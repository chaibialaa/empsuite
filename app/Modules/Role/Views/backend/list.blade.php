<script>
    $(document).ready(function() {
        $('#roles').DataTable();

    } );
</script>

<div class="row">
    <div class="col-md-9">
        <div class="panel panel-default ">
            <div class="panel-body">
                @if((isset($roles)) and (count($roles)>0))

                    <table id="roles" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>

                        <tfoot>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </tfoot>

                        <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td>{{$role->name }}</td>
                                <td>{{$role->description }}</td>
                                <td class="text-center"><form method="get" action="/admin/role/edit/{{$role->id}}" target="_blank">
                                        <button type="submit" class="btn btn-flat btn-info btn-xs"><i class="fa fa-edit"></i></button>
                                    </form>
                                </td><td class="text-center">
                                    <form method="POST" action="/admin/role/delete/{{$role->id}}">{!! csrf_field() !!}
                                        <button type="submit" class="btn btn-flat btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <a href="/admin/role/add" class="btn  btn-primary btn-block"><i class="fa fa-plus"></i> Add new role</a>
    </div>
</div>
