# Laravel ChartsExcell
Um pacote para simplificar a criação de gráficos dentro do excell utilizando o pacote `laravel-excell`, visto que nem a 
propria documentação do pacote fala sobre a implementação de gráficos e tão pouco encontrasse formas de implementar na internet.

### Instalação
    composer require gsferro/chartsexcell

Como o pacote usa o laravel-excell (`"maatwebsite/excel": "^3.1"`) como dependência, coloque no arquivo app.php: 

- providers
    
    
    Maatwebsite\Excel\ExcelServiceProvider::class,

- aliases
 
    
    'Excel' => Maatwebsite\Excel\Facades\Excel::class,

### Uso
- Para iniciarlizar:

    
    $createChart = chartsexcell();

#### Paramentros gerais:
- Layout
```php
/**
 * Possibilidade de mudar o layout do gráfico
 *
 * @param Layout $layout
 * @return ChartsExcell
 */
 ->setLayout(Layout $layout) // default: null
```
- porcentagem show
  > `->setLayout((new Layout())->setShowPercent(true))`
- valores show
    > `->setLayout((new Layout())->setShowVal(true))`

- Legend        
```php    
/**
 * Possibilidade de mudar a Legend
 *
 * @param Legend $legend
 * @return ChartsExcell
 */
->setLegend(Legend $legend) // default: new Legend()
```
- legenda bottom
> `->setLegend((new Legend('b'))` 

- infos gerais
```php  
/**
 * Cabelhaço do excell
 * Adicionar +1 no $index para buscar os valores
 *
 * @param int $linesHeader
 * @return ChartsExcell
 */
->setLinesHeader(int $linesHeader) // default 1
```
  
```php
/**
 * Posição para começar a busca pelos dados
 *
 * @param int $index
 * @return ChartsExcell
 */
->setIndex(int $index) // default 2
```  

```php
/**
 * Titulo da aba - (Não pode ter espaços)
 *
 * @param string $titleSheet
 * @return ChartsExcell
 */
->setTitleSheet(string $titleSheet) // default: "Worksheet"
``` 
  
```php
/**
 * Tipo do chart via DataSeries const
 *
 * @param string $typeChart DataSeries::TYPE_PIECHART / pieChart
 * @return ChartsExcell
 */
->setTypeChart(string $typeChart) // default: DataSeries::TYPE_PIECHART / pieChart
```
#### Dados do Gráfico
```php
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
->chart(string $title, int $countLines, string $columnLabel, string $columnValue) : Chart
```