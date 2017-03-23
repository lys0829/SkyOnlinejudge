<?php

if (!defined('IN_SKYOJSYSTEM')) {
    exit('Access denied');
}

class class_ACM_ICPC extends ContestManger
{
    const VERSION = '0.1-alpha';
    const NAME = 'ACM ICPC';
    const DESCRIPTION = 'ACM ICPC Style Contest';
    const COPYRIGHT = 'Sylveon';
    private $contest;

    public static function requiredFunctions():array
    {
        return [];
    }

    public static function licence_tmpl():array
    {
        return ['mit_license', 'user'];
    }

    public static function installForm():array
    {
        return [];
    }

    public static function install(&$msg):bool
    {
        return true;
    }

    public function compare(\SKYOJ\UserBlock $a,\SKYOJ\UserBlock $b)
    {
        if( $a->ac!=$b->ac ) return $b->ac<=>$a->ac;
        if( $a->ac_time!=$b->ac_time ) return $a->ac_time<=>$b->ac_time;
        return $a->total_submit<=>$b->total_submit;
    }
}
