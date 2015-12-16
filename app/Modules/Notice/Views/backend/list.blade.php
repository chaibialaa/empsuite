<script>
    $(document).ready(function() {
        $('#notices').DataTable();
    } );
</script>

        <div class="row">
            <div class="col-md-9">
                <div class="panel panel-default ">
                    <div class="panel-body">
                        @if((isset($notices)) and (count($notices)>0))

                        <table id="notices" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>

                                <th>Title</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Author</th>
                                <th>Edit</th>
                                <th>Delete</th>

                                <th>Ending at</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Author</th>
                                <th>Edit</th>
                                <th>Delete</th>

                                <th>Ending at</th>
                            </tr>
                            </tfoot>
                            <tbody>


                                    @foreach($notices as $notice)
                                        <tr>
                                <td>{{$notice->title }}</td>
                                <td>{{$notice->title_cat}}</td>
                                <td>@if($notice->status != 1)
                                    <form method="POST" action="/admin/notice/publish/{{$notice->id}}">{!! csrf_field() !!}
                                        <button type="submit" class="btn btn-block btn-xs btn-success btn-flat">Publish Now</button>
                                    </form>
                                        @else
                                        <form method="POST" action="/admin/notice/holdon/{{$notice->id}}">{!! csrf_field() !!}
                                            <button type="submit" class="btn btn-block btn-xs  btn-default btn-flat">Put On Hold</button>
                                        </form>
                                        @endif
                                    </td>
                                <td>{{$notice->nom}}</td>
                                <td><form method="get" action="/admin/notice/edit/{{$notice->id}}" target="_blank">
                                        <button type="submit" class="btn btn-block btn-xs btn-primary btn-flat">Edit</button>
                                    </form>
                                    </td><td>
                                    <form method="POST" action="/admin/notice/delete/{{$notice->id}}">{!! csrf_field() !!}
                                        <button type="submit" class="btn btn-block btn-xs btn-danger btn-flat">Delete</button>
                                    </form></td>

                                <td>{{$notice->end_at }}</td>
                                        </tr>
                                    @endforeach



                            </tbody></table>@endif
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <a href="/admin/notice/category/" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> Add new category</a>

                <a href="/admin/notice/add" class="btn  btn-primary btn-block"><i class="fa fa-plus"></i> Add new notice</a>
            </div>
        </div>
