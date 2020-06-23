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
    private $typeChart;
    /**
     * @var int
     */
    private $index;
    private $countMaxLine;
    private $linesHeader;

    public function __construct()
    {
        // Cabelhaço do excell
        $this->linesHeader = 1;
        // posição para começar a busca pelos dados
        $this->index = 2; // $this->linesHeader + 1
        // titulo da aba
        $this->titleSheet = "Worksheet";
        // default chart Pizza
        $this->typeChart = DataSeries::TYPE_PIECHART; // pieChart
    }

    /**
     * Monta o grafico
     *
     * @param string $title       "Titulo do gráfico"
     * @param int $countLines     "Qtde linhas de registro"
     * @param string $columnLabel "Letra da Coluna para os labels do chart"
     * @param string $columnValue "Letra da Coluna para os valores do chart"
     *
     * @return Chart
     */
    public function chart(string $title, int $countLines, string $columnLabel, string $columnValue) : Chart
    {
        $indexFinal  = $this->index + $countLines - 1;

        $label      = [
            new DataSeriesValues('String'
                , $this->titleSheet . '!$'.$columnLabel.'$'. $this->linesHeader
                , null, 1),
        ];
        $categories = [
            new DataSeriesValues('String'
                , $this->titleSheet . '!$'.$columnLabel.'$' . $this->index . ':$'.$columnLabel.'$' . $indexFinal
                , null, $countLines),
        ];
        $values     = [
            new DataSeriesValues('Number'
                , $this->titleSheet . '!$'.$columnValue.'$' . $this->index . ':$'.$columnValue.'$' . $indexFinal
                , null, $countLines),
        ];

        $series = new DataSeries($this->typeChart, null,
            range(0, \count($values) - 1), $label, $categories, $values);
        $plot   = new PlotArea(null, [$series]);

        $legend = new Legend();
        return new Chart("$title", new Title("$title"), $legend, $plot);
    }

    /**
     * Posição para começar a busca pelos dados
     *
     * @param int $index
     * @return ChartsExcell
     */
    public function setIndex(int $index)
    {
        $this->index = $index;

        return $this;
    }

    /**
     * Cabelhaço do excell
     * Adicionar +1 no $index para buscar os valores
     *
     * @param int $linesHeader
     * @return ChartsExcell
     */
    public function setLinesHeader(int $linesHeader)
    {
        $this->linesHeader = $linesHeader;
        $this->setIndex($linesHeader + 1);

        return $this;
    }

    /**
     * Titulo da aba - (Não pode ter espaços)
     *
     * @param string $titleSheet
     * @return ChartsExcell
     */
    public function setTitleSheet(string $titleSheet)
    {
        $this->titleSheet = trim($titleSheet);

        return $this;
    }

    /**
     * Tipo do chart via DataSeries const
     *
     * @param string $typeChart DataSeries::TYPE_PIECHART / pieChart
     * @return ChartsExcell
     */
    public function setTypeChart(string $typeChart)
    {
        $this->typeChart = $typeChart;

        return $this;
    }
}