<?php namespace App\Modules\Message\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Modules\Message\Models\Message;
use App\Modules\Message\Models\MessageUser;
use DB, App\Helpers\ConfigFromDB, View, Input, Auth;

class MessageController extends Controller {

    public function redirectMessage()
    {
        return redirect('/message/');

    }

	public function listInboxMessageFrontend()
	{
        $module['Title'] = "Messages Box";
        $module['SubTitle'] = "Inbox";
        $module['URL'] = "/message";

        $user = Auth::user()->id;
		$inbox = DB::table('message_users')
			->join('messages', 'messages.id', '=', 'message_users.message_id')
            ->join('users', 'users.id', '=', 'message_users.sender_id')
			->select('users.nom as user', 'messages.*', 'message_users.*', 'messages.id as m_id')
            ->where('message_users.receiver_id','=',$user)
            ->where('message_users.status','=',1)
			->orderBy('updated_at', 'desc')
			->get();
        if (! $inbox){
            alert()->success('No items babe ');
        }
		$additionalLibs[0] = "libraries/datatables/jquery.dataTables.min.js";
		$additionalLibs[1] = "libraries/datatables/dataTables.bootstrap.min.js";
		$additionalCsss[0] = "libraries/datatables/dataTables.bootstrap.css";
        $sidebars[0] = View::make('Message::widgets.menu');

		$view = View::make('frontend.' . ConfigFromDB::setting('theme') . '.layout');
		$ComposedSubView = View::make('Message::frontend.inbox')
			->with('inbox', $inbox);
		$view->with('content', $ComposedSubView)->with('module', $module)->with('sidebars', $sidebars);
		$view->with('additionalCsss', $additionalCsss);
		$view->with('additionalLibs', $additionalLibs);

		return $view;
	}

    public function listSentMessageFrontend()
    {

        $module['Title'] = "Messages Box";
        $module['SubTitle'] = "Sent Messages";
        $module['URL'] = "/message";

        $user = Auth::user()->id;
        $inbox = DB::table('message_users')
            ->join('messages', 'messages.id', '=', 'message_users.message_id')
            ->join('users', 'users.id', '=', 'message_users.receiver_id')
            ->select('users.nom as user', 'messages.*', 'message_users.*','messages.id as m_id')
            ->where('message_users.sender_id','=',$user)
            ->where('message_users.status','=',1)
            ->orderBy('updated_at', 'desc')
            ->get();

        if (! $inbox){
            alert()->success('No sent babe ');
            return $this->redirectMessage();
        }
        $additionalLibs[0] = "libraries/datatables/jquery.dataTables.min.js";
        $additionalLibs[1] = "libraries/datatables/dataTables.bootstrap.min.js";
        $additionalCsss[0] = "libraries/datatables/dataTables.bootstrap.css";
        $sidebars[0] = View::make('Message::widgets.menu');

        $view = View::make('frontend.' . ConfigFromDB::setting('theme') . '.layout');
        $ComposedSubView = View::make('Message::frontend.sent')
            ->with('inbox', $inbox);
        $view->with('content', $ComposedSubView)->with('module', $module)->with('sidebars', $sidebars);
        $view->with('additionalCsss', $additionalCsss);
        $view->with('additionalLibs', $additionalLibs);

        return $view;
    }

    public function listDraftMessageFrontend()
    {
        $module['Title'] = "Messages Box";
        $module['SubTitle'] = "Draft Messages";
        $module['URL'] = "/message";

        $user = Auth::user()->id;
        $inbox = DB::table('message_users')
            ->join('messages', 'messages.id', '=', 'message_users.message_id')
            ->join('users', 'users.id', '=', 'message_users.receiver_id')
            ->select('users.nom as user', 'messages.*', 'message_users.*','messages.id as m_id')
            ->where('message_users.sender_id','=',$user)
            ->where('message_users.status','=',0)
            ->orderBy('updated_at', 'desc')
            ->get();

        if (! $inbox){
            alert()->success('No draft babe ');
            return $this->redirectMessage();
        }
        $additionalLibs[0] = "libraries/datatables/jquery.dataTables.min.js";
        $additionalLibs[1] = "libraries/datatables/dataTables.bootstrap.min.js";
        $additionalCsss[0] = "libraries/datatables/dataTables.bootstrap.css";
        $sidebars[0] = View::make('Message::widgets.menu');

        $view = View::make('frontend.' . ConfigFromDB::setting('theme') . '.layout');
        $ComposedSubView = View::make('Message::frontend.draft')
            ->with('inbox', $inbox);
        $view->with('content', $ComposedSubView)->with('module', $module)->with('sidebars', $sidebars);
        $view->with('additionalCsss', $additionalCsss);
        $view->with('additionalLibs', $additionalLibs);

        return $view;
    }

    public function listTrashMessageFrontend()
    {
        $module['Title'] = "Messages Box";
        $module['SubTitle'] = "Trash Messages";
        $module['URL'] = "/message";
        $user = Auth::user()->id;
        $inbox = DB::table('message_users')
            ->join('messages', 'messages.id', '=', 'message_users.message_id')
            ->join('users', 'users.id', '=', 'message_users.sender_id')
            ->select('users.nom as user', 'messages.*', 'message_users.*', 'messages.id as m_id')
            ->where('message_users.receiver_id','=',$user)
            ->where('message_users.status','=',2)
            ->orderBy('updated_at', 'desc')
            ->get();
        if (! $inbox){
            alert()->success('No trash babe ');
            return $this->redirectMessage();
        }
        $additionalLibs[0] = "libraries/datatables/jquery.dataTables.min.js";
        $additionalLibs[1] = "libraries/datatables/dataTables.bootstrap.min.js";
        $additionalCsss[0] = "libraries/datatables/dataTables.bootstrap.css";
        $sidebars[0] = View::make('Message::widgets.menu');

        $view = View::make('frontend.' . ConfigFromDB::setting('theme') . '.layout');
        $ComposedSubView = View::make('Message::frontend.inbox')
            ->with('inbox', $inbox);
        $view->with('content', $ComposedSubView)->with('module', $module)->with('sidebars', $sidebars);
        $view->with('additionalCsss', $additionalCsss);
        $view->with('additionalLibs', $additionalLibs);

        return $view;
    }

	public function formaddMessageFrontend(){
        $additionalCsss[0] = "libraries/select2/select2.css";

		$additionalLibs[0] = "libraries/ckeditor/ckeditor.js";
        $additionalLibs[1] = "libraries/select2/select2.min.js";
        $sidebars[0] = View::make('Message::widgets.menu');

        $module['Title'] = "Messages Box";
        $module['SubTitle'] = "Send New Message";
        $module['URL'] = "/message";
		$users = DB::table('users')->get();
		$view = View::make('frontend.' . ConfigFromDB::setting('theme') . '.layout');
		$ComposedSubView = View::make('Message::frontend.send')->with('userList', $users);
		$view->with('content', $ComposedSubView)->with('module', $module)->with('sidebars', $sidebars);
        $view->with('additionalCsss', $additionalCsss);
		$view->with('additionalLibs', $additionalLibs);

		return $view;
	}

    public function addMessageFrontend(){

        $data = Input::all();
        $sender = Auth::user()->id;
        $reveiver_ids = $data['receiverids'];
        $message = Message::create([
            'content' => $data['content'],
            'subject' => $data['subject'],
            'priority' => $data['priority'],
        ]);
        if (array_key_exists('draft', $data)){
            foreach($reveiver_ids as $receiver){
                DB::table('message_users')->insert([
                    'sender_id' => $sender,
                    'receiver_id' => $receiver,
                    'message_id' => $message->id,
                    'status' => 0,
                    'seen' => 0
                ]);
            }
            alert()->success('Message enregistre avec success');
        } else if (array_key_exists('send', $data)) {
            foreach($reveiver_ids as $receiver){
                DB::table('message_users')->insert([
                    'sender_id' => $sender,
                    'receiver_id' => $receiver,
                    'message_id' => $message->id,
                    'status' => 1,
                    'seen' => 0
                ]);
            }
            alert()->success('Message envoye avec success');
        }

        return $this->redirectMessage();
    }

    public function readInboxMessageFrontend($id){
        $user = Auth::user()->id;
        $module['Title'] = "Messages Box";
        $module['URL'] = "/message";
        $message = DB::table('message_users')
            ->join('messages', 'messages.id', '=', 'message_users.message_id')
            ->join('users', 'users.id', '=', 'message_users.sender_id')
            ->select('users.nom as user', 'messages.*', 'message_users.*')
            ->where('messages.id','=',$id)
            ->where('message_users.receiver_id','=',$user)
            ->orderBy('updated_at', 'desc')
            ->first();

        if ($message->seen == 0 and $message->status == 1){
            DB::table('message_users')->where('message_id', $id)
                ->where('receiver_id', $user)
                ->update(['seen' => 1])
                ;
        }
        $module['SubTitle'] = "Subject : ".$message->subject;
        $view = View::make('frontend.' . ConfigFromDB::setting('theme') . '.layout');
        $ComposedSubView = View::make('Message::frontend.message')->with('message', $message);
        $sidebars[0] = View::make('Message::widgets.menu');
        $view->with('content', $ComposedSubView)->with('module', $module)->with('sidebars', $sidebars);

        return $view;
    }

    public function readDraftMessageFrontend($id){
        $module['Title'] = "Messages Box";
        $module['URL'] = "/message";
        $user = Auth::user()->id;
        $sidebars[0] = View::make('Message::widgets.menu')->with('Counter',$this->SidebarBuilder());
        $message = DB::table('message_users')
            ->join('messages', 'messages.id', '=', 'message_users.message_id')
            ->join('users', 'users.id', '=', 'message_users.sender_id')
            ->select('users.nom as user', 'messages.*', 'message_users.*')
            ->where('messages.id','=',$id)
            ->where('message_users.sender_id','=',$user)
            ->where('message_users.status','=',0)
            ->orderBy('updated_at', 'desc')
            ->first();
        $module['SubTitle'] = "Subject : ".$message->subject;

        $view = View::make('frontend.' . ConfigFromDB::setting('theme') . '.layout');
        $ComposedSubView = View::make('Message::frontend.message')->with('message', $message);
        $view->with('content', $ComposedSubView)->with('module', $module)->with('sidebars', $sidebars);

        return $view;
    }

    public function readSentMessageFrontend($id){

        $user = Auth::user()->id;
        $sidebars[0] = View::make('Message::widgets.menu');
        $message = DB::table('message_users')
            ->join('messages', 'messages.id', '=', 'message_users.message_id')
            ->join('users', 'users.id', '=', 'message_users.receiver_id')
            ->select('users.nom as user', 'messages.*', 'message_users.*')
            ->where('message_users.sender_id','=',$user)
            ->where('message_users.status','=',1)
            ->where('messages.id','=',$id)
            ->orderBy('updated_at', 'desc')
            ->first();

        $module['Title'] = "Messages Box";
        $module['SubTitle'] = "Subject : ".$message->subject;
        $module['URL'] = "/message";

        $view = View::make('frontend.' . ConfigFromDB::setting('theme') . '.layout');
        $ComposedSubView = View::make('Message::frontend.message')->with('message', $message);
        $view->with('content', $ComposedSubView)->with('module', $module)->with('sidebars', $sidebars);

        return $view;
    }


}
