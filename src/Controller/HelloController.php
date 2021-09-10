<?php

namespace App\Controller;

use Twig\Environment;
use App\Taxes\Calculator;
use App\Taxes\Detector;
use Cocur\Slugify\Slugify;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HelloController extends AbstractController
{

    protected $calculator;

    public function __construct(LoggerInterface $logger, Calculator $calculator)
    {
        $this->logger = $logger;
        $this->calculator = $calculator;

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