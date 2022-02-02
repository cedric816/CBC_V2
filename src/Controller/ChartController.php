<?php

namespace App\Controller;

use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class ChartController extends AbstractController
{
    /**
     * @Route("/chart", name="chart")
     */
    public function index(ChartBuilderInterface $chartBuilder): Response
    {
        $chartLine = $chartBuilder->createChart('line');

        $chartLine->setData([
            'labels' => ['01 jan', '02 jan', '03 jan', '04 jan', '05 jan', '06 jan', '07 jan'],
            'datasets' => [
                [
                    'label' => 'Ventes produit A',
                    'borderColor' => 'rgb(255,99,132)',
                    'data' => [10,20,30,10,40,50,40]
                ],
                [
                    'label' => 'Ventes produit B',
                    'borderColor' => 'rgb(57,73,171)',
                    'data' => [40,30,20,40,40,50,20]
                ]
            ]
        ]);

        $chartLine->setOptions([
            'scales' => [
                'y' => [
                    'suggestedMin' => 0,
                    'suggestedMax' => 70,
                ],
            ],
        ]);

        $chartBar = $chartBuilder->createChart('bar');

        $chartBar->setData([
            'labels' => ['01 jan', '02 jan', '03 jan', '04 jan', '05 jan', '06 jan', '07 jan'],
            'datasets' => [
                [
                    'label' => 'Ventes produit A',
                    'backgroundColor' => 'rgb(255,99,132)',
                    'data' => [10,20,30,10,40,50,40]
                ],
                [
                    'label' => 'Ventes produit B',
                    'backgroundColor' => 'rgb(57,73,171)',
                    'data' => [40,30,20,40,40,50,20]
                ]
            ]
        ]);

        $chartBar->setOptions([
            'scales' => [
                'y' => [
                    'suggestedMin' => 0,
                    'suggestedMax' => 70,
                ],
            ],
        ]);

        return $this->render('chart/index.html.twig', [
            'chartLine' => $chartLine,
            'chartBar' => $chartBar
        ]);
    }
}
