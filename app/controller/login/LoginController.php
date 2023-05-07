<?php
namespace app\controller\login;
use app\core\Controller;
use app\classes\Input;

class LoginController extends Controller{

    //controller Login
    public $email;
    public $password;
    public function __construct(){
        $this->email = Input::post('email');
        $this->password = Input::post('senha');
        $this->email = Input::get('email');
        $this->password = Input::get('senha');
    
    }

    public function index(){
        echo $this->password;
        $this->render();
       
    }

    public function render(){
        $this->load('login/index',[
            'nome' => 'Cyber Bruno'
           ]);
    }

}