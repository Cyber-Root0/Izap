<?php

$this->get('', function(){
    echo "Estou na area da home";
});
$this->get('/login', 'login\\LoginController@index');



