<?php
namespace app\controller\login;
use app\core\Controller;
class LoginController extends Controller{

    // Main of the Project
    public function __construct(){
     
    }

    public function index(){
        
       $this->load('login/index',[
        'nome' => 'Cyber Bruno'
       ]);
    }

}