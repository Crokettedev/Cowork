<?php

namespace App\Controller;

use mysql_xdevapi\Exception;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CalendarController extends AbstractController
{
    private $mouths = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
    private $mouth;
    private $year;

    /**
     * @Route("/calendar", name="calendar")
     * CalendarController constructor.
     * @param Integer $month Le mois compris entre 1 et 12
     * @param Integer $year L'année
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(?Integer $month = null, ?Integer $year = null)
    {
        if ($this->mouth === null)
        {
            $this->mouth = intval(date('m'));
        }

        if ($this->year === null)
        {
            $this->year = intval(date('Y'));
        }


        $this->mouth = $month;
        $this->year = $year;

        return $this->render('calendar/index.html.twig', [
            'controller_name' => 'CalendarController',
            'show' => $this->__toString($month),
        ]);
    }

    public function __toString()
    {
        return (string) $this->mouths[$this->mouth -1] . '' . $this->year;
    }
}
