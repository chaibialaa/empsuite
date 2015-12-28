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
            tooltipTemplate: "<%=label%> : <%=value %> {{ trans('backend/common.entries') }}"
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
                        <h3 class="panel-title"><i class="fa fa-list"></i> {{ trans('Notice::backend/notice.manage') }}</h3>
                    </div>
                    <div class="panel-body">


                        <table id="notices" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>

                                <th>{{ trans('backend/common.title') }}</th>
                                <th>{{ trans('backend/common.category') }}</th>
                                <th>{{ trans('backend/common.status') }}</th>
                                <th>{{ trans('backend/common.owner') }}</th>
                                <th>{{ trans('backend/common.edit') }}</th>
                                <th>{{ trans('backend/common.delete') }}</th>
                                <th>{{ trans('Notice::backend/notice.end_date') }}</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>{{ trans('backend/common.title') }}</th>
                                <th>{{ trans('backend/common.category') }}</th>
                                <th>{{ trans('backend/common.status') }}</th>
                                <th>{{ trans('backend/common.owner') }}</th>
                                <th>{{ trans('backend/common.edit') }}</th>
                                <th>{{ trans('backend/common.delete') }}</th>
                                <th>{{ trans('Notice::backend/notice.end_date') }}</th>
                            </tr>
                            </tfoot>
                            <tbody>


                                    @foreach($notices as $notice)
                                        <tr>
                                <td>{{$notice->title }}</td>
                                <td>{{$notice->title_cat}}</td>
                                <td>@if($notice->status != 1)
                                    <form method="POST" action="/admin/notice/publish/{{$notice->id}}">{!! csrf_field() !!}
                                        <button type="submit" class="btn btn-block btn-xs btn-success btn-flat">{{trans('Notice::backend/notice.publish')}}</button>
                                    </form>
                                        @else
                                        <form method="POST" action="/admin/notice/holdon/{{$notice->id}}">{!! csrf_field() !!}
                                            <button type="submit" class="btn btn-block btn-xs  btn-default btn-flat">{{trans('Notice::backend/notice.put_on_hold')}}</button>
                                        </form>
                                        @endif
                                    </td>
                                <td>{{$notice->nom}}</td>
                                <td class="text-center"><form method="get" action="/admin/notice/edit/{{$notice->id}}" target="_blank">
                                        <button type="submit" class="btn btn-xs btn-info btn-flat"><i class="fa fa-edit"></i></button>
                                    </form>

                                </td>
                                <td class="text-center">
                                    <form method="POST" action="/admin/notice/delete/{{$notice->id}}">{!! csrf_field() !!}
                                        <button type="submit" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>

                                <td>{{$notice->end_at }}</td>
                                        </tr>
                                    @endforeach



                            </tbody></table>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <a href="/admin/notice/category/" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> {{ trans('Notice::backend/category.add_category') }}</a>

                <a href="/admin/notice/add" class="btn  btn-primary btn-block"><i class="fa fa-plus"></i> {{ trans('Notice::backend/notice.add_notice') }}</a>
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
