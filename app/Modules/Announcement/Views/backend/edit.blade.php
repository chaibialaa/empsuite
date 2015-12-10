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

@if((isset($categoriesList)) and (count($categoriesList)>0))

    <form method="POST" action="/admin/announcement/edit/{{$announcement->id}}" enctype="multipart/form-data" class="form" id="announcement-edit-form">
        <div class="row">
            <div class="col-md-9">
                <div class="panel panel-default ">
                    <div class="panel-body">

                        {!! csrf_field() !!}

                        <div>
                            <div>
                                <label>Title </label> <input type="text" id="title" name="title" class="form-control" value="{{ $announcement->title }}" >
                            </div>
                        </div>
                        <div>
                            <div>
                                <label>Content </label> <textarea id="formcontent" name="content"
                                                                  class="form-control">{!! $announcement->content !!}</textarea>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-default ">
                    <div class="panel-body">
                        @if ($announcement->user_id !=  Auth::user()->id)
                            <div class="form-group">
                                <label style="color: #F39C12;">Transfer ownership to me </label>

                                <div class="radio">


                                    <label>
                                        <input type="radio" name="owner" value="1" >Yes
                                    </label>
                                    <label>
                                        <input type="radio" name="owner" value="0" checked>No
                                    </label>

                                </div>
                            </div>
                        @endif

                        <div>
                            <label>Thumbnail </label>
                            <input type="file" id="mainimage" name="mainimage" accept="image/*" class="file"
                                   data-preview-file-type="text" />
                        </div>


                        <div>
                            <label>Category </label>
                            <select name="category" class="form-control">
                                @foreach($categoriesList as $category)
                                    @if ($announcement->category_id == $category->id)
                                        <option selected value="{{ $category->id }}">{{$category->title}}</option>
                                        @else
                                    <option value="{{ $category->id }}">{{$category->title}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label>Status </label><select name="status" class="form-control">
                                @if ($announcement->status == 1)
                                <option selected value="1">Published</option>
                                <option value="0">On Hold</option>
                                    @else
                                    <option value="1">Published</option>
                                    <option selected value="0">On Hold</option>
                                @endif
                            </select>
                        </div>
                        <div>
                            <label>End Date </label> <input type="text" name="end_at" id="end_at"
                                                            data-date-format="yyyy-mm-dd" class="form-control" value="{{ $announcement->end_at }}">
                        </div>
                        <div>

                            <div class="form-group">
                                <label>Comments </label>

                                <div class="radio">
                                    @if ($announcement->comments == 1)
                                    <label>
                                        <input type="radio" name="comments" value="1" checked="true">Enabled
                                    </label>
                                    <label>
                                        <input type="radio" name="comments" value="0">Disabled
                                    </label>
                                        @else
                                        <label>
                                            <input type="radio" name="comments" value="1" >Enabled
                                        </label>
                                        <label>
                                            <input type="radio" name="comments" value="0" checked="true">Disabled
                                        </label>
                                    @endif
                                </div>

                            </div>

                        </div>
                        <div>
                            <input value="Update announcement" type="submit" class="btn btn-primary pull-right">
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
                            @if (strpos($announcement->thumbpath,'fallback') == false)
                            defaultPreviewContent: '<img src="{{$announcement->thumbpath}}" width="210" height="210">',
                            @endif


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
            </script>
        </div>
    </form>
@endif
