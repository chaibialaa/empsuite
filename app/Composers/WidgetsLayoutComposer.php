<?php

namespace App\Composers;

use Illuminate\Support\ServiceProvider;
use Auth, DB, App\Modules\Notice\Controllers\NoticeController;
class WidgetsLayoutComposer extends ServiceProvider
{

       public function boot()
    {
        view()->composer('widgets.languages', function ($view)   {
            $languages = DB::table('core_languages')
                ->where('status', '=', 1)
                ->get();
            $view->with('languages', $languages);

        });

        view()->composer('Notice::widgets.flexslider', function ($view)   {
            $notices = DB::table('notices')
                ->join('users', 'users.id', '=', 'notices.user_id')
                ->join('notice_categories', 'notice_categories.id', '=', 'notices.category_id')
                ->select('notices.*', 'users.nom', 'notice_categories.title as title_cat')
                ->where('end_at', '>', date('Y-m-d'))
                ->orderBy('created_at', 'desc')
                ->limit(4)
                ->get();

            $view->with('notices', $notices);

        });
        //Messages Menu Widget
        view()->composer('Message::widgets.menu', function ($view)   {

            $user = Auth::user()->id;
            $Count['inboxCount'] = DB::table('message_users')
                ->join('messages', 'messages.id', '=', 'message_users.message_id')
                ->join('users', 'users.id', '=', 'message_users.sender_id')
                ->select('users.nom as user', 'messages.*', 'message_users.*', 'messages.id as m_id')
                ->where('message_users.receiver_id','=',$user)
                ->where('message_users.status','=',1)
                ->count();
            $Count['sentCount'] = DB::table('message_users')
                ->join('messages', 'messages.id', '=', 'message_users.message_id')
                ->join('users', 'users.id', '=', 'message_users.receiver_id')
                ->select('users.nom as user', 'messages.*', 'message_users.*')
                ->where('message_users.sender_id','=',$user)
                ->where('message_users.status','=',1)
                ->count();
            $Count['newCount'] = DB::table('message_users')
                ->join('messages', 'messages.id', '=', 'message_users.message_id')
                ->join('users', 'users.id', '=', 'message_users.sender_id')
                ->select('users.nom as user', 'messages.*', 'message_users.*', 'messages.id as m_id')
                ->where('message_users.receiver_id','=',$user)
                ->where('message_users.status','=',1)
                ->where('message_users.seen','=',0)
                ->count();
            $Count['draftCount'] = DB::table('message_users')
                ->join('messages', 'messages.id', '=', 'message_users.message_id')
                ->join('users', 'users.id', '=', 'message_users.receiver_id')
                ->select('users.nom as user', 'messages.*', 'message_users.*','messages.id as m_id')
                ->where('message_users.sender_id','=',$user)
                ->where('message_users.status','=',0)
                ->count();

            $view->with('Counter',$Count);


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