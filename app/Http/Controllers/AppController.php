<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ICal;
use App\Calendar;
use Datetime;

class AppController extends Controller
{
    public function cronData(){
    	date_default_timezone_set('Asia/Ho_Chi_Minh');

    	$ical   = new ICal('../ical.ics');
    	$events = $ical->events();
    	$data= [];
    	foreach ($events as $event) {
    		$start= $ical->iCalDateToUnixTimestamp($event['DTSTART']);
    		$end= $ical->iCalDateToUnixTimestamp($event['DTEND']);
    		$item =[];
    		$item['uid'] = $event['UID'];
    		$item['summary'] = $event['SUMMARY'];
    		$item['start'] = $start;
    		$item['end'] = $end;

    		$data[] = $item;
    	}

    	$this->saveDataCalendar($data);
    }
    public function saveDataCalendar($data){

        foreach ($data as  $value) {
            $calendar = new Calendar;
            $calendar->uid = $value['uid'];
            $calendar->summary = $value['summary'];
            $calendar->start = $value['start'];
            $calendar->end = $value['end'];
            $calendar->year = date('Y',time());
            $calendar->difference = 0;
            $calendar->created_at = new Datetime();
            $calendar->save();
        }
        
    }
    public function getDataCalendar(){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $timeOriginal = [];
        
        foreach (Calendar::all() as $key => $value) {
            $d=getdate($value->start+$value->difference*3600);
            // $timeOriginal[] = date('d.m.Y H:i:s', $value->start+$value->difference*3600);
            $timeOriginal[] = $d['weekday'];
        }
        return $timeOriginal;
    }
    public function getDataInfo(){
        include('simple_html_dom.php');
        $html = file_get_html('https://www.formula1.com/');
        $data = ''; 
        foreach($html->find('.race-list .race') as $element) {
            $img_country =$element->find("div.country div.flag img", 0)->src; 
            // echo $img_country    . '<br>';
            $data =   $img_country;
        }
        echo $data;
    }
}
