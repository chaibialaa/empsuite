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
                                        <form action="/admin/subject/classModule/attach" method="post">
                                            {!! csrf_field() !!}

                                            <table id="modules" class="table table-striped table-bordered" cellspacing="0" width="100%">
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


                                                                <div class="input-group-btn">
                                                                    <button type="submit" class="btn btn-danger btn-sm btn-block"><i
                                                                                class="fa fa-trash"></i> Remove from Class {{$class}}</button>
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
                                                                {{$val->nom}}
                                                                </td>
                                                            <td class="text-center">
                                                                <button type="button"
                                                                        class="btn btn-flat btn-info btn-xs"><i
                                                                            class="fa fa-edit"></i></button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </form>
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