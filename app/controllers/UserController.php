<?php

use Phalcon\Mvc\Controller;

class UserController extends Controller
{
    public function indexAction($id)
    {
        $user = Users::findFirstById($id);
        $this->view->user = $user;
    }

    public function editAction($id)
    {
        $user = Users::findFirstById($id);
        $this->view->user = $user;
    }

    public function updateAction($id) //ovde se obradjuje sta nam treba odn. cuva podatke na save tj menja u bazi
    {
        $user = Users::findFirstById($id);

        if ($this->request->isPost()) {
            $newName = $this->request->getPost('name');
            $newEmail = $this->request->getPost('email');
            $newPassword = $this->request->getPost('password');

            $changes = false;

            if ($newName !== $user->name) {
                $changes = true;
                $user->name = $newName;
            }

            if ($newEmail !== $user->email) {
                $user->email = $newEmail;
                $changes = true;
            }

            if ($newPassword !== $user->password) {
                $user->password = $newPassword;
                $changes = true;
                $this->view->user = $user;
            }
            if ($changes && $user->save()) {
                echo "Korisnik sacuvan.";
            }
            else {
                echo "Nije bilo promena. Greska prilikom cuvanja.";
            }
        }
    }

    public function testAction()
    {
        $message = "Ovo je poruka iz test akcije";
        $this->view->user = $message;
    }

    public function viewAction($id)
    {
        echo "Trigerovan view", $id;
        $user = Users::findFirstById($id);
        $this->view->user = $user;
        echo $user->name;
    }

    public function deleteAction($id)
    {
        $user = Users::findFirstById($id);

        if ($user) {
            if ($user->delete()) {
                echo "korisnik uspesno obrisan";
            } else {
                echo "Greska u brisanju";
            }
        } else {
            echo "Korisnik nije nadjen";
        }
    }
}