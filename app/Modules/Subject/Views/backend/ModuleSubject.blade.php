<div class="row">
<div class="col-md-9">
    <div class="panel panel-default ">
        <div class="panel-heading">
            <i class="fa fa-plus"></i> Subjects Links to Modules
        </div>
        <div class="panel-body">
            @if((isset($fcmList)) and (count($fcmList)>0))
                @foreach($fcmList as $cm=>$value)

                    <div class="col-md-6">
                        <div class="panel panel-info ">
                            <div class="panel-heading">
                                <i class="fa fa-tint"></i> Module : {{$cm}}
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
                                    @foreach($value as $sub_value=>$element)
                                        @foreach($element as $sub_element=>$val)
                                    <tr>
                                        <td>{{$val->subject_title}}</td>
                                        <td>{{$val->coefficient}}</td>
                                    </tr>
                                        @endforeach
                                    @endforeach

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


</div>




<div class="col-md-3">

    <div class="panel panel-default ">
        <div class="panel-heading">

            <h3 class="panel-title"><i class="fa fa-link"></i> Link subject to module</h3>
        </div>
        <div class="panel-body">
            @if((isset($mList)) and (count($mList)>0) and (isset($sList)) and (count($sList)>0))
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

                You need at least one module and one subject.

            @endif
        </div>
    </div>



</div>

</div>