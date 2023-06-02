<?php

namespace App\Http\Controllers;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use App\Service\ExcelService;


use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function download(Request $request){
        // get file name
        $fileName = $request->file('file')->getClientOriginalName();

        //read spreadsheet
        $spreadsheet = IOFactory::load($request->file('file'));
        $activeWorksheet = $spreadsheet->getActiveSheet();

        // make cell blank
        foreach ($activeWorksheet->getRowIterator() as $key => $row) {
            foreach ($row->getCellIterator() as $cell) {
                $cell->setValue('');
            }
        }

        // write in a2 cell
        $activeWorksheet->setCellValue('A2', 'Hello World !');

        // redirect output to client browser
        ExcelService::export($fileName, $spreadsheet);
        return redirect()->back();
    }

    public function download2(Request $request){
        $text = $request->text;
        // get file name
        $fileName = $request->file('file')->getClientOriginalName();

        //read spreadsheet
        $spreadsheet = IOFactory::load($request->file('file'));
        $activeWorksheet = $spreadsheet->getActiveSheet();

        foreach ($activeWorksheet->getRowIterator() as $key => $row) {
            foreach ($row->getCellIterator() as $cell) {
                // check tagstring and write text
                $isTagString = ExcelService::isTagString($cell->getValue());
                if($isTagString){
                    $cell->setValue($text);
                } 
            }
        }

        // redirect output to client browser
        ExcelService::export($fileName, $spreadsheet);
        return redirect()->back();
    }

    public function download3(Request $request){
        $text = $request->text;
        $select = $request->select;
        $color = $request->color;
        // get file name
        $fileName = $request->file('file')->getClientOriginalName();

        //read spreadsheet
        $spreadsheet = IOFactory::load($request->file('file'));
        $activeWorksheet = $spreadsheet->getActiveSheet();

        foreach ($activeWorksheet->getRowIterator() as $key => $row) {
            foreach ($row->getCellIterator() as $cell) {
                // check tagString and get option
                $tagOption = ExcelService::isTagString($cell->getValue());
                // write text with option and color
                if($tagOption === $select){
                    $cell->setValue($text.$select);
                    $cell->getStyle()->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB($color);
                }
            }
        }

        // redirect output to client browser
        ExcelService::export($fileName, $spreadsheet);
        return redirect()->back();
    }
}