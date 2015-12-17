<div class="row">
    @if((isset($cList)) and (count($cList)>0))
        <script>
            function getRandomColor() {
                var letters = '0123456789ABCDEF'.split('');
                var color = '#';
                for (var i = 0; i < 6; i++ ) {
                    color += letters[Math.floor(Math.random() * 16)];
                }
                return color;
            }
            $(function () {


                var pieChartCanvas = $("#pieChart2").get(0).getContext("2d");
                var pieChart = new Chart(pieChartCanvas);

                var PieData = [
                        @foreach($classes as $class)

                        {
                        value: '{{ $class->user_count }}',
                        color: getRandomColor(),
                        highlight: getRandomColor(),
                        label: '{{ $class->title }}'
                    },

                    @endforeach

            ];
                var pieOptions = {
                    segmentShowStroke: true,
                    segmentStrokeColor: "#fff",
                    segmentStrokeWidth: 1,
                    percentageInnerCutout: 50,
                    animationSteps: 100,
                    animationEasing: "easeOutBounce",
                    animateRotate: true,
                    animateScale: false,
                    responsive: true,
                    maintainAspectRatio: false,
                    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>",
                    tooltipTemplate: "<%=label%> : <%=value %> entries"
                };
                pieChart.Doughnut(PieData, pieOptions);
            });

            $(document).ready(function() {
                $('#levels').DataTable();
            } );
        </script>
        <div class="col-md-9">
            <div class="panel panel-default ">
                <div class="panel-body">
                    @foreach($cList as $m=>$value)
                        <div class="col-md-12">
                            <div class="panel panel-info ">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" href="#collapse-{{$value[0][0]->id}}"> <i class="fa fa-tint"></i> Level : {{$m}}</a>
                                </div>
                                <div id="collapse-{{$value[0][0]->id}}" class="panel-collapse collapse in">
                                    <div class="panel-body">

                               <table id="levelClass" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>

                            <th>Class</th>

                            <th>Section</th>
                                                       <th>Manage</th>
                            <th>Rename</th>
                            <th>Delete</th>
                            <th>Created at</th>

                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Class</th>

                            <th>Section</th>

                            <th>Manage</th>
                            <th>Rename</th>
                            <th>Delete</th>
                            <th>Created at</th>

                        </tr>
                        </tfoot>
                        <tbody>

                        @foreach($value as $sub_value=>$element)
                            @foreach($element as $sub_element=>$val)
                            <tr>
                                <td>{{$val->title}}</td>

                                <td>{{$val->section_id or 'None'}}</td>
                                <td class="text-center">
                                    <button type="button"
                                            class="btn btn-flat btn-success btn-xs"><i
                                                class="fa fa-edit"></i> View</button>
                                </td>
                                <td class="text-center">
                                    <button type="button"
                                            class="btn btn-flat btn-info btn-xs"><i
                                                class="fa fa-edit"></i> Rename</button>
                                </td>
                                <td class="text-center">
                                    <button type="button"
                                            class="btn btn-flat btn-danger btn-xs"><i
                                                class="fa fa-trash"></i> Delete</button>
                                </td>
                                <td>{{$val->created_at }}</td>


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

        <div class="col-md-3">
            <div class="panel panel-default ">
                <div class="panel-heading">


                    <h3 class="panel-title"><i class="fa fa-plus"></i> Add new class</h3>

                </div>
                <div class="panel-body">



                    <form method="POST" action="/admin/level/class/add">
                        {!! csrf_field() !!}
                        <div class="input-group">
                            <select name="level" class="form-control">
                                @foreach($lList as $level)
                                    <option value="{{ $level->id }}">{{$level->title}}</option>
                                @endforeach
                            </select>

                            <select name="section" class="form-control">
                                @foreach($sList as $s)
                                    <option value="{{ $s->id }}">{{$s->title}}</option>
                                @endforeach
                            </select>

                            <input class="form-control" name="title" type="text">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-success">Add</button>
                            </div>

                        </div></form>




                </div>
            </div>
            <div class="panel panel-default ">
                <div class="panel-heading">


                    <h3 class="panel-title"><i class="fa fa-pie-chart"></i> Most Used Levels</h3>

                </div>
                <div class="panel-body">


                    <div class="chart-responsive">
                        <canvas id="pieChart2" ></canvas>
                    </div>



                </div>
            </div>
        </div>
    @else
        <div class="col-md-12">
            <div class="panel panel-default ">
                <div class="panel-heading">
                    <i class="fa fa-plus"></i>

                    <h3 class="panel-title">Add new category</h3>

                </div>
                <div class="panel-body">



                    <form method="POST" action="/admin/level/class/add" id="level-add-form">
                        {!! csrf_field() !!}
                        <div class="input-group">
                            <select name="level" class="form-control">
                                @foreach($lList as $level)
                                    <option value="{{ $level->id }}">{{$level->title}}</option>
                                @endforeach
                            </select>

                            <select name="section" class="form-control">
                                @foreach($sList as $s)
                                    <option value="{{ $s->id }}">{{$s->title}}</option>
                                @endforeach
                            </select>

                            <input class="form-control" name="title" type="text">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-success">Add</button>
                            </div>

                        </div></form>




                </div></div>

        </div>
    @endif
</div>


