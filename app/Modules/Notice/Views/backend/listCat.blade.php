<div class="row">

        <script>
            $("#addCategory").submit(function(e) {
                if(!$("#addCategory").valid()){
                    return false;
                }
            });
            @foreach($cList as $c)
                        $("#form-rename-{{$c->id}}").submit(function(e) {
                        if(!$("#form-rename-{{$c->id}}").valid()){
                            return false;
                        }
                    });
            @endforeach
                        @if(count($categories)>0)
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
                    tooltipTemplate: "<%=label%> : <%=value %> {{ trans('backend/common.entries') }}"
                };
                pieChart.Doughnut(PieData, pieOptions);
            });

            @endif
            $(document).ready(function () {

                        $("#addCategory").validate({
                            rules: {
                                title: {
                                    minlength:4,
                                    required: true
                                }
                            },
                            messages:{
                                title:{
                                    minlength:"{{ trans('Notice::backend/category.min_length') }}",
                                    required: "{{ trans('Notice::backend/category.title_required') }}"
                                }
                            },
                            errorPlacement: function(error) {
                                toastr.error(error.text());
                            }
                        });
                var table = $('#categories').DataTable();
                @foreach($cList as $c)
                    $("#form-rename-{{$c->id }}").validate({
                            rules: {
                                title: {
                                    minlength:4,
                                    required: true
                                }
                            },
                            messages:{
                                title:{
                                    minlength:"{{ trans('Notice::backend/category.min_length') }}",
                                    required: "{{ trans('Notice::backend/category.title_required') }}"
                                }
                            },
                            errorPlacement: function(error) {
                                toastr.error(error.text());
                            }
                        });
                @endforeach
            });
        </script>
        <div class="col-md-9">

            <div class="panel panel-default ">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-list"></i> {{ trans('Notice::backend/category.manage') }}</h3>
                </div>
                <div class="panel-body">

                    <table id="categories" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>{{ trans('backend/common.title') }}</th>
                            <th>{{ trans('backend/common.rename') }}</th>
                            <th>{{ trans('backend/common.delete') }}</th>
                            <th>{{ trans('backend/common.created_at') }}</th>
                            <th>{{ trans('backend/common.updated_at') }}</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>{{ trans('backend/common.title') }}</th>
                            <th>{{ trans('backend/common.rename') }}</th>
                            <th>{{ trans('backend/common.delete') }}</th>
                            <th>{{ trans('backend/common.created_at') }}</th>
                            <th>{{ trans('backend/common.updated_at') }}</th>
                        </tr>
                        </tfoot>
                        <tbody>


                        @foreach($cList as $c)
                            <tr>

                                <td>{{$c->title}}</td>
                                <td class="text-center"><a class="btn btn-xs btn-primary btn-flat"  data-toggle="modal" data-target="#rename-{{$c->id }}">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <div class="modal fade" id="rename-{{$c->id }}" tabindex="-1" role="dialog"
                                         aria-labelledby="myModalLabel" aria-hidden="true"
                                         style="display: none;">
                                        <div class="modal-dialog">
                                            <form method="POST"
                                                  action="/admin/notice/category/rename/{{$c->id }}"
                                                  class="form" id="form-rename-{{$c->id }}">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close"><span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <h4 class="modal-title">{{ trans('Notice::backend/category.rename') }} {{$c->title}} </h4>
                                                </div>
                                                <div class="modal-body">

                                                        <form method="POST" action="/admin/notice/category/rename/{{$c->id }}" id="form-rename-{{$c->id }}" class="form-validate">

                                                                {!! csrf_field() !!}
                                                                <input class="form-control" type="text" name="title" style="width: 100%!important;">


                                                        </form>



                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                                        Cancel
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">{{ trans('Notice::backend/category.rename') }}</button>
                                                </div>
                                            </div>
                                            </form>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                </td>
                                <td class="text-center"> <a class="btn btn-xs btn-danger btn-flat" data-toggle="modal"
                                       data-target="#delete-{{$c->id }}">
                                        <i class="fa fa-trash"></i>
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
                                                    <h4 class="modal-title">Delete {{$c->title}}</h4>
                                                </div>
                                                <form method="POST"
                                                      action="/admin/notice/category/delete/{{$c->id }}"
                                                      class="form">
                                                <div class="modal-body">

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
                                                        <div class="alert alert-warning">
                                                        {{ trans('Notice::backend/category.all_entries_delete', ['title' => $c->title]) }}
                                                        </div>

                                                        @endif


                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                                        Cancel
                                                    </button>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </div>
                                                </form>
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


                    <form method="POST" action="/admin/notice/category/add" id="addCategory" class="form-validate">

                        <div class="input-group">

                            {!! csrf_field() !!}

                            <input class="form-control" name="title" type="text" id="title">

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


                    @if(count($categories)==0)
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


