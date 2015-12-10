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

                                <th width="30%">Receiver</th>
                            <th>Subject</th>
                            <th width="20%">Created at</th>

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
                                <a href="{{ url('/').'/message/draft/'.$message->m_id}}">{{$message->subject}}</a>
                                </td>
                                    <td>{{$message->created_at }}</td>

                                </tr>
                            @endforeach



                            </tbody></table>

                    @endif
