<div class="row">

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


                        {
                        value: '',
                        color: getRandomColor(),
                        highlight: getRandomColor(),
                        label: ''
                    },



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
                $('#classes').DataTable();
            } );
        </script>
    <div class="col-md-9">
        <div class="panel panel-default ">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list"></i> Manage Classes</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    @foreach($fcList as $m=>$value)
                        <div class="col-md-12">
                            <div class="panel panel-info ">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" href="#collapse-{{$m}}"> <i class="fa fa-tint"></i> Level : {{$m}}</a>
                                </div>
                                <div id="collapse-{{$m}}" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <div class="row">
                                            @foreach($value as $v=>$k)
                                                <div class="col-md-6">
                                                    <div class="panel panel-info ">
                                                        <div class="panel-heading">
                                                            <a data-toggle="collapse" href="#collapse-{{$k[0][0]->level_id}}-{{preg_replace('/\s+/', '', $v)}}"> <i class="fa fa-list"></i> Section : {{$v}}</a>
                                                        </div>
                                                        <div id="collapse-{{$k[0][0]->level_id}}-{{preg_replace('/\s+/', '', $v)}}" class="panel-collapse collapse in">
                                                            <div class="panel-body">
                                                                <table id="levelClass" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                                    <thead>
                                                                    <tr>

                                                                        <th>Class</th>


                                                                        <th>Manage</th>
                                                                        <th>Rename</th>
                                                                        <th>Delete</th>


                                                                    </tr>
                                                                    </thead>
                                                                    <tfoot>
                                                                    <tr>
                                                                        <th>Class</th>



                                                                        <th>Manage</th>
                                                                        <th>Rename</th>
                                                                        <th>Delete</th>


                                                                    </tr>
                                                                    </tfoot>
                                                                    <tbody>

                                                                    @foreach($k as $sub_value=>$element)
                                                                        @foreach($element as $sub_element=>$val)
                                                                            <tr>
                                                                                <td>{{$val->title}}</td>


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
                    @if(count($cList)==0)
                        <div class="col-md-12">
                            No Classes Found !
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

        <div class="col-md-3">
            <div class="panel panel-default ">
                <div class="panel-heading">

                    <h3 class="panel-title"><i class="fa fa-plus"></i> Add new level</h3>

                </div>
                <div class="panel-body">

                    <form method="POST" action="/admin/timetable/class/add">
                        <div class="input-group">
                            {!! csrf_field() !!}
                            <select name="class" class="form-control">
                                @foreach($cList as $c)
                                    <option value="{{ $c->id }}">{{$c->title}}</option>
                                @endforeach
                            </select>
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-success">Create</button>
                            </div>
                        </div>
                    </form>

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

</div>


