<?php

namespace SrkGrid\GridView\Excel;

use SrkGrid\GridView\Core\CoreProcessElement;
use SrkGrid\GridView\Core\ExcelConfig;
use SrkGrid\GridView\Factory;
use SrkGrid\GridView\Html\RawHtml;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

trait ExportExcel
{
    use CoreProcessElement, ExcelConfig;


    /**
     * @var Spreadsheet
     */
    protected $spreadsheet;

    /**
     * @var object
     */
    protected $sheet;


    /**
     * set permission create excel true
     *
     * @param string $fileName
     * @return $this
     */
    public function makeExcel($fileName)
    {
        $this->createExcel = true;

        $this->fileName = $fileName;

        return $this;
    }

    /**
     * create instance of Spreadsheet class
     */
    protected function spreadsheet()
    {
        $this->spreadsheet = new Spreadsheet();

        $this->sheet = $this->spreadsheet->getActiveSheet();

        $this->excelFileConfig();
    }

    /**
     * set config for excel file
     */
    protected function excelFileConfig()
    {
        if ($this->excelDirection == 'rtl')
            $this->sheet->setRightToLeft(true);
    }

    /**
     * create header excel column
     */
    protected function createHeaderExcel()
    {
        $this->spreadsheet();

        collect($this->headerExcelName)->each(function ($v, $k) {

            $this->sheet->setCellValue($this->alphabet[($k)] . '1', $v);

        });
    }

    /**
     * create body excel
     */
    protected function createBodyExcel()
    {
        $i = 2;

        foreach ($this->data->get() as $data) {

            $j = 0;

            foreach ($this->bodyExcel as $item) {

                $value = ($item instanceof \Closure) ? call_user_func($item, $data) : ($data->$item);

                $this->sheet->setCellValue($this->alphabet[$j] . $i, $value);

                $j++;
            }
            $i++;
        }
    }

    protected function downloadExcel()
    {
        if (request('excel') == true) {

            $this->createExcel();

            $this->setHeaderForDownload();

            $writer = new Xlsx($this->spreadsheet);

            $writer->save('php://output');

            exit();
        }

    }

    /**
     * create excel header and body
     */
    protected function createExcel()
    {
        $this->createHeaderExcel();

        $this->createBodyExcel();
    }

    /**
     * set header for download file
     */
    protected function setHeaderForDownload()
    {
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=\"{$this->fileName}.xlsx\"");
        header('Cache-Control: max-age=0');
    }


    protected function createButtonExcel()
    {
        if ($this->createExcel) {

            /** @var RawHtml $html */
            $html = Factory::make(RawHtml::class);

            $html = $html
                ->startDiv($this->parentButtonAttr)
                ->a($this->getAttributeButtonExcel(), $this->innerHtmlButtonExcel)
                ->endDiv()
                ->getHtml();

            return $html;
        }
    }

    /**
     * route excel
     *
     * @return string
     */
    protected function getRouteExcel()
    {
        $queryString = collect(request()->query())->merge(['excel' => 'true'])->toArray();

        $routeExcel = http_build_query($queryString);

        return $routeExcel;
    }

    /**
     * get attribute button excel
     *
     * @return array
     */
    protected function getAttributeButtonExcel()
    {
        return collect($this->buttonExcelAttribute)->merge(['href' => '?' . $this->getRouteExcel()])->toArray();
    }
}
