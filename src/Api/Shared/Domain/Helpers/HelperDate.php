<?php

namespace Src\Api\Shared\Domain\Helpers;

use DateTime;
use stdClass;

class HelperDate
{

    /**
     * Convert String to timestamp
     *
     * Ex. 20190429234640   ->   2019-04-29 23:46:40
     */
    public static function formatStringToTimestamp($strDate)
    {

        $year = substr($strDate, 0, 4);
        $month = substr($strDate, 4, 2);
        $day = substr($strDate, 6, 2);

        $hour = substr($strDate, 8, 2);
        $min = substr($strDate, 10, 2);
        $seg = substr($strDate, 12, 2);

        return $year . "-" . $month . "-" . $day. ' ' . $hour . ":" . $min . ":" . $seg;
    }



    /**
     * Convert String to timestamp
     *
     * Ex. 20190429   ->   2019-04-29
     */
    public static function formatStringToDate($strDate)
    {

        $year = substr($strDate, 0, 4);
        $month = substr($strDate, 4, 2);
        $day = substr($strDate, 6, 2);

        return $year . "-" . $month . "-" . $day;
    }




    /**
     * Convert and reverse date
     *
     * Ex. 2019-04-29   ->   29-04-2019
     *
     *
     * @param $str
     * @return string
     */
    public static function formatReverseDate($str)
    {

        $year = substr($str, 0, 4);
        $month = substr($str, 5, 2);
        $day = substr($str, 8, 2);

        return  $day . "-" . $month . "-" . $year;
    }






    /**
     * Convert date format for database Mysql
     *
     * Ex. 29-04-2019  ->  2019-04-29
     *
     *
     * @param $str
     * @return string
     */
    public static function formatDateForDB($str)
    {


        $day = substr($str, 0, 2);
        $month = substr($str, 3, 2);
        $year = substr($str, 6, 4);

        return $year. "-" . $month . "-" . $day;
    }




    /**
     * Convert date format for database Mysql
     *
     * Ex. 1/4/22  ->  2022-04-01
     *
     *
     * @param $str
     * @return string
     */
    public static function formatDateByDBShort($str)
    {
        $date = explode("/", $str);
        $day = str_pad($date[0], 2, '0', STR_PAD_LEFT);
        $month = str_pad($date[1], 2, '0', STR_PAD_LEFT);

        if(strlen($date[2]) == 4){
            $year = $date[2];
        }else{
            $year = '20' . $date[2];
        }


        return $year. "-" . $month . "-" . $day;
    }







    /**
     * Calculate days before of date
     * Ex. calculate 20 day's
     *      2019-04-10   ->   20-04-2019
     */
    public static function calculateDaysBeforeOrAfter($date, $days, $before = false)
    {
        if($before){
            return date('d-m-Y', strtotime('-'.$days.' day', strtotime($date)));
        }else{
            return date('d-m-Y', strtotime($days.' day', strtotime($date)));
        }

    }


    /**
     * Calculate days SENSE FORMAT before of date
     * Ex. calculate 20 day's
     *      2019-04-10   ->   2019-04-20
     */
    public static function calculateDaysBeforeOrAfterSenseFormat($date, $days, $before = false, $dateTime = false)
    {
        //Format date or datetimestamp
        if($dateTime){
            $format = 'Y-m-d H:i:s';
        }else{
            $format = 'Y-m-d';
        }

        if($before){
            return date($format, strtotime('-'.$days.' day', strtotime($date)));
        }else{
            return date($format, strtotime($days.' day', strtotime($date)));
        }

    }


    /**
     * Only Invoice telepass
     *
     * @param $date
     * @param $due_days
     * @return string
     */
    public static function calculateDueDate($invoice_date, $due_days)
    {

        $new_date = date("Y-m-01", strtotime($invoice_date));
        $month = date('m', strtotime($new_date . ' + 1 month'));

        if ($month == '01') {
            $year = date('Y', strtotime($new_date . ' + 1 year'));
        } else {
            $year = date('Y', strtotime($new_date));
        }

        if($due_days < 9){
            $day = '0' . $due_days;
        }else{
            $day = $due_days;
        }

        $final_date = $day . '-' . $month . '-' . $year;

        if($month == '02' && $due_days > 28){
            $final_date = '28-' . $month . '-' . $year;
        }

        return $due_days ? $final_date : $invoice_date;

    }









    /**
     * Order Array years until today Ex. [2021,2020,2019...]
     * @param $start_year
     * @return array
     */
    public static function getYearsList($start_year): array
    {

        $start_year = intval($start_year);
        $yearNow = intval(date('Y'));
        $arr = [];

        for($i=$start_year; $i <= $yearNow; $i++){
            $arr[] = $i;
        }

        rsort($arr);

        return $arr;

    }




    /**
     * Return only the month.  Ex. 6  --> June
     * @return false|string
     */
    public static function getLastMonth()
    {
        $exd_new = strtotime ( '-1 month' , strtotime(date('Y-m-d')));
        return date ( 'n' , $exd_new );
    }






    /**
     * @param $thisMonth :int
     * @param $type // short or large
     * @return string
     */
    public static function monthName($thisMonth, $type) {
        $string = '';

        switch ($thisMonth) {
            case 1:     if($type == 'short') { $string = "Ene"; } elseif ($type == 'large') { $string = "Enero"; }      break;
            case '01':     if($type == 'short') { $string = "Ene"; } elseif ($type == 'large') { $string = "Enero"; }      break;
            case 2:     if($type == 'short') { $string = "Feb"; } elseif ($type == 'large') { $string = "Febrero"; }    break;
            case '02':     if($type == 'short') { $string = "Feb"; } elseif ($type == 'large') { $string = "Febrero"; }    break;
            case 3:     if($type == 'short') { $string = "Mar"; } elseif ($type == 'large') { $string = "Marzo"; }      break;
            case '03':     if($type == 'short') { $string = "Mar"; } elseif ($type == 'large') { $string = "Marzo"; }      break;
            case 4:     if($type == 'short') { $string = "Abr"; } elseif ($type == 'large') { $string = "Abril"; }      break;
            case '04':     if($type == 'short') { $string = "Abr"; } elseif ($type == 'large') { $string = "Abril"; }      break;
            case 5:     if($type == 'short') { $string = "May"; } elseif ($type == 'large') { $string = "Mayo"; }       break;
            case '05':     if($type == 'short') { $string = "May"; } elseif ($type == 'large') { $string = "Mayo"; }       break;
            case 6:     if($type == 'short') { $string = "Jun"; } elseif ($type == 'large') { $string = "Junio"; }      break;
            case '06':     if($type == 'short') { $string = "Jun"; } elseif ($type == 'large') { $string = "Junio"; }      break;
            case 7:     if($type == 'short') { $string = "Jul"; } elseif ($type == 'large') { $string = "Julio"; }      break;
            case '07':     if($type == 'short') { $string = "Jul"; } elseif ($type == 'large') { $string = "Julio"; }      break;
            case 8:     if($type == 'short') { $string = "Ago"; } elseif ($type == 'large') { $string = "Agosto"; }     break;
            case '08':     if($type == 'short') { $string = "Ago"; } elseif ($type == 'large') { $string = "Agosto"; }     break;
            case 9:     if($type == 'short') { $string = "Sep"; } elseif ($type == 'large') { $string = "Septiembre"; } break;
            case '09':     if($type == 'short') { $string = "Sep"; } elseif ($type == 'large') { $string = "Septiembre"; } break;
            case 10:    if($type == 'short') { $string = "Oct"; } elseif ($type == 'large') { $string = "Octubre"; }    break;
            case 11:    if($type == 'short') { $string = "Nov"; } elseif ($type == 'large') { $string = "Noviembre"; }  break;
            case 12:    if($type == 'short') { $string = "Dic"; } elseif ($type == 'large') { $string = "Diciembre"; }  break;
        }

//        switch ($thisMonth) {
//            case 1:     if($type == 'short') { $string = "Ene"; } elseif ($type == 'large') { $string = "Enero"; }      break;
//            case 2:     if($type == 'short') { $string = "Feb"; } elseif ($type == 'large') { $string = "Febrero"; }    break;
//            case 3:     if($type == 'short') { $string = "Mar"; } elseif ($type == 'large') { $string = "Marzo"; }      break;
//            case 4:     if($type == 'short') { $string = "Abr"; } elseif ($type == 'large') { $string = "Abril"; }      break;
//            case 5:     if($type == 'short') { $string = "May"; } elseif ($type == 'large') { $string = "Mayo"; }       break;
//            case 6:     if($type == 'short') { $string = "Jun"; } elseif ($type == 'large') { $string = "Junio"; }      break;
//            case 7:     if($type == 'short') { $string = "Jul"; } elseif ($type == 'large') { $string = "Julio"; }      break;
//            case 8:     if($type == 'short') { $string = "Ago"; } elseif ($type == 'large') { $string = "Agosto"; }     break;
//            case 9:     if($type == 'short') { $string = "Sep"; } elseif ($type == 'large') { $string = "Septiembre"; } break;
//            case 10:    if($type == 'short') { $string = "Oct"; } elseif ($type == 'large') { $string = "Octubre"; }    break;
//            case 11:    if($type == 'short') { $string = "Nov"; } elseif ($type == 'large') { $string = "Noviembre"; }  break;
//            case 12:    if($type == 'short') { $string = "Dic"; } elseif ($type == 'large') { $string = "Diciembre"; }  break;
//        }


        return $string;
    }


    public static function uniqueFormat()
    {
        $date = DateTime::createFromFormat('U.u', microtime(TRUE));
        //dd($date->format('Y-m-d H:i:s.u'));
        //$fileName = $date->format('YmdHisu');

        return $date->format('YmdHisu');
    }


    public static function getMonthlist()
    {

        $arr = [];

        $objE = new stdClass();
        $objE->number = '01';
        $objE->text = 'ENERO';
        $arr[] = $objE;

        $objF = new stdClass();
        $objF->number = '02';
        $objF->text = 'FEBRERO';
        $arr[] = $objF;

        $objM = new stdClass();
        $objM->number = '03';
        $objM->text = 'MARZO';
        $arr[] = $objM;


        $objA = new stdClass();
        $objA->number = '04';
        $objA->text = 'ABRIL';
        $arr[] = $objA;

        $objM = new stdClass();
        $objM->number = '05';
        $objM->text = 'MAYO';
        $arr[] = $objM;

        $objJ = new stdClass();
        $objJ->number = '06';
        $objJ->text = 'JUNIO';
        $arr[] = $objJ;

        $objL = new stdClass();
        $objL->number = '07';
        $objL->text = 'JULIO';
        $arr[] = $objL;

        $objAG = new stdClass();
        $objAG->number = '08';
        $objAG->text = 'AGOSTO';
        $arr[] = $objAG;


        $objS = new stdClass();
        $objS->number = '09';
        $objS->text = 'SEPTIEMBRE';
        $arr[] = $objS;


        $objO = new stdClass();
        $objO->number = '10';
        $objO->text = 'OCTUBRE';
        $arr[] = $objO;

        $objN = new stdClass();
        $objN->number = '11';
        $objN->text = 'NOVIEMBRE';
        $arr[] = $objN;


        $objD = new stdClass();
        $objD->number = '12';
        $objD->text = 'DICIEMBRE';
        $arr[] = $objD;


        return $arr;

    }


    /**
     * Ex. '2018-01-01', 3
     * return ['2018-01-01', '2018-02-02', '2018-03-03']
     *
     * Ex. '2018-01-01', 3, TRUE
     * return ['Enero', 'Febrero', 'Marzo']
     *
     * @param $date
     * @param $monthCount
     * @param bool $isNameMonth
     * @return array
     */
    public static function findArrMonths($date, $monthCount, $isNameMonth = false)
    {

        $arr = [];

        $aux = $date;
        $arr[] = $aux;

        for ($i = 0; $i < ($monthCount - 1); $i++) {

            $exd_new = date('Y-m-d', strtotime ( '+1 month' , strtotime($aux)));
            $arr[] = $exd_new;
            $aux = $exd_new;
        }


        if($isNameMonth) {

            $arrTmp = [];
            foreach ($arr as $item) {
                $m = substr($item, 5, 2);
                $arrTmp[] = self::monthName($m, 'large');
            }

            return $arrTmp;

        }else{
            return $arr;
        }


    }




    /**
     * Find Months
     *
     * Ex. $startDate = '2018-04-01' and $months = '3'
     * -> return ['01', '04', '07', '10']
     *
     * @param $month
     * @param $starDate
     * @return array
     */
    public static function findArrMonthsByStartDate($starDate, $month)
    {

        $arrDates = [];

        $finalDate = date("Y-m-d", strtotime($starDate."+ 1 year"));
        //dd($finalDate);

        $aux = date("Y-m-d", strtotime($starDate."+ ".$month." month"));
        $arrDates[] = $aux;

        while($aux < $finalDate){
            $newDate = date("Y-m-d", strtotime($aux."+ ".$month." month"));
            $arrDates[] = $newDate;
            $aux = $newDate;
        }

        $arrMonths = [];
        foreach ($arrDates as $date) {
            $arrMonths[] = substr($date, 5, 2);
        }
        asort($arrMonths);

        return $arrMonths;

    }





    /**
     * 2022-10-01 10:00:00 and 4
     *
     * return  2022-10-01 14:00:00
     */
    public static function findDateByHour($date, $hour): string
    {
        return date("Y-m-d H:i:s", strtotime($date."+ " . $hour . " hours"));
    }



}
