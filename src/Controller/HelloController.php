<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class HelloController extends AbstractController
{

    protected $calculator;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @Route("/hello/{prenom?world}", name="hello")
     */
    public function hello($prenom)
    {
        return $this->render('hello.html.twig', [
            'prenoms' => $prenom,
        ]);
    }

    /**
     * @Route("/exemple", name="exemple")
     */
    public function exemple() 
    {
        return $this->render('exemple.html.twig', [
            'age' => 30
        ]);
    }
}