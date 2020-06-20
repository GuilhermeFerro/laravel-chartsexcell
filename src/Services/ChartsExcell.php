<?php

namespace Gsferro\ChartsExcell;

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
    private $linesHeader;
    /**
     * @var DataSeries
     */
    private $typeChart;

    public function __construct()
    {

    }

    public function set($countMaxLine = 0, $linesHeader = 1, $titleSheet = "Worksheet", $index = 1)
    {
        // pega a maior linha
        $this->countMaxLine = $countMaxLine;

        // pega a maior linha
        $this->linesHeader = $linesHeader;

        // pega o titulo da aba
        $this->titleSheet   = $titleSheet;

        // posição para começar a busca pelos dados
        $this->index        = $index;

        // default chart Pizza
        $this->typeChart = DataSeries::TYPE_PIECHART;

        return $this;
    }

    public function chart($title, $countLines, $columnBeginLabel, $columnBeginValue, $colummChartBegin, $columnChartEnd)
    {
        $indexFinal  = $this->index + $countLines - 1;

        $label      = [
            new DataSeriesValues('String', $this->titleSheet . '!$'.$columnBeginLabel.'$'. $this->linesHeader, null, 1),
        ];
        $categories = [
            new DataSeriesValues('String'
                , $this->titleSheet . '!$'.$columnBeginLabel.'$' . $this->index . ':$'.$columnBeginLabel.'$' . $indexFinal
                , null, $countLines),
        ];
        $values     = [
            new DataSeriesValues('Number'
                , $this->titleSheet . '!$'.$columnBeginValue.'$' . $this->index . ':$'.$columnBeginValue.'$' . $indexFinal
                , null, $countLines),
        ];

        $series = new DataSeries($this->typeChart, null,
            range(0, \count($values) - 1), $label, $categories, $values);
        $plot   = new PlotArea(null, [$series]);

        $legend = new Legend();
        $chart  = new Chart("$title", new Title("$title"), $legend, $plot);

        // montando a posição do chart
        $min = $this->linesHeader + 8; // 3 do cabecalho + 5
        $max = $min + 15;


        $chart->setTopLeftPosition( $colummChartBegin . $min );
        $chart->setBottomRightPosition( $columnChartEnd . $max );

        return $chart;
    }
}