<?php
namespace App\Helpers;
use DB;
use Cache;
use Schema;
class ConfigFromDB {
     public static function setting($option)
    {
        if (Cache::has('core_' . $option))
        {
            $setting = Cache::get('core_' . $option);
        }
        else
        {

                $setting = DB::table('core')
                    ->join('themes AS T1','T1.id','=','core.backend_theme')
                    ->join('themes AS T2','T2.id','=','core.frontend_theme')
                    ->select('core.id as id','core.catchmail as catchmail','core.title as title',
                        'T2.title as frontend_theme','T1.title as backend_theme','core.created_at','core.updated_at')
                    ->first();

                if ($setting)
                {
                    $columns = Schema::getColumnListing('core');
                    foreach ($columns as $column) {

                            Cache::forever('core_' . $column, $setting->$column);
                    }
                    $setting = Cache::get('core_' . $option);
                }

                else $setting = null;


        }

        return $setting;
    }


}