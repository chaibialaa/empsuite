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
    <form method="POST" action="/admin/announcement/add" enctype="multipart/form-data" class="form" id="announcement-add-form">
        <div class="col-md-9">
        <div class="panel panel-default ">
            <div class="panel-body">

                {!! csrf_field() !!}

                <div>
                    <div>
                        <label>Title </label> <input type="text" id="title" name="title" class="form-control">
                    </div>
                </div>
                <div>
                    <div>
                        <label>Content </label> <textarea id="formcontent" name="content"
                                                          class="form-control"></textarea>
                    </div>

                </div>

            </div>
        </div>
        </div>
        <div class="col-md-3">
        <div class="panel panel-default ">
            <div class="panel-body">


                <div>
                    <label>Thumbnail </label>
                    <input type="file" id="mainimage" name="mainimage" accept="image/*" class="file"
                           data-preview-file-type="text"/>
                </div>


                <div>
                    <label>Category </label>
                    <select name="category" class="form-control">
                        @foreach($categoriesList as $category)
                            <option value="{{ $category->id }}">{{$category->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label>Status </label><select name="status" class="form-control">
                        <option value="1">Published</option>
                        <option value="0">On Hold</option>
                    </select>
                </div>
                <div>
                    <label>End Date </label> <input type="text" name="end_at" id="end_at"
                                                    data-date-format="yyyy-mm-dd" class="form-control">
                </div>
                <div>

                    <div class="form-group">
                        <label>Comments </label>

                        <div class="radio">

                            <label>
                                <input type="radio" name="comments" value="1" checked="true">Enabled
                            </label>
                            <label>
                                <input type="radio" name="comments" value="0">Disabled
                            </label>
                        </div>

                    </div>
                </div>
                <div>
                    <input value="Add announcement" type="submit" class="btn btn-primary pull-right">
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
                        browseLabel: 'Browse',
                        removeLabel: 'Delete',
                        browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
                        removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
                        removeTitle: 'Cancel or reset changes',
                        elErrorContainer: '#kv-avatar-errors',
                        msgErrorClass: 'alert alert-block alert-danger',
                        allowedFileExtensions: ["jpg", "png", "gif"]
                    }
            );
        </script></form>
</div>
