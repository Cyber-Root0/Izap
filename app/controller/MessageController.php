<?php
namespace app\controller;
use app\core\Controller;
class MessageController extends Controller{

    // Main of the Project
    public function __construct(){
     
    }

    public function message404(string $title, string $message){
        $this->load('message/main',[
            'title' => $title,
            'message' => $message
           ]);
    }

    

}