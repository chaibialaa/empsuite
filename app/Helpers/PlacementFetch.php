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
            ->select('widgets.view as sview','core_modules.title as module','theme_placements.title as title')
            ->get();


        $i = 0;
        $placements = array();
        foreach ($elements as $e){
            $placements[$e->title][$i] = View::make($e->module.'::widgets.'.$e->sview);
            $i++;
        }

        return $placements;
    }
}