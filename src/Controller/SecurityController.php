<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2021-07-06
 * Time: 11:45
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    /**
     * @Route("/api/login_check", name="api_login_check")
     */
    public function login(){
        return new \Symfony\Component\HttpFoundation\Response("test");
    }

}
