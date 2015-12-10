<div class="row">
    @if((isset($cList)) and (count($cList)>0))
        <script>
            function getRandomColor() {
                var letters = '0123456789ABCDEF'.split('');
                var color = '#';
                for (var i = 0; i < 6; i++) {
                    color += letters[Math.floor(Math.random() * 16)];
                }
                return color;
            }
            $(function () {


                var pieChartCanvas = $("#pieChart2").get(0).getContext("2d");
                var pieChart = new Chart(pieChartCanvas);

                var PieData = [
                        @foreach($categories as $category)

                        {
                        value: '{{ $category->post_count }}',
                        color: getRandomColor(),
                        highlight: getRandomColor(),
                        label: '{{ $category->title }}'
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


            $(document).ready(function () {
                var table = $('#categories').DataTable();
                @foreach($cList as $c)
                    $('#categories tbody').on('click', '#rename-{{$c->id }}', function () {
                    var tr = $(this).closest('tr');
                    var row = table.row(tr);
                    if (row.child.isShown()) {
                        row.child.hide();
                        tr.removeClass('shown');
                    } else {
                        row.child(rename{!! $c->id !!} ()).show();
                        tr.addClass('shown');
                    }
                });
                @endforeach
            });
        </script>
        <div class="col-md-9">
            <div class="panel panel-default ">
                <div class="panel-body">

                    <table id="categories" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Rename</th>
                            <th>Delete</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>

                            <th>Title</th>
                            <th>Rename</th>
                            <th>Delete</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                        </tr>
                        </tfoot>
                        <tbody>


                        @foreach($cList as $c)
                            <tr>

                                <td>{{$c->title}}</td>
                                <td id="rename-{{$c->id }}" class=" details-control"><a class="btn btn-block btn-xs btn-success btn-flat">
                                        Rename
                                    </a>
                                    <script>
                                        function rename{!! $c->id !!} () {
                                            return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
                                                    '<tr>' +
                                                    '<td>Rename Category&nbsp;</td>' +
                                                    '<td>{!! $c->title !!} :&nbsp;</td>' +
                                                    '<td><form method="POST" action="/admin/announcement/category/rename/{{$c->id }}" class="form">' +
                                                    '<div class="input-group input-group-sm">'+
                                                    '{!! csrf_field() !!}' +
                                                    '<input class="form-control" type="text" name="title">' +
                                                    '<div class="input-group-btn">'+
                                                    '<button type="submit" class="btn btn-success">Rename</button>' +
                                                    '</div>'+
                                                    '</div>'+
                                                    '</form></td>' +
                                                    '</tr>' +
                                                    '</table>';
                                        }
                                    </script>
                                </td>
                                <td><a class="btn btn-block btn-xs btn-danger btn-flat" data-toggle="modal"
                                       data-target="#delete-{{$c->id }}">
                                        Delete
                                    </a>

                                    <div class="modal fade" id="delete-{{$c->id }}" tabindex="-1" role="dialog"
                                         aria-labelledby="myModalLabel" aria-hidden="true"
                                         style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close"><span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <h4 class="modal-title">Delete Category</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST"
                                                          action="/admin/announcement/category/delete/{{$c->id }}"
                                                          class="form">
                                                        @if (count($cList) > 1)
                                                            if the category have posts :
                                                            <label>
                                                                <input type="radio" name="action" value="1">Delete
                                                                Category and Posts
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="action" value="0" checked>Move
                                                                Posts then Delete
                                                            </label>
                                                            <select name="moveto" class="form-control">
                                                                @foreach($cList as $category)
                                                                    @if ($category->id != $c->id)
                                                                        <option value="{{ $category->id }}">{{$category->title}}</option>
                                                                    @endif

                                                                @endforeach
                                                            </select>

                                                            {!! csrf_field() !!}
                                                        @else
                                                            if the category have posts they will be delete as your only
                                                            category is being deleted !
                                                        @endif
                                                        <input value="Daldoul" type="submit">
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                                        Cancel
                                                    </button>
                                                    <button type="button" class="btn btn-primary">Rename</button>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                </td>
                                <td>{{$c->created_at }}</td>
                                <td>{{$c->updated_at }}</td>

                            </tr>
                        @endforeach


                        </tbody>
                    </table>

                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-default ">
                <div class="panel-heading">


                    <h3 class="panel-title"><i class="fa fa-plus"></i> Add new category</h3>

                </div>
                <div class="panel-body">


                    <form method="POST" action="/admin/announcement/category/add">

                        <div class="input-group">

                            {!! csrf_field() !!}
                            <input class="form-control" name="title" type="text">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-success">Add</button>
                            </div>

                        </div>
                    </form>


                </div>
            </div>
            <div class="panel panel-default ">
                <div class="panel-heading">


                    <h3 class="panel-title"><i class="fa fa-pie-chart"></i> Most Used Categories</h3>

                </div>
                <div class="panel-body">


                    <div class="chart-responsive">
                        <canvas id="pieChart2"></canvas>
                    </div>


                </div>
            </div>
        </div>
    @else
        <div class="col-md-12">
            <div class="panel panel-default ">
                <div class="box-header">
                    <i class="fa fa-plus"></i>

                    <h3 class="box-title">Add new category</h3>

                </div>
                <div class="panel-body">


                    <form method="POST" action="/admin/announcement/category/add" id="announcement-category-add-form">

                        <div class="input-group">

                            {!! csrf_field() !!}
                            <input class="form-control" name="title" type="text">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-success">Add</button>
                            </div>

                        </div>
                    </form>


                </div>
            </div>

        </div>
    @endif
</div>


