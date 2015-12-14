<div class="row">
    <div class="col-md-9">
        <div class="panel panel-default ">
            <div class="panel-heading">
                <i class="fa fa-plus"></i> Subjects Links to Modules
            </div>
            <div class="panel-body">
                @if((isset($fcmList)) and (count($fcmList)>0) and (isset($cList)) and (count($cList)>0) and (isset($fpList)) and (count($fpList)>0))
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
                                            <th>Coef.</th>
                                            <th>Professor</th>

                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th colspan="3">
                                                <div class="form-group">


                                                        <div class="input-group">
                                                            <div class="input-group-btn">
                                                                <button type="submit" class="btn btn-success btn-sm">Attach to</button>
                                                            </div>
                                                            <select name="module" class="form-control input-sm col-md-6">
                                                                @foreach($cList as $c=>$v)
                                                                    <optgroup label="Level : {{$c}}">
                                                                        @foreach($v as $s_v=>$e)
                                                                            @foreach($e as $s_e=>$val)
                                                                                <option value="{{ $val->id }}">Class : {{$val->class_title}}</option>
                                                                            @endforeach
                                                                        @endforeach
                                                                    </optgroup>
                                                                @endforeach
                                                            </select>

                                                        </div>

                                                </div>
                                            </th>

                                        </tr>
                                        </tfoot>
                                        <tbody>
                                        @foreach($value as $sub_value=>$element)
                                            @foreach($element as $sub_element=>$val)
                                                <tr>
                                                    <td>{{$val->subject_title}}</td>
                                                    <td>{{$val->coefficient}}</td>
                                                    <td>

                                                        <select name="module" class="form-control input-sm">
                                                        @foreach($fpList as $p)
                                                            <option value="{{ $p->id }}">{{$p->nom}}</option>
                                                        @endforeach
                                                    </select></td>
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
                    At least one professor, one module and one class in a level !
                @endif
            </div>
        </div>


    </div>

    <div class="col-md-3">

        <div class="panel panel-default ">
            <div class="panel-heading">

                <h3 class="panel-title"><i class="fa fa-link"></i> View Modules attached to</h3>
            </div>
            <div class="panel-body">
                <select name="module" class="form-control input-sm col-md-6">
                    @foreach($cList as $c=>$v)
                        <optgroup label="Level : {{$c}}">
                            @foreach($v as $s_v=>$e)
                                @foreach($e as $s_e=>$val)
                                    <option value="{{ $val->id }}">Class : {{$val->class_title}}</option>
                                @endforeach
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
            </div>
        </div>



    </div>

</div>