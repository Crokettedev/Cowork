<?php

namespace App\Controller;


use App\Repository\CommandRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CommandController extends AbstractController
{
    private $command;

    public function __construct(CommandRepository $commandRepository)
    {
        $this->command = $commandRepository;
    }



}