<?php namespace App\Helpers;
use DB;

class Logger
{
    public static function log($user,$action,$module,$element)
    {
        DB::table('log')->insert([
            'action' => $action,
            'user_id' => $user,
            'module_id' => $module,
            'element' => $element,
            'datetime' => date("Y-m-d H:i:s"),
        ]);
    }
}