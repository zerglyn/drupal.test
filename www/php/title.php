<?php
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	@$today = date ("d-m-Y");
	function DtS($day_en) 
		{
			$month_ru = array(
				"01"=>'января',
				"02"=>'февраля',
				"03"=>'марта',
				"04"=>'апреля',
				"05"=>'мая',
				"06"=>'июня',
				"07"=>'июля',
				"08"=>'августа',
				"09"=>'сентября',
				"10"=>'октября',
				"11"=>'ноября',
				"12"=>'декабря');
			$d_str = substr($day_en, 8, 2);
			$m_str = substr($day_en, 5, 2);
			$y_str = substr($day_en, 0, 4);
			@$m_ru = $month_ru[$m_str];
			$date_rus = $d_str.' '.$m_ru.' '.$y_str.'года';
			return $date_rus;
		}
	
	$title = 'Сегодня '.DtS($today); #Сегодня
	echo $title;
?>

