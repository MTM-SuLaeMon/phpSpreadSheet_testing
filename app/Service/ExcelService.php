<?php

namespace App\Service;
use PhpOffice\PhpSpreadsheet\IOFactory;


/**
 * 職長関連の共通サービス
 */
class ExcelService
{
    public static function isTagString($tagString)
    {
        // check string start and end  with "#"
        $startChar = mb_substr($tagString, 0, 1);
        $endChar = mb_substr($tagString, -1);
        if ($startChar !== "#" || $endChar !== "#") {
            return false;
        }

        $tags = explode('.', $tagString);
        // check tagString has 3 part
        if (isset($tags) && count($tags) === 3 ) {
            return true;
        }

        // check tagString has 4 part
        if (isset($tags) && count($tags) === 4 ) {
            $option = mb_substr($tags[3], 0, -1);
            return $option;
        }

        return false;
    }

    public static function export($fileName, $spreadsheet)
    {
        // set header
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=" . $fileName);
        header('Cache-Control: max-age=0');

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit();
    }
}
