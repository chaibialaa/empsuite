<?php

namespace App\Helpers;

use DB,View,Route,Auth;
class PlacementFetch
{
    public static function fetch()
    {


        $elements = DB::table('placement_elements')
            ->join('theme_placements','theme_placements.id','=','placement_elements.placement_id')
            ->join('widgets','widgets.id','=','placement_elements.widget_id')
            ->join('core_routes','core_routes.id','=','placement_elements.route_id')
            ->join('core_themes','core_themes.id','=','theme_placements.theme_id')
            ->where('core_themes.title','=',ConfigFromDB::setting('frontend_theme'))
            ->where('core_routes.route','=',Route::current()->uri())
            ->join('core_modules','core_modules.id','=','widgets.module_id')
            ->select('widgets.view as sview','placement_elements.widget_title'
                ,'core_modules.title as module','core_modules.id as cid','theme_placements.title as title',
                'widgets.id as wid','placement_elements.id as widget_id','widgets.require_login as auth')
            ->get();


        $i = 0;
        $sub = array();
        $placements = array();
        foreach ($elements as $e){
            $sub_elements = DB::table('widget_additionals')
                ->join('widgets','widgets.id','=','widget_additionals.widget_id')
                ->where('widgets.id','=',$e->wid)
                ->get();
            if($e->cid == 1){
                if($sub_elements){
                    foreach($sub_elements as $sb){
                        $sub[$sb->title] = $sb->detail;
                    }
                    if ($e->auth == 1 and Auth::check()){
                        $placements[$e->title][$i] = View::make('widgets.'.$e->sview);
                        $placements[$e->title][$i]->with('sub',$sub);
                        $placements[$e->title][$i]->with('widget_title',$e->widget_title);
                        $placements[$e->title][$i]->with('widget_id',$e->widget_id);
                    } elseif ($e->auth==0){
                        $placements[$e->title][$i] = View::make('widgets.'.$e->sview);
                        $placements[$e->title][$i]->with('sub',$sub);
                        $placements[$e->title][$i]->with('widget_title',$e->widget_title);
                        $placements[$e->title][$i]->with('widget_id',$e->widget_id);
                    }
                } else {
                    if ($e->auth == 1 and Auth::check()){
                        $placements[$e->title][$i] = View::make('widgets.'.$e->sview);
                        $placements[$e->title][$i]->with('widget_title',$e->widget_title);
                        $placements[$e->title][$i]->with('widget_id',$e->widget_id);
                    } elseif ($e->auth==0){
                        $placements[$e->title][$i] = View::make('widgets.'.$e->sview);
                        $placements[$e->title][$i]->with('widget_title',$e->widget_title);
                        $placements[$e->title][$i]->with('widget_id',$e->widget_id);
                    }
                }
            } else {
                if($sub_elements){
                    foreach($sub_elements as $sb){
                        $sub[$sb->title] = $sb->detail;
                    }
                    if ($e->auth == 1 and Auth::check()){
                        $placements[$e->title][$i] = View::make($e->module.'::widgets.'.$e->sview);
                        $placements[$e->title][$i]->with('sub',$sub);
                        $placements[$e->title][$i]->with('widget_title',$e->widget_title);
                        $placements[$e->title][$i]->with('widget_id',$e->widget_id);
                    } elseif ($e->auth==0){
                        $placements[$e->title][$i] = View::make($e->module.'::widgets.'.$e->sview);
                        $placements[$e->title][$i]->with('sub',$sub);
                        $placements[$e->title][$i]->with('widget_title',$e->widget_title);
                        $placements[$e->title][$i]->with('widget_id',$e->widget_id);
                    }
                } else {
                    if ($e->auth == 1 and Auth::check()){
                        $placements[$e->title][$i] = View::make($e->module.'::widgets.'.$e->sview);
                        $placements[$e->title][$i]->with('widget_title',$e->widget_title);
                        $placements[$e->title][$i]->with('widget_id',$e->widget_id);
                    } elseif ($e->auth==0){
                        $placements[$e->title][$i] = View::make($e->module.'::widgets.'.$e->sview);
                        $placements[$e->title][$i]->with('widget_title',$e->widget_title);
                        $placements[$e->title][$i]->with('widget_id',$e->widget_id);
                    }
                }
            }
            $i++;
        }

        return $placements;
    }
}