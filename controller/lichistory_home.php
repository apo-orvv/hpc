<?php

class Home 
{
    public function index()
    {
        $filename = 'view/lichistory_home.view.php';
        require $filename;
    }
}

$obj = new Home;
$obj->index();