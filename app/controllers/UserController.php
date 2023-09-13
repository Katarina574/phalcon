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
            $user->assign(
                $this->request->getPost(),
                [
                    'name',
                    'email',
                    'password',
                ]
            );

            if ($user->save()) {
                echo("Korisnik uspesno sacuvan.");
//                $this->response->redirect("/"); // Redirect to the list page
            } else {
                echo "Greska prilikom cuvanja korisnika";
            }
        }
        $this->view->user = $user;
    }

//    public function testAction() {
//        $message = "Ovo je poruka iz test akcije";
//        $this->view->user = $message;
//    }

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