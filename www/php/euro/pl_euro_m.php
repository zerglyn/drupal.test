<?php
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	include ("connect.php");
	@$today_m = date ("Y-m");
	
	#Сумма платежей, запланированных на этот месяц
	$sql_pl_euro_m = "SELECT SUM(`field_summ_pay_value`) AS sum_pl_m
							FROM  field_data_field_summ_pay
							WHERE  bundle =  \"pay_out\"
							AND  entity_id 
							IN ( SELECT  entity_id
			    				  FROM  field_data_field_currency
			    				  WHERE field_currency_tid = \"4\"
			    				  AND entity_id
			    				  IN ( SELECT entity_id
										 FROM field_data_field_date
										 WHERE field_date_value LIKE \"$today_m%\"
										)
			    				 )";
	$res_pl_euro_m = mysql_query($sql_pl_euro_m);
	$row_pl_euro_m = mysql_fetch_array($res_pl_euro_m);
	if ($row_pl_euro_m['sum_pl_m'] != NULL)
		$pl_euro_m = "<a href=\"money_out/month/euro\"><span style=\"color:#f20606; font-weight: bold; font-size: large; \">".number_format($row_pl_euro_m['sum_pl_m'], 0, '.', ' ')."</span></a>";
	else $pl_euro_m = "<span style=\"color:#515151;\"><b>Ничего нет</b></span>";
	echo $pl_euro_m;
?>