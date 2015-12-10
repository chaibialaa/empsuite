    <!-- Your Page Content Here -->
    <script>
        $(document).ready(function() {
            $('#inbox').DataTable();
        } );
    </script>

                    @if((isset($inbox)) and (count($inbox)>0))
                        <table id="inbox" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>

                                <th>Receiver</th>
                                <th>Subject</th>
                                <th>Sent at</th>
                                <th>Seen at</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($inbox as $message)
                                <tr>
                                    <td>{{$message->user}}</td>
                                                                   <td>
                                @if($message->priority == 2)
                                <i class="fa fa-circle-o text-danger"></i>
                                @elseif($message->priority == 1)
                                <i class="fa fa-circle-o text-warning"></i>
                                @elseif($message->priority == 0)
                                <i class="fa fa-circle-o text-info"></i>
                                @endif
                                <a href="{{ url('/').'/message/sent/'.$message->m_id}}">{{$message->subject}}</a>

                                </td>
                                    <td>{{$message->created_at }}</td>
                                    <td>@if ($message->seen == 1) {{$message->updated_at }} @else Not yet @endif</td>
                                </tr>
                            @endforeach



                            </tbody></table>

                    @endif
