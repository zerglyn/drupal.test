<?php
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	include ("connect.php");
	@$today_w = date("W");
	@$today_Y = date ("Y");
	
	#Сумма платежей, запланированных на эту неделю
	$sql_pl_rur_w = "SELECT SUM(`field_summ_pay_value`) AS sum_pl_w
							FROM  field_data_field_summ_pay 
							WHERE  bundle =  \"pay_out\"
							AND  entity_id 
							IN ( SELECT  entity_id
								  FROM  field_data_field_currency
								  WHERE field_currency_tid = \"2\"
								  AND entity_id
								  IN ( SELECT entity_id
										 FROM field_data_field_date
										 WHERE  DATE_FORMAT(field_date_value, '%u') = $today_w
										 			AND field_date_value LIKE \"$today_Y%\"
										)
								 )";
	$res_pl_rur_w = mysql_query($sql_pl_rur_w);
	$row_pl_rur_w = mysql_fetch_array($res_pl_rur_w);
	if ($row_pl_rur_w['sum_pl_w'] != NULL)
		$pl_rur_w = "<a href=\"money_out/week/rur\"><span style=\"color:#f20606; font-weight: bold; font-size: large; \">".number_format(	$row_pl_rur_w['sum_pl_w'], 0, '.', ' ')."</span></a>";
	else $pl_rur_w = "<span style=\"color:#515151;\"><b>Ничего нет</b></span>";
	echo $pl_rur_w;
?>