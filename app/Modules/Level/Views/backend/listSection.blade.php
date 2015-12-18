<div class="row">
        <script>
            $(document).ready(function() {
                $('#sections').DataTable();
            } );
        </script>
        <div class="col-md-9">
            <div class="panel panel-default ">
                <div class="panel-body">

                    <table id="sections" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>

                            <th>Section</th>
                            <th>Rename</th>
                            <th>Delete</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Section</th>
                            <th>Rename</th>
                            <th>Delete</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                        </tr>
                        </tfoot>
                        <tbody>


                        @foreach($sList as $s)
                            <tr>
                                <td>{{$s->title}}</td>
                                <td class="text-center">
                                    <button type="button"
                                            class="btn btn-flat btn-info btn-xs"><i
                                                class="fa fa-edit"></i> Rename</button>
                                </td>
                                <td class="text-center">
                                    <button type="button"
                                            class="btn btn-flat btn-danger btn-xs"><i
                                                class="fa fa-trash"></i> Delete</button>
                                </td>
                                <td>{{$s->created_at }}</td>
                                <td>{{$s->updated_at }}</td>

                            </tr>
                        @endforeach



                        </tbody></table>

                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-default ">
                <div class="panel-heading">


                    <h3 class="panel-title"><i class="fa fa-plus"></i> Add new section</h3>

                </div>
                <div class="panel-body">



                    <form method="POST" action="/admin/level/section/add">

                        <div class="input-group">

                            {!! csrf_field() !!}
                            <input class="form-control" name="title" type="text">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-success">Add</button>
                            </div>

                        </div></form>




                </div>
            </div>

        </div>
</div>


