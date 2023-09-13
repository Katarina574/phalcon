<?php

use Phalcon\Mvc\Controller;

class NewkatarinaController extends Controller
{
    public function indexAction()
    {
        $message = "Hello from NewkatarinaController";
        $this->view->message = $message;
        $this->view->users = Users::find();
//        echo "Test";
    }
}