<?php

namespace App\Services;

use PhpOffice\PhpSpreadsheet\Chart\Chart;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;
use PhpOffice\PhpSpreadsheet\Chart\Legend;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\Title;

class ChartsExcell
{
    private $titleSheet;
    private $index;
    private $countMaxLine;
    /**
     * @var DataSeries
     */
    private $typeChart;

    public function __construct()
    {

    }

    public function set($countMaxLine, $titleSheet = "Worksheet", $index = 1)
    {
        // pega a maior linha
        $this->countMaxLine = $countMaxLine;

        // pega o titulo da aba
        $this->titleSheet   = $titleSheet;

        // posição para começar a busca pelos dados
        $this->index        = $index;

        // default chart Pizza
        $this->typeChart = DataSeries::TYPE_PIECHART;

        return $this;
    }

    public function chart($title, $qtdLinhas, $posInicioLabel, $posInicioValue)
    {
        $indexFinal  = $this->index + $qtdLinhas - 1;

        $label      = [
            new DataSeriesValues('String', $this->titleSheet . '!$'.$posInicioLabel.'$3', null, 1),
        ];
        $categories = [
            new DataSeriesValues('String'
                , $this->titleSheet . '!$'.$posInicioLabel.'$' . $this->index . ':$'.$posInicioLabel.'$' . $indexFinal
                , null, $qtdLinhas),
        ];
        $values     = [
            new DataSeriesValues('Number'
                , $this->titleSheet . '!$'.$posInicioValue.'$' . $this->index . ':$'.$posInicioValue.'$' . $indexFinal
                , null, $qtdLinhas),
        ];

        $series = new DataSeries($this->typeChart, null,
            range(0, \count($values) - 1), $label, $categories, $values);
        $plot   = new PlotArea(null, [$series]);

        $legend = new Legend();
        $chart  = new Chart("$title", new Title("$title"), $legend, $plot);

        // montando a posição do chart
        $min = $this->countMaxLine + 8; // 3 do cabecalho + 5
        $max = $min + 15;
        $chart->setTopLeftPosition("$posInicioLabel$min");
        $chart->setBottomRightPosition("$posInicioValue$max");

        return $chart;
    }
}