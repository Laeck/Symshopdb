<?php

namespace App\Controller;

use Twig\Environment;
use App\Taxes\Calculator;
use Cocur\Slugify\Slugify;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController
{

    protected $calculator;

    public function __construct(LoggerInterface $logger, Calculator $calculator)
    {
        $this->logger = $logger;
        $this->calculator = $calculator;
    }

    /**
     * @Route("/hello/{name?world}", name="hello")
     */
    public function hello($name, Slugify $slugify, Environment $twig)
    {

        dump($twig);
        
        dump($slugify->slugify('Hello world'));

        $this->logger->error("Message de log");

        $tva = $this->calculator->calcul(150);

        dd($tva);

        return new Response("Hello $name");
    }
}