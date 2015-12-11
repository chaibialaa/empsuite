<div class="row">
<div class="col-md-9">
    <div class="panel panel-default ">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-plus"></i> Subjects Links to Modules</h3>
        </div>
        <div class="panel-body">
            @if((isset($cmList)) and (count($cmList)>0))
                @foreach($cmList as $cm)
                    <div class="col-md-6">
                        <div class="panel panel-default ">
                            <div class="panel-heading">
                                <i class="fa fa-tint"></i> Module : {{$cm->module_title}}
                            </div>
                            <div class="panel-body">
                                <table id="modules" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>

                                        <th>Subject</th>
                                        <th>Coefficient</th>


                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Subject</th>
                                        <th>Coefficient</th>

                                    </tr>
                                    </tfoot>
                                    <tbody>

                                    <tr>
                                        <td>{{$cm->subject_title}}</td>
                                         <td>{{$cm->coefficient}}</td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                At least one subject in a module is required !
            @endif
        </div>
    </div>

    <div class="panel panel-default ">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-plus"></i> Modules per Class  </h3>
        </div>
        <div class="panel-body">
            @if((isset($mcList)) and (count($mcList)>0))
                @foreach($mcList as $mc)
                    <div class="col-md-6">
                        <div class="panel panel-default ">
                            <div class="panel-heading">
                                {{$mc->module_title}}
                            </div>
                            <div class="panel-body">
                                <table id="modules" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>

                                        <th>Subject</th>
                                        <th>Professor</th>
                                        <th>Coefficient</th>


                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Subject</th>
                                        <th>Professor</th>
                                        <th>Coefficient</th>

                                    </tr>
                                    </tfoot>
                                    <tbody>

                                    <tr>
                                        <td>{{$m->subject_title}}</td>
                                        <td>{{$m->professor_title}}</td>
                                        <td>{{$m->coefficient}}</td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                At least one subject is required !
            @endif
        </div>
    </div>
</div>




<div class="col-md-3">

    <div class="panel panel-default ">
        <div class="panel-heading">

            <h3 class="panel-title"><i class="fa fa-link"></i> Link subject to module</h3>
        </div>
        <div class="panel-body">
            @if((isset($fpList)) and (count($fpList)>0))
                <form method="POST" action="/admin/subject/subjectModule/add" id="level-add-form">
                    {!! csrf_field() !!}
                    <div class="input-group">
                        <input class="form-control" name="coef" type="text">


                        <select name="subject" class="form-control">
                            @foreach($sList as $s)
                                <option value="{{ $s->id }}">{{$s->title}}</option>
                            @endforeach
                        </select>
                        <select name="module" class="form-control">
                            @foreach($mList as $m)
                                <option value="{{ $m->id }}">{{$m->title}}</option>
                            @endforeach
                        </select>
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-success">Add</button>
                        </div>
                    </div>
                </form>
            @else

                A subject need a professor, affect here LINK

            @endif
        </div>
    </div>



</div>

</div>