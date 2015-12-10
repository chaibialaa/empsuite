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
            $core = DB::table('core')->count();
            if ( $core == 1)
            {
                $setting = DB::table('core')->select()->first();
                if ($setting)
                {
                    $columns = Schema::getColumnListing('core');
                    foreach ($columns as $column) {
                        Cache::forever('core_' . $column, $setting->$column);
                    }
                    $setting = Cache::get('core_' . $option);
                }

                else $setting = null;


            }elseif ($option == 'theme'){
               $setting = 'default';
            } else $setting = null;

        }

        return $setting;
    }

}