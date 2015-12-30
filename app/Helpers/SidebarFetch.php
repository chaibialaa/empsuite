<?php

namespace App\Helpers;

use DB,View;
class SidebarFetch
{
    public static function fetch($id)
    {
        $elements = DB::table('sidebar_elements')
            ->join('sidebars','sidebars.id','=','sidebar_elements.sidebar_id')
            ->join('widgets','widgets.id','=','sidebar_elements.widget_id')
            ->where('sidebars.status','=',1)
            ->where('sidebar_elements.module_id','=',$id)
            ->join('core_modules','core_modules.id','=','widgets.module_id')
            ->select('widgets.view as sview','core_modules.title as module')
            ->get();


        $i = 0;
        $sidebars = array();
        foreach ($elements as $e){
            $sidebars[$i] = View::make($e->module.'::widgets.'.$e->sview);
            $i++;
        }
        return $sidebars;
    }
}