<?php namespace SkyOJ\Core;

final class SkyOJ
{
    public $cache_pool;
    private $m_user;
    private $m_router;

    public function __construct()
    {
        global $_E,$_G,$_config;

        $db = $_config['db'];
        \SkyOJ\Core\Database\DB::$prefix = $db['tablepre'];
        \SkyOJ\Core\Database\DB::initialize($db['query_string'], $db['dbuser'], $db['dbpassword'],$db['dbname']);
        \SkyOJ\Core\Database\DB::query('SET NAMES UTF8');

        \LOG::intro();
        \DB::intro();
        \userControl::intro();

        $this->User = new \SkyOJ\Core\User\User();
        if( !$this->User->load($_G['uid']) )
        {
            if( !$this->User->loadByData(\SkyOJ\Core\User\User::getGuestData()) )
            {
                die('INIT ERROR'); #TODO;
            }
        }

        $this->m_user = $this->User;
        $this->applyRouter();
    }

    public function applyRouter()
    {
        $this->m_router = new Router\Router();
        $this->m_router->addRouter('GET','/ping',[['string','text']],'\\SkyOJ\\API\\Ping');
        $this->m_router->addRouter('GET','/api',[],'\\SkyOJ\\API\\Openapi');
        $this->addUserAPI();
        $this->addProblemAPI();
        
    }

    private function addUserAPI()
    {
        $this->m_router->addRouter('POST','/user/register',
            [['string','username'],
            ['string','password'],
            ['string','email']]
            ,'\\SkyOJ\\API\\User\\Register');
        $this->m_router->addRouter('POST','/user/login',[['string','username'],['string','password']],'\\SkyOJ\\API\\User\\Login');
        $this->m_router->addRouter('POST','/user/logout',[],'\\SkyOJ\\API\\User\\Logout');
    }

    private function addProblemAPI()
    {
        $this->m_router->addRouter('GET','/problem/list',[['int','offset'],['int','number']],'\\SkyOJ\\API\\Problem\\ListProblem');
    }

    public function getCurrentUser()
    {
        return $this->m_user;
    }

    public function getParsedAPI()
    {
        return $this->m_router->getApi();
    }

    public function run()
    {
        $res = $this->m_router->run($this);
        $json = [
            "code" => $res->code(),
            "uid"  => $this->getCurrentUser()->uid,
            "data"=> $res->data(),
        ];
        http_response_code($res->code());
        die( json_encode($json) );
    }
}