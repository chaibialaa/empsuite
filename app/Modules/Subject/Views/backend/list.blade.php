<script>
$(document).ready(function() {
$('#modules').DataTable();
$('#subjects').DataTable();
} );
</script>
@if(((isset($mList)) and (count($mList)>0)) or ((isset($sList)) and (count($sList)>0)) )
    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-default ">
                <div class="panel-heading">

                    <h3 class="panel-title"><i class="fa fa-list"></i> Modules List </h3>
                </div>
                <div class="panel-body">
                    <table id="modules" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>

                            <th>Module</th>
                            <th>Rename</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Module</th>
                            <th>Rename</th>
                            <th>Delete</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($mList as $m)
                            <tr>
                                <td>{{$m->title}}</td>
                                <td><a class="btn btn-block btn-xs btn-success btn-flat">
                                        Rename
                                    </a></td>
                                <td><a class="btn btn-block btn-xs btn-success btn-flat">
                                        Delete
                                    </a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

            <div class="panel panel-default ">
                <div class="panel-heading">

                    <h3 class="panel-title"><i class="fa fa-list"></i> Subjects List </h3>
                </div>
                <div class="panel-body">
                    <table id="subjects" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>

                            <th>Subject</th>
                            <th>Rename</th>
                            <th>Delete</th>

                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Subject</th>
                            <th>Rename</th>
                            <th>Delete</th>

                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($sList as $s)
                            <tr>
                                <td>{{$s->title}}</td>
                                <td><a class="btn btn-block btn-xs btn-success btn-flat">
                                        Rename
                                    </a></td>
                                <td><a class="btn btn-block btn-xs btn-success btn-flat">
                                        Delete
                                    </a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <div class="col-md-3">
            <a href="/admin/subject/subjectModule" class="btn btn-primary btn-block"><i class="fa fa-cogs"></i> Manage Modules Subjects</a>
            <a href="/admin/subject/classModule" class="btn btn-primary btn-block"><i class="fa fa-cogs"></i> Manage Classes Modules</a>
            <br>

            <div class="panel panel-default ">
                <div class="panel-heading">

                    <h3 class="panel-title"><i class="fa fa-plus"></i> Add new module</h3>
                </div>
                <div class="panel-body">
                    <form method="POST" action="/admin/subject/module/add" id="level-add-form">
                        {!! csrf_field() !!}
                        <div class="input-group">

                            <input class="form-control" name="title" type="text">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-success">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="panel panel-default ">
                <div class="panel-heading">

                    <h3 class="panel-title"><i class="fa fa-plus"></i> Add new subject </h3>
                </div>
                <div class="panel-body">
                    <form method="POST" action="/admin/subject/add" id="level-add-form">
                        {!! csrf_field() !!}
                        <div class="input-group">

                            <input class="form-control" name="title" type="text">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-success">Add</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>
        </div>
@else
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default ">
                <div class="panel-heading">

                    <h3 class="panel-title"><i class="fa fa-plus"></i> Add new subject</h3>
                </div>
                <div class="panel-body">
                    <form method="POST" action="/admin/subject/add" id="level-add-form">
                        {!! csrf_field() !!}
                        <div class="input-group">

                            <input class="form-control" name="title" type="text">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-success">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="panel panel-default ">
                <div class="panel-heading">

                    <h3 class="panel-title"><i class="fa fa-plus"></i> Add new module</h3>
                </div>
                <div class="panel-body">
                    <form method="POST" action="/admin/subject/module/add" id="level-add-form">
                        {!! csrf_field() !!}
                        <div class="input-group">

                            <input class="form-control" name="title" type="text">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-success">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endif