                   <form method="POST" action="/message/compose/add" class="form" id="message-add-form">
                    {!! csrf_field() !!}
                    <div class="form-group">
                            <select id="sl2" name="receiverids[]" class="form-control select2 select2-hidden-accessible" multiple style="width: 100%; " data-placeholder="Select contacts">
                                @foreach($userList as $receiver)
                                    @if ($receiver->id !=  Auth::user()->id)
                                        <option value="{{ $receiver->id }}">{{$receiver->nom}}</option>
                                    @endif
                                @endforeach
                            </select>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-9" style="padding-left: 0px; !important;">
                            <input type="text" id="subject" name="subject" class="form-control" placeholder="Subject : ">
                        </div>
                        <div class="col-sm-3" style="padding-right: 0px; !important;">
                            <select name="priority" class="form-control">
                                <option value="0">Normal Priority</option>
                                <option value="1">Medium Priority</option>
                                <option value="2">Urgent Priority</option>
                            </select>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <div>
                            <textarea id="formcontent" name="content"
                                                              class="form-control"></textarea>
                        </div>

                    </div>
                    <script>
                        CKEDITOR.replace('formcontent',{
                            height: '300px'
                        });
                        $('#sl2').select2();
                    </script>
                    <div class="pull-right">
                        <button type="submit" name="draft" class="btn btn-default"><i class="fa fa-pencil"></i> Draft</button>
                        <button type="submit" name="send" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
                    </div>

                </form>


