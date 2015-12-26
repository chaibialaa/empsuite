<script>
    @if(count($users)>0)
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
                @foreach($users as $user)

                {
                value: '{{ $user->post_count }}',
                color: getRandomColor(),
                highlight: getRandomColor(),
                label: '{{ $user->nom }}'
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
@endif
    $(document).ready(function() {
        $('#notices').DataTable();
    } );
</script>

        <div class="row">
            <div class="col-md-9">
                <div class="panel panel-default ">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-list"></i> Manage Notices</h3>
                    </div>
                    <div class="panel-body">


                        <table id="notices" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>

                                <th>Title</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Author</th>
                                <th>Edit</th>
                                <th>Delete</th>

                                <th>Ending at</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Author</th>
                                <th>Edit</th>
                                <th>Delete</th>

                                <th>Ending at</th>
                            </tr>
                            </tfoot>
                            <tbody>


                                    @foreach($notices as $notice)
                                        <tr>
                                <td>{{$notice->title }}</td>
                                <td>{{$notice->title_cat}}</td>
                                <td>@if($notice->status != 1)
                                    <form method="POST" action="/admin/notice/publish/{{$notice->id}}">{!! csrf_field() !!}
                                        <button type="submit" class="btn btn-block btn-xs btn-success btn-flat">Publish Now</button>
                                    </form>
                                        @else
                                        <form method="POST" action="/admin/notice/holdon/{{$notice->id}}">{!! csrf_field() !!}
                                            <button type="submit" class="btn btn-block btn-xs  btn-default btn-flat">Put On Hold</button>
                                        </form>
                                        @endif
                                    </td>
                                <td>{{$notice->nom}}</td>
                                <td><form method="get" action="/admin/notice/edit/{{$notice->id}}" target="_blank">
                                        <button type="submit" class="btn btn-block btn-xs btn-primary btn-flat">Edit</button>
                                    </form>
                                    </td><td>
                                    <form method="POST" action="/admin/notice/delete/{{$notice->id}}">{!! csrf_field() !!}
                                        <button type="submit" class="btn btn-block btn-xs btn-danger btn-flat">Delete</button>
                                    </form></td>

                                <td>{{$notice->end_at }}</td>
                                        </tr>
                                    @endforeach



                            </tbody></table>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <a href="/admin/notice/category/" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> Add new category</a>

                <a href="/admin/notice/add" class="btn  btn-primary btn-block"><i class="fa fa-plus"></i> Add new notice</a>
<br>
                <div class="panel panel-default ">
                    <div class="panel-heading">


                        <h3 class="panel-title"><i class="fa fa-pie-chart"></i> Top Authors</h3>

                    </div>
                    <div class="panel-body">

                    @if(count($users)==0)
                         No Notices Yet !
                        @else
                            <div class="chart-responsive">
                                <canvas id="pieChart2"></canvas>
                            </div>
                        @endif


                    </div>
                </div>
            </div>
        </div>
