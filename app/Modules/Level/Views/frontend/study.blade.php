<div class="row">
    <div class="col-md-12">
        <form method="post" action="">
            <h3>Join a class</h3>


            <div class="row">
                @foreach($classes  as $m=>$value)
                    <div class="col-md-12">
                        <div class="panel panel-info ">
                            <div class="panel-heading">
                                <a data-toggle="collapse" href="#collapse-{{$m}}"> <i class="fa fa-tint"></i> Level : {{$m}}</a>
                            </div>
                            <div id="collapse-{{$m}}" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <div class="row">
                                        @foreach($value as $v=>$k)
                                            <div class="col-md-3">
                                                <div class="panel panel-info ">
                                                    <div class="panel-heading">
                                                        <a data-toggle="collapse" href="#collapse-{{$k[0][0]->level_id}}-{{preg_replace('/\s+/', '', $v)}}"> <i class="fa fa-list"></i> Section : {{$k[0][0]->section_title}}</a>
                                                    </div>
                                                    <div id="collapse-{{$k[0][0]->level_id}}-{{preg_replace('/\s+/', '', $v)}}" class="panel-collapse collapse in">
                                                        <div class="panel-body">
                                                            <table id="levelClass" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                                <thead>
                                                                <tr>

                                                                    <th>Class</th>


                                                                    <th class="text-center">Action</th>



                                                                </tr>
                                                                </thead>

                                                                <tbody>

                                                                @foreach($k as $sub_value=>$element)
                                                                    @foreach($element as $sub_element=>$val)
                                                                        <tr>
                                                                            <td>{{$val->title}}</td>


                                                                            <td class="text-center">
                                                                                <button type="button"
                                                                                        class="btn btn-flat btn-success btn-xs"><i
                                                                                            class="fa fa-edit"></i> Join</button>
                                                                            </td>




                                                                        </tr>
                                                                    @endforeach
                                                                @endforeach



                                                                </tbody></table>
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
                @endforeach

            </div>

        </form>
    </div>
</div>