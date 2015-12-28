<script>
    $(function () {
        $("#end_at").datepicker({
            format: 'yyyy-mm-dd',
            startDate: '+1d'
        });
        $('#url').click(function () {
            $(this).val('');
        });
    });
</script>

<div class="row">
    <form method="POST" action="/admin/notice/add" enctype="multipart/form-data" class="form" id="notice-add-form">
        <div class="col-md-9">
        <div class="panel panel-default ">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-file-text"></i> {{ trans('Notice::backend/notice.main_content') }}</h3>
            </div>
            <div class="panel-body">

                {!! csrf_field() !!}

                <div>
                    <div>
                        <label>{{ trans('backend/common.title') }} </label> <input type="text" id="title" name="title" class="form-control">
                    </div>
                </div>
                <div>
                    <div>
                        <label>{{ trans('backend/common.content') }} </label> <textarea id="formcontent" name="content"
                                                          class="form-control"></textarea>
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


                <div>
                    <label>{{ trans('backend/common.thumbnail') }} </label>
                    <input type="file" id="mainimage" name="mainimage" accept="image/*" class="file"
                           data-preview-file-type="text"/>
                </div>


                <div>
                    <label>{{ trans('backend/common.category') }} </label>
                    <select name="category" class="form-control">
                        @foreach($categoriesList as $category)
                            <option value="{{ $category->id }}">{{$category->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label>{{ trans('backend/common.status') }} </label><select name="status" class="form-control">
                        <option value="1">{{ trans('Notice::backend/notice.published') }}</option>
                        <option value="0">{{ trans('Notice::backend/notice.on_hold') }}</option>
                    </select>
                </div>
                <div>
                    <label>{{ trans('Notice::backend/notice.end_date') }} </label> <input type="text" name="end_at" id="end_at"
                                                    data-date-format="yyyy-mm-dd" class="form-control">
                </div>
                <div>

                    <div class="form-group">
                        <label>{{ trans('backend/common.comments') }} </label>

                        <div class="radio">

                            <label>
                                <input type="radio" name="comments" value="1" checked="true">{{ trans('backend/common.enabled') }}
                            </label>
                            <label>
                                <input type="radio" name="comments" value="0">{{ trans('backend/common.disabled') }}
                            </label>
                        </div>

                    </div>
                </div>
                <div>
                    <input value="{{ trans('backend/common.create', ['item' => 'Notice']) }}" type="submit" class="btn btn-success pull-right">
                </div>

            </div>
        </div>
        </div>
        <script>
            CKEDITOR.replace('formcontent',{
                height: '300px'
            });
            $("#mainimage").fileinput(
                    {
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
        </script></form>
</div>
