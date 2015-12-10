<script>
    $(document).ready(function() {
        $('#announcements').DataTable();
    } );
</script>

        <div class="row">
            <div class="col-md-9">
                <div class="panel panel-default ">
                    <div class="panel-body">
                        @if((isset($announcements)) and (count($announcements)>0))

                        <table id="announcements" class="table table-striped table-bordered" cellspacing="0" width="100%">
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


                                    @foreach($announcements as $announcement)
                                        <tr>
                                <td>{{$announcement->title }}</td>
                                <td>{{$announcement->title_cat}}</td>
                                <td>@if($announcement->status != 1)
                                    <form method="POST" action="/admin/announcement/publish/{{$announcement->id}}">{!! csrf_field() !!}
                                        <button type="submit" class="btn btn-block btn-xs btn-success btn-flat">Publish Now</button>
                                    </form>
                                        @else
                                        <form method="POST" action="/admin/announcement/holdon/{{$announcement->id}}">{!! csrf_field() !!}
                                            <button type="submit" class="btn btn-block btn-xs  btn-default btn-flat">Put On Hold</button>
                                        </form>
                                        @endif
                                    </td>
                                <td>{{$announcement->nom}}</td>
                                <td><form method="get" action="/admin/announcement/edit/{{$announcement->id}}" target="_blank">
                                        <button type="submit" class="btn btn-block btn-xs btn-primary btn-flat">Edit</button>
                                    </form>
                                    </td><td>
                                    <form method="POST" action="/admin/announcement/delete/{{$announcement->id}}">{!! csrf_field() !!}
                                        <button type="submit" class="btn btn-block btn-xs btn-danger btn-flat">Delete</button>
                                    </form></td>

                                <td>{{$announcement->end_at }}</td>
                                        </tr>
                                    @endforeach



                            </tbody></table>@endif
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <a href="/admin/announcement/category/" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> Add new category</a>

                <a href="/admin/announcement/add" class="btn  btn-primary btn-block"><i class="fa fa-plus"></i> Add new announcement</a>
            </div>
        </div>
