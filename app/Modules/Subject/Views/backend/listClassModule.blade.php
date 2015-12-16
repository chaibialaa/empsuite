<div class="row">
    <div class="col-md-9">
        <div class="panel panel-default ">
            <div class="panel-heading">
                <i class="fa fa-plus"></i> Manage Modules
            </div>
            <div class="panel-body">

                    <div class="row">
                        @foreach($fmList as $m=>$value)

                            <div class="col-md-6">
                                <div class="panel panel-info ">
                                    <div class="panel-heading">
                                        <a data-toggle="collapse" href="#collapse-{{$value[0][0]->id}}"> <i class="fa fa-tint"></i> Module : {{$m}}</a>
                                    </div>
                                    <div id="collapse-{{$value[0][0]->id}}" class="panel-collapse collapse in">
                                    <div class="panel-body">


                                            <table id="classMods" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                <thead>
                                                <tr>

                                                    <th>Subject</th>
                                                    <th>Coef.</th>
                                                    <th>Professor</th>
                                                    <th>Edit</th>
                                                </tr>
                                                </thead>
                                                <tfoot>
                                                <tr>

                                                    <th colspan="4">

                                                        <form action="/admin/subject/classModule/attach" method="post">
                                                            {!! csrf_field() !!}
                                                                <div class="input-group-btn">
                                                                    <button type="submit" class="btn btn-danger btn-sm btn-block"><i
                                                                                class="fa fa-trash"></i> Remove from Class {{$class}}</button>
                                                                </div>
                                                        </form>


                                                    </th>

                                                </tr>
                                                </tfoot>
                                                <tbody>
                                                @foreach($value as $sub_value=>$element)
                                                    @foreach($element as $sub_element=>$val)
                                                        <tr>
                                                            <script>

                                                                $(function() {
                                                                    $( "#spinner-{{$val->cm_id}}" ).spinner({
                                                                        step: 0.5,
                                                                        numberFormat: "n"
                                                                    });

                                                                });
                                                            </script>
                                                            <td>{{$val->subject_title}}</td>
                                                            <td>{{$val->coefficient}}</td>
                                                            <td>
                                                                {{$val->nom}}
                                                                </td>
                                                            <td class=" details-control text-center">
                                                                <button type="button"
                                                                        data-toggle="modal" data-target="#edit-{{$val->cm_id }}" class="btn btn-flat btn-info btn-xs"><i
                                                                            class="fa fa-edit" ></i></button>
                                                                <div class="modal fade" id="edit-{{$val->cm_id }}" role="dialog">
                                                                    <div class="modal-dialog modal-sm">
                                                                        <div class="modal-content">
                                                                            <form action="" method="post">
                                                                            <div class="modal-header">
                                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                <h4 class="modal-title">Update {{$val->subject_title}}  </h4><small>Class {{$class}}</small>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <p>Professor : <select name="professor" class="form-control input-sm">
                                                                                        @foreach($fpList as $p)
                                                                                            @if ($val->user_id == $p->id)
                                                                                            <optgroup label="Current">
                                                                                                <option selected value="{{ $p->id }}">{{$p->nom}}</option>
                                                                                            </optgroup>
                                                                                            @else
                                                                                            <optgroup label="Change to">
                                                                                            <option value="{{ $p->id }}">{{$p->nom}}</option>
                                                                                            </optgroup>
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </select></p>
                                                                                <p>Coefficient : <input id="spinner-{{$val->cm_id}}" name="spinner" class="form-control input-sm" value="{{$val->coefficient}}"></p>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="submit" class="btn btn-success">Update</button>
                                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                                                            </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endforeach
                                                </tbody>
                                            </table>

                                    </div>
                                        </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

            </div>
        </div>


    </div>
</div>