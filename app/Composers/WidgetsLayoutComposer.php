<?php

namespace App\Composers;

use Illuminate\Support\ServiceProvider;
use Auth, DB;
class WidgetsLayoutComposer extends ServiceProvider
{

       public function boot()
    {

        //Messages Menu Widget
        view()->composer('Message::widgets.menu', function ($view)   {
            $user = Auth::user()->id;
            $Sidebar['inboxCount'] = DB::table('message_users')
                ->join('messages', 'messages.id', '=', 'message_users.message_id')
                ->join('users', 'users.id', '=', 'message_users.sender_id')
                ->select('users.nom as user', 'messages.*', 'message_users.*', 'messages.id as m_id')
                ->where('message_users.receiver_id','=',$user)
                ->where('message_users.status','=',1)
                ->count();
            $Sidebar['sentCount'] = DB::table('message_users')
                ->join('messages', 'messages.id', '=', 'message_users.message_id')
                ->join('users', 'users.id', '=', 'message_users.receiver_id')
                ->select('users.nom as user', 'messages.*', 'message_users.*')
                ->where('message_users.sender_id','=',$user)
                ->where('message_users.status','=',1)
                ->count();
            $Sidebar['newCount'] = DB::table('message_users')
                ->join('messages', 'messages.id', '=', 'message_users.message_id')
                ->join('users', 'users.id', '=', 'message_users.sender_id')
                ->select('users.nom as user', 'messages.*', 'message_users.*', 'messages.id as m_id')
                ->where('message_users.receiver_id','=',$user)
                ->where('message_users.status','=',1)
                ->where('message_users.seen','=',0)
                ->count();
            $Sidebar['draftCount'] = DB::table('message_users')
                ->join('messages', 'messages.id', '=', 'message_users.message_id')
                ->join('users', 'users.id', '=', 'message_users.receiver_id')
                ->select('users.nom as user', 'messages.*', 'message_users.*','messages.id as m_id')
                ->where('message_users.sender_id','=',$user)
                ->where('message_users.status','=',0)
                ->count();

            $view->with('Counter',$Sidebar);


        });

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}