<?php

namespace Gsferro\ChartsExcell\Services;

use PhpOffice\PhpSpreadsheet\Chart\Chart;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;
use PhpOffice\PhpSpreadsheet\Chart\Legend;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\Title;

class ChartsExcell
{
    /**
     * @var string
     */
    private $titleSheet;
    /**
     * @var int
     */
    private $index;
    private $countMaxLine;
    private $linesHeader;
    /**
     * @var DataSeries
     */
    private $typeChart;

    public function __construct()
    {
        // Linha do maior resultado
        $this->countMaxLine = 1;
        // Cabelhaço do excell
        $this->linesHeader = 1;
        // posição para começar a busca pelos dados
        $this->index = 1;
        // titulo da aba
        $this->titleSheet = "Worksheet";
        // default chart Pizza
        $this->typeChart = DataSeries::TYPE_PIECHART;
    }

    /**
     * Linha do maior resultado
     *
     * @param int $countMaxLine
     */
    public function setCountMaxLine(int $countMaxLine): void
    {
        $this->countMaxLine = $countMaxLine;
    }

    /**
     * Posição para começar a busca pelos dados
     *
     * @param int $index
     */
    public function setIndex(int $index): void
    {
        $this->index = $index;
    }

    /**
     * Cabelhaço do excell
     *
     * @param int $linesHeader
     */
    public function setLinesHeader(int $linesHeader): void
    {
        $this->linesHeader = $linesHeader;
    }

    /**
     * Titulo da aba - (Não pode ter espaços)
     *
     * @param string $titleSheet
     */
    public function setTitleSheet(string $titleSheet): void
    {
        $this->titleSheet = trim($titleSheet);
    }
    /**
     * Tipo do chart via DataSeries const
     *
     * @param DataSeries $typeChart
     */
    public function setTypeChart(DataSeries $typeChart): void
    {
        $this->typeChart = $typeChart;
    }

    /**
     * Monta o grafico
     *
     * @param string $title "Titulo do gráfico"
     * @param int $countLines "Qtde linhas de registro"
     * @param string $columnBeginLabel "Letra da Coluna para os labels do chart"
     * @param string $columnBeginValue "Letra da Coluna para os valores do chart"
     *
     * @return Chart
     */
    public function chart(string $title, int $countLines, string $columnBeginLabel, string $columnBeginValue) : Chart
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
        return new Chart("$title", new Title("$title"), $legend, $plot);
    }
}