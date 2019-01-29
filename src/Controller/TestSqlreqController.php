<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TestSqlreqController extends AbstractController
{
    /**
     * @Route("/test/sqlreq", name="test_sqlreq")
     */
    public function index()
    {
        return $this->render('test_sqlreq/index.html.twig', [
            'controller_name' => 'TestSqlreqController',
        ]);
    }
}
