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
                    ->select()
                    ->first();

                if ($setting)
                {
                    $columns = Schema::getColumnListing('core');
                    foreach ($columns as $column) {
                        if ($column == "backend_theme") {
                            $additional = DB::table('themes')
                                ->where('id', '=', $setting->backend_theme)
                                ->select()
                                ->first();
                            Cache::forever('core_' . $column, $additional->title);
                        } elseif ($column == "frontend_theme") {
                            $additional = DB::table('themes')
                                ->where('id', '=', $setting->frontend_theme)
                                ->select()
                                ->first();
                            Cache::forever('core_' . $column, $additional->title);
                        } else {
                            Cache::forever('core_' . $column, $setting->$column);
                        }
                    }
                    $setting = Cache::get('core_' . $option);
                }

                else $setting = null;


        }

        return $setting;
    }


}