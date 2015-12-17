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

                    <table id="levels" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>

                            <th>Class</th>
                            <th>Level</th>
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
                            <th>Level</th>
                            <th>Section</th>
                            <th>Manage</th>
                            <th>Rename</th>
                            <th>Delete</th>
                            <th>Created at</th>

                        </tr>
                        </tfoot>
                        <tbody>


                        @foreach($cList as $c)
                            <tr>
                                <td>{{$c->title}}</td>
                                <td>{{$c->level_title}}</td>
                                <td>{{$c->section_id or 'None'}}</td>
                                <td><a class="btn btn-block btn-xs btn-info btn-flat" href="/admin/level/class/{{$c->id }}" target="_blank">
                                        Manage
                                    </a>
                                </td>
                                <td><a class="btn btn-block btn-xs btn-success btn-flat" data-toggle="modal" data-target="#rename-{{$c->id }}">
                                        Rename
                                    </a>
                                    <div class="modal fade" id="rename-{{$c->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
                                         style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">Rename Category</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="/admin/level/rename/{{$c->id }}" class="form">
                                                        {!! csrf_field() !!}
                                                        <input type="text" name="title">
                                                        <input value="Rename" type="submit">
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                    <button type="button" class="btn btn-primary">Rename</button>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div>
                                </td>
                                <td><a class="btn btn-block btn-xs btn-danger btn-flat" data-toggle="modal" data-target="#delete-{{$c->id }}">
                                        Delete
                                    </a>
                                    <div class="modal fade" id="delete-{{$c->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
                                         style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">Delete Category</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="/admin/level/delete/{{$c->id }}" class="form">
                                                        @if (count($cList) > 1)
                                                            if the category have posts :
                                                            <label>
                                                                <input type="radio" name="action" value="1" >Delete Category and Posts
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="action" value="0" checked>Move Posts then Delete
                                                            </label>
                                                            <select name="moveto" class="form-control">
                                                                @foreach($cList as $l)
                                                                    @if ($c->id != $c->id)
                                                                        <option value="{{ $c->id }}">{{$c->title}}</option>
                                                                    @endif

                                                                @endforeach
                                                            </select>

                                                            {!! csrf_field() !!}
                                                        @else
                                                            if the category have posts they will be delete as your only category is being deleted !
                                                        @endif
                                                        <input value="Daldoul" type="submit">
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                    <button type="button" class="btn btn-primary">Rename</button>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div>
                                </td>
                                <td>{{$c->created_at }}</td>


                            </tr>
                        @endforeach



                        </tbody></table>

                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-default ">
                <div class="panel-heading">


                    <h3 class="panel-title"><i class="fa fa-plus"></i> Add new level</h3>

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


