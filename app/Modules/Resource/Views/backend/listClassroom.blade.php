    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-default ">
                <div class="panel-heading">

                    <h3 class="panel-title"><i class="fa fa-list"></i> Classroom List </h3>
                </div>
                <div class="panel-body">
                    <table id="modules" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Classroom</th>
                            <th>Status</th>
                            <th>N° of Places</th>
                            <th>Rename</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Classroom</th>
                            <th>Status</th>
                            <th>N° of Places</th>
                            <th>Rename</th>
                            <th>Delete</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($crList as $cr)
                            <tr>
                                <td>{{$cr->title}}</td>
                                <td>{{$cr->status_title}}</td>
                                <td>{{$cr->places}}</td>
                                <td>
                                    <button type="button"
                                            class="btn btn-flat btn-danger btn-xs"><i
                                                class="fa fa-edit"></i></button>
                                </td>
                                <td>
                                    <button type="button"
                                            class="btn btn-flat btn-danger btn-xs"><i
                                                class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default ">
                <div class="panel-heading">

                    <h3 class="panel-title"><i class="fa fa-plus"></i> Add new classroom</h3>
                </div>
                <div class="panel-body">
                    <form method="POST" action="/admin/resource/classroom/add" id="level-add-form">
                        {!! csrf_field() !!}
                        <label>Title :</label>
                        <input class="form-control" name="coef" type="text">

                        <label>Status :</label>
                        <select name="status" class="form-control">
                            @foreach($crsList as $s)
                                <option value="{{ $s->id }}">{{$s->title}}</option>
                            @endforeach
                        </select>

                        <label>Places :</label>
                        <input class="form-control" name="places" type="text">
                        <br/>
                        <button type="submit" class="btn btn-success btn-flat btn-block">Attach</button>


                    </form>
                </div>
            </div>
        </div>
    </div>

