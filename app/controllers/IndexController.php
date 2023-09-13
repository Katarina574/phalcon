<?php

use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        $this->view->users = Users::find();
        $message = "Hello from IndexController - test";
        $this->view->message = $message;
//        echo "Test";
    }
    public function registerAction()
    {

    }
}