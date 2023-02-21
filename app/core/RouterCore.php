<?php
namespace app\core;
class RouterCore{

    private $uri;
    private $method;
    private $getArr = [];

    public function __construct(){
       $this->initialize();
       require_once('../app/config/Router.php');
       $this->execute();

    }

    private function initialize(){

        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->uri = $_SERVER['REQUEST_URI'];
        $ex = explode('/',$this->uri);
        
        $uri = $this->normalizeURI($ex);
        
        for($i = 0; $i< UNSET_URI_COUNT; $i++){
            unset($uri[$i]);
        }
        $uri = $this->normalizeURI($uri);
        //$this->uri = implode('/', $this->normalizeURI($uri));
       // $uri = $this->uri;
        if (DEBUG_URI)
            dd($uri);
        
    }

    private function execute(){
        switch($this->method){
            case 'GET':
                $this->executeGet();
                break;
            case 'POST':
                break;
        }
    }

    private function executeGet(){
        
        foreach($this->getArr as $get){
           //dd($get,false);
           //echo $get['router'] . ' - '.$this->uri.'<br>';
           if ($get['router'] == $this->uri || $get['router'].'/' == $this->uri ){
                if (is_callable($get['call'])){
                    $get['call']();
                    break;
                }else{
                    $this->executeController($get['call']);
                    
                }
                break;
           }
           
        }
    }
    private function executeController($get){
        $ex = explode("@",$get);
       // dd($ex);
        if (!isset($ex[0]) || !isset($ex[1]) ){
            (new \app\controller\MessageController)->message404('404','Essa Controller, ou método não existe.');
            return;
        }

        $const = 'app\\controller\\'.$ex[0];
        //dd($const);
        if (!class_exists($const)){
            (new \app\controller\MessageController)->message404('404','controller não existe.');
            return;
        }
        if (!method_exists($const,$ex[1])){
            (new \app\controller\MessageController)->message404('404','método não existe.');
            return;
        }

        call_user_func_array([
            new $const,
            $ex[1]
           ],[]);
           
        
       // dd($ex);
        
    }

    private function get($router,$call){
        $this->getArr [] = [
            'router' => $router,
            'call' => $call
        ];

    }

    private function normalizeURI($arr){
        return array_values( array_filter($arr) );

    }
}