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
                                        <th>Remove</th>

                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Subject</th>
                                        <th>Coefficient</th>
                                        <th>Remove</th>

                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($value as $sub_value=>$element)
                                        @foreach($element as $sub_element=>$val)
                                    <tr>
                                        <td>{{$val->subject_title}}</td>
                                        <td>{{$val->coefficient}}</td>
                                        <td class="text-center"><button type="button" class="btn btn-flat btn-danger btn-xs"><i class="fa fa-trash"></i></button></td>
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

            <h3 class="panel-title"><i class="fa fa-link"></i> Attach Subject to Module</h3>
        </div>
        <div class="panel-body">
            @if((isset($mList)) and (count($mList)>0) and (isset($sList)) and (count($sList)>0))
                <form method="POST" action="/admin/subject/subjectModule/add" id="level-add-form">
                    {!! csrf_field() !!}
                        <label>Coefficient :</label>
                        <input class="form-control" name="coef" type="text">

                    <label>Subject :</label>
                        <select name="subject" class="form-control">
                            @foreach($sList as $s)
                                <option value="{{ $s->id }}">{{$s->title}}</option>
                            @endforeach
                        </select>
                        <label>Module :</label>
                        <select name="module" class="form-control">
                            @foreach($mList as $m)
                                <option value="{{ $m->id }}">{{$m->title}}</option>
                            @endforeach
                        </select>
                    <br/>
                        <button type="submit" class="btn btn-success btn-flat btn-block">Attach</button>


                </form>
            @else

                You need at least one module and one subject.

            @endif
        </div>
    </div>



</div>

</div>