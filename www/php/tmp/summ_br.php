<?php
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	include ("connect.php");
	@$today = date ("d-m-Y");
	@$today_d = date ("Y-m-d");
	@$today_w = date ("W");
	@$today_m = date ("Y-m");
	@$today_Y = date ("Y");
	$currensy = 3;
	$bundle = "pay_in";

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

#Сумма приходов, запланированных на сегодня
	$sql_pr_br_d = "SELECT SUM(`field_summ_pay_value`) AS sum_pr_d
			FROM field_data_field_summ_pay
			WHERE bundle = \"$bundle\"";
	if ($res_pr_br_d = mysql_query($sql_pr_br_d))
		$row_pr_br_d = mysql_fetch_array($res_pr_br_d)
		$pr_br_d = ['sum_pr_d'];
	else $pr_br_d = "Ничего нет";
	
#Сумма приходов, запланированных на эту неделю
/**	$sql_pr_br_w = "SELECT SUM(field_summ_pay_value) AS  \"Сумма приходов в Белках НЕДЕЛЯ\"
			FROM  field_data_field_summ_pay 
			WHERE  bundle =  \"pay_in\"
			AND  entity_id 
			IN (SELECT  entity_id
			    FROM  field_data_field_currency
			    WHERE field_currency_tid = \"3\"
			    AND entity_id
			    IN (SELECT entity_id
				FROM field_data_field_date
				WHERE field_date_value LIKE 2012-08-16%
				)
			    )";
	if ($res_pr_br_d = mysql_query($sql_pr_br_d))
		$pr_br_d = mysql_fetch_array($res_pr_br_d);
	else $pr_br_d = "Ничего нет";									**
	
#Сумма приходов, запланированных на этот месяц
	$sql_pr_br_m = "SELECT SUM(field_summ_pay_value) AS  \"Сумма приходов в Белках МЕСЯЦ\"
			FROM  field_data_field_summ_pay 
			WHERE  bundle =  \"pay_in\"
			AND  entity_id 
			IN (SELECT  entity_id
			    FROM  field_data_field_currency
			    WHERE field_currency_tid = \"$currensy\"
			    AND entity_id
			    IN (SELECT entity_id
				FROM field_data_field_date
				WHERE field_date_value LIKE $today_m%
				)
			    )";
	if ($res_pr_br_m = mysql_query($sql_pr_br_m))
		$pr_br_m = mysql_fetch_array($res_pr_br_m);
	else $pr_br_m = "Ничего нет";
	
#Сумма приходов, запланированных на этот год
	$sql_pr_br_Y = "SELECT SUM(field_summ_pay_value) AS  \"Сумма приходов в Белках ГОД\"
			FROM  field_data_field_summ_pay 
			WHERE  bundle =  \"pay_in\"
			AND  entity_id 
			IN (SELECT  entity_id
			    FROM  field_data_field_currency
			    WHERE field_currency_tid = \"$currensy\"
			    AND entity_id
			    IN (SELECT entity_id
				FROM field_data_field_date
				WHERE field_date_value LIKE $today_Y%
				)
			    )";
	if ($res_pr_br_Y = mysql_query($sql_pr_br_Y))
		$pr_br_Y = mysql_fetch_array($res_pr_br_Y);
	else $pr_br_Y = "Ничего нет";
	

	$bundle = "pay";
#Сумма платежей, запланированных на сегодня
	$sql_pl_br_d = "SELECT SUM(field_summ_pay_value) AS  \"Сумма патежей в Белках СЕГОДНЯ\"
			FROM  field_data_field_summ_pay 
			WHERE  bundle =  \"pay\"
			AND  entity_id 
			IN (SELECT  entity_id
			    FROM  field_data_field_currency
			    WHERE field_currency_tid = \"$currensy\"
			    AND entity_id
			    IN (SELECT entity_id
				FROM field_data_field_date
				WHERE field_date_value LIKE $today_d%
				)
			    )";
	if ($res_pl_br_d = mysql_query($sql_pl_br_d))
		$pl_br_d = mysql_fetch_array($res_pl_br_d);
	else $pl_br_d = "Ничего нет";
	
#Сумма платежей, запланированных на эту неделю
/**	$sql_pl_br_w = "SELECT SUM(field_summ_pay_value) AS  \"Сумма патежей в Белках НЕДЕЛЯ\"
			FROM  field_data_field_summ_pay 
			WHERE  bundle =  \"pay\"
			AND  entity_id 
			IN (SELECT  entity_id
			    FROM  field_data_field_currency
			    WHERE field_currency_tid = \"$currensy\"
			    AND entity_id
			    IN (SELECT entity_id, field_date_value  DATE_FORMAT(field_date_value, 'W') AS pl_br_w
				FROM field_data_field_date
				WHERE pl_br_w = $today_w
				)
			    )";
	if ($res_pl_br_w = mysql_query($sql_pl_br_w))
		$pl_br_w = mysql_fetch_array($res_pl_br_w);
	else $pl_br_w = "Ничего нет";					**
	
#Сумма платежей, запланированных на этот месяц
	$sql_pl_br_m = "SELECT SUM(field_summ_pay_value) AS  \"Сумма патежей в Белках МЕСЯЦ\"
			FROM  field_data_field_summ_pay 
			WHERE  bundle =  \"pay\"
			AND  entity_id 
			IN (SELECT  entity_id
			    FROM  field_data_field_currency
			    WHERE field_currency_tid = \"$currensy\"
			    AND entity_id
			    IN (SELECT entity_id
				FROM field_data_field_date
				WHERE field_date_value LIKE $today_m%
				)
			    )";
	if ($res_pl_br_m = mysql_query($sql_pl_br_m))
		$pl_br_m = mysql_fetch_array($res_pl_br_m);
	else $pl_br_m = "Ничего нет";
	
#Сумма платежей, запланированных на этот год
	$sql_pl_br_Y = "SELECT SUM(field_summ_pay_value) AS  \"Сумма патежей в Белках ГОД\"
			FROM  field_data_field_summ_pay 
			WHERE  bundle =  \"pay\"
			AND  entity_id 
			IN (SELECT  entity_id
			    FROM  field_data_field_currency
			    WHERE field_currency_tid = \"$currensy\"
			    AND entity_id
			    IN (SELECT entity_id
				FROM field_data_field_date
				WHERE field_date_value LIKE $today_Y%
				)
			    )";
	if ($res_pl_br_Y = mysql_query($sql_pl_br_Y))
		$pl_br_Y = mysql_fetch_array($res_pl_br_Y);
	else $pl_br_Y = "Ничего нет";				 			**/
?>
