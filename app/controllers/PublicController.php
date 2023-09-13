<?php

namespace Katarina\Phalcon\controllers;

use Phalcon\Mvc\Controller;
use Users;

class PublicController extends Controller
{
    public function indexAction()
    {
        echo "Hello from public controller";
    }

    public function registerAction()
    {

    }
}