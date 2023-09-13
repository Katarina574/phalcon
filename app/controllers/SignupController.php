<?php

use Phalcon\Mvc\Controller;

class SignupController extends Controller
{
    public function indexAction()
    {

    }
    public function registerAction()
    {
        $allUsers = Users::find();
        $newUser = new Users();
        $newUser->assign(
            $this->request->getPost(),
            [
                'name',
                'email',
                'password'
            ]
        );
        $success = true;

        foreach ($allUsers as $user) {
            if ($user->email === $newUser->email) {
                $success = false;
                break;
            }
        }

        if ($success) {
            $success = $newUser->save();
            $message = "Thanks for registering!";
        } else {
            $message = "Greska pri registraciji. Korisnik sa tom email adresom je vec registrovan.";
        }

        $this->view->message = $message;
    }
}