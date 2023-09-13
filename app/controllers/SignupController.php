<?php

use Phalcon\Mvc\Controller;

class SignupController extends Controller
{
    public function indexAction()
    {

    }
    public function registerAction()
    {
        $user = new Users();
        $user->assign(
            $this->request->getPost(),
            [
                'name',
                'email',
                'password'
            ]
        );

        $success = $user->save();

        if ($success) {
            $message = "Thanks for registering!";
        } else {
            $message = "Greska pri registraciji;";
        }

        $this->view->message = $message;
    }
}