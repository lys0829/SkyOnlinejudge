<?php namespace SKYOJ\Contest;
if (!defined('IN_SKYOJSYSTEM')) {
    exit('Access denied');
}


function ContestHandle()
{
    global $SkyOJ,$_E;
    require_once $_E['ROOT'].'/function/common/contest.php';
    require_once $_E['ROOT'].'/function/common/problem.php';
    require_once $_E['ROOT'].'/function/contest/contest.lib.php';

    $param = $SkyOJ->UriParam(1)??'list';
    switch( $param )
    {
        case 'view':
        case 'new':
        case 'modify':
        case 'register':
        case 'scoreboard':
        case 'scoreboard_resolver':
        case 'list':
        case 'resolver':
        case 'balloon':
            break;
        
        case 'api'://cbfetch
            break;
        default:
            \Render::render('nonedefined');
            exit(0);
    }

    $funcpath = $_E['ROOT']."/function/contest/contest_$param.php";
    $func     = __NAMESPACE__ ."\\{$param}Handle";

    require_once($funcpath);
    $func();
}
