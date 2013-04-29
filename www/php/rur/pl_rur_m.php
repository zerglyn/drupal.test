<?php
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	include ("connect.php");
	@$today_m = date ("Y-m");
	
	#Сумма платежей, запланированных на этот месяц
	$sql_pl_rur_m = "SELECT SUM(`field_summ_pay_value`) AS sum_pl_m
							FROM  field_data_field_summ_pay
							WHERE  bundle =  \"pay_out\"
							AND  entity_id 
							IN ( SELECT  entity_id
			    				  FROM  field_data_field_currency
			    				  WHERE field_currency_tid = \"2\"
			    				  AND entity_id
			    				  IN ( SELECT entity_id
										 FROM field_data_field_date
										 WHERE field_date_value LIKE \"$today_m%\"
										)
			    				 )";
	$res_pl_rur_m = mysql_query($sql_pl_rur_m);
	$row_pl_rur_m = mysql_fetch_array($res_pl_rur_m);
	if ($row_pl_rur_m['sum_pl_m'] != NULL)
		$pl_rur_m = "<a href=\"money_out/month/rur\"><span style=\"color:#f20606; font-weight: bold; font-size: large; \">".number_format(	$row_pl_rur_m['sum_pl_m'], 0, '.', ' ')."</span></a>";
	else $pl_rur_m = "<span style=\"color:#515151;\"><b>Ничего нет</b></span>";
	echo $pl_rur_m;
?>