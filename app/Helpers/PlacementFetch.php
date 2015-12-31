<?php

namespace App\Helpers;

use DB,View;
class PlacementFetch
{
    public static function fetch($id)
    {

        $elements = DB::table('placement_elements')
            ->join('theme_placements','theme_placements.id','=','placement_elements.placement_id')
            ->join('widgets','widgets.id','=','placement_elements.widget_id')
            ->join('core_themes','core_themes.id','=','theme_placements.theme_id')
            ->where('core_themes.title','=',ConfigFromDB::setting('frontend_theme'))
            ->where('placement_elements.module_id','=',$id)
            ->join('core_modules','core_modules.id','=','widgets.module_id')
            ->select('widgets.view as sview','core_modules.title as module','core_modules.id as cid','theme_placements.title as title','widgets.id as wid')
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
                    $placements[$e->title][$i] = View::make('widgets.'.$e->sview)->with('sub',$sub);
                } else {
                    $placements[$e->title][$i] = View::make('widgets.' . $e->sview);
                }
            } else {
                if($sub_elements){
                    foreach($sub_elements as $sb){
                        $sub[$sb->title] = $sb->detail;
                    }
                    $placements[$e->title][$i] = View::make($e->module.'::widgets.'.$e->sview)->with('sub',$sub);
                } else {
                $placements[$e->title][$i] = View::make($e->module.'::widgets.'.$e->sview);
                }
            }
            $i++;
        }

        return $placements;
    }
}