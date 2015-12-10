<h5>Messages</h5>

<ul class="nav nav-pills nav-stacked">
    <li><a href="/message"><i class="fa fa-inbox"></i> Inbox
           <span class="label label-primary pull-right" style="width: 30px;
height: 20px; !important;">{{$Counter['inboxCount']}}</span> <span class="pull-right" style="width: 2px;
height: 20px; !important;">&nbsp;</span> @if ($Counter['newCount'] > 0) <span class="label label-success pull-right" style="width: 30px;
height: 20px; !important;">{{$Counter['newCount']}}</span>@endif</a></li>
    <li><a href="/message/sent"><i class="fa fa-envelope-o"></i> Sent <span class="label label-primary pull-right" style="width: 30px;
height: 20px; !important;">{{$Counter['sentCount']}}</span></a></li>
    <li><a href="/message/draft"><i class="fa fa-file-text-o"></i> Drafts <span class="label label-primary pull-right" style="width: 30px;
height: 20px; !important;">{{$Counter['draftCount']}}</span></a></li>
    <li><a href="#"><i class="fa fa-trash-o"></i> Trash</a></li>
</ul>