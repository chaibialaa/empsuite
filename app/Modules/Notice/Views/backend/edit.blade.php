<script>
    $("#notice-edit-form").submit(function(e) {
        if(!$("#notice-add-form").valid()){
            return false;
        }
    });
    $(function () {
        $("#end_at").datepicker({
            format: 'yyyy-mm-dd',
            startDate: '+1d'
        });
        $('#url').click(function () {
            $(this).val('');
        });
        $("#notice-edit-form").validate({
            rules: {
                title: {
                    minlength:10,
                    required: true
                }
            },
            messages:{
                title:{
                    minlength:"{{ trans('backend/validation.min_length',['item' => 'Title','number' => '10']) }}",
                    required: "{{ trans('backend/validation.required',['item' => 'Title']) }}"
                }
            },
            errorPlacement: function(error) {
                toastr.error(error.text());
            }
        });
    });
</script>

@if((isset($categoriesList)) and (count($categoriesList)>0))

    <form method="POST" action="/admin/notice/edit/{{$notice->id}}" enctype="multipart/form-data" class="form" id="notice-edit-form">
        <div class="row">
            <div class="col-md-9">
                <div class="panel panel-default ">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-file-text"></i> {{ trans('Notice::backend/notice.main_content') }}</h3>
                    </div>
                    <div class="panel-body">

                        {!! csrf_field() !!}

                        <div>
                            <div>
                                <label>{{ trans('backend/common.title') }} </label> <input type="text" id="title" name="title" class="form-control" value="{{ $notice->title }}" >
                            </div>
                        </div>
                        <div>
                            <div>
                                <label>{{ trans('backend/common.content') }} </label> <textarea id="formcontent" name="content"
                                                                  class="form-control">{!! $notice->content !!}</textarea>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-default ">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-file-text-o"></i> {{ trans('backend/common.additional_details') }}</h3>
                    </div>
                    <div class="panel-body">
                        @if ($notice->user_id !=  Auth::user()->id)
                            <div class="form-group">
                                <label style="color: #F39C12;">{{ trans('Notice::backend/notice.transfer_ownership') }} </label>

                                <div class="radio">


                                    <label>
                                        <input type="radio" name="owner" value="1" >{{ trans('backend/common.yes') }}
                                    </label>
                                    <label>
                                        <input type="radio" name="owner" value="0" checked>{{ trans('backend/common.no') }}
                                    </label>

                                </div>
                            </div>
                        @endif

                        <div>
                            <label>{{ trans('backend/common.thumbnail') }} </label>
                            <input type="file" id="mainimage" name="mainimage" accept="image/*" class="file"
                                   data-preview-file-type="text" />
                        </div>


                        <div>
                            <label>{{ trans('backend/common.category') }} </label>
                            <select name="category" class="form-control">
                                @foreach($categoriesList as $category)
                                    @if ($notice->category_id == $category->id)
                                        <option selected value="{{ $category->id }}">{{$category->title}}</option>
                                        @else
                                    <option value="{{ $category->id }}">{{$category->title}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label>{{ trans('backend/common.status') }} </label><select name="status" class="form-control">
                                @if ($notice->status == 1)
                                <option selected value="1">Published</option>
                                <option value="0">On Hold</option>
                                    @else
                                    <option value="1">Published</option>
                                    <option selected value="0">On Hold</option>
                                @endif
                            </select>
                        </div>
                        <div>
                            <label>{{ trans('Notice::backend/notice.end_date') }} </label> <input type="text" name="end_at" id="end_at"
                                                            data-date-format="yyyy-mm-dd" class="form-control" value="{{ $notice->end_at }}">
                        </div>
                        <div>

                            <div class="form-group">
                                <label>{{ trans('backend/common.comments') }} </label>

                                <div class="radio">
                                    @if ($notice->comments == 1)
                                    <label>
                                        <input type="radio" name="comments" value="1" checked>{{ trans('backend/common.enabled') }}
                                    </label>
                                    <label>
                                        <input type="radio" name="comments" value="0">{{ trans('backend/common.disabled') }}
                                    </label>
                                        @else
                                        <label>
                                            <input type="radio" name="comments" value="1" >{{ trans('backend/common.enabled') }}
                                        </label>
                                        <label>
                                            <input type="radio" name="comments" value="0" checked>{{ trans('backend/common.disabled') }}
                                        </label>
                                    @endif
                                </div>

                            </div>

                        </div>
                        <div>
                            <input value="{{ trans('backend/common.update_item', ['item' => 'Notice']) }}" type="submit" class="btn btn-primary pull-right">
                        </div>

                    </div>
                </div>
            </div>
            <script>
                CKEDITOR.replace('formcontent',{
                   height: '400px'
                });
                $("#mainimage").fileinput(
                        {
                            @if (strpos($notice->thumbpath,'fallback') == false)
                            defaultPreviewContent: '<img src="{{$notice->thumbpath}}" width="210" height="210">',
                            @endif


                            overwriteInitial: true,
                            maxFileSize: 2000,
                            showClose: false,
                            showCaption: false,
                            showUpload: false,
                            browseLabel: '{{ trans('backend/common.browse') }}',
                            removeLabel: '{{ trans('backend/common.delete') }}',
                            browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
                            removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
                            removeTitle: '{{ trans('Notice::backend/notice.cancel_reset_changes') }}',
                            elErrorContainer: '#kv-avatar-errors',
                            msgErrorClass: 'alert alert-block alert-danger',
                            allowedFileExtensions: ["jpg", "png", "gif"]
                        }
                );
            </script>
        </div>
    </form>
@endif
