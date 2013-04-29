<?php
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	include ("connect.php");
	@$today_Y = date ("Y");
	
	#Сумма платежей, запланированных на этот год
	$sql_pl_usd_Y = "SELECT SUM(`field_summ_pay_value`) AS sum_pl_Y
							FROM  field_data_field_summ_pay 
							WHERE  bundle =  \"pay_out\"
							AND  entity_id 
							IN ( SELECT  entity_id
								  FROM  field_data_field_currency
								  WHERE field_currency_tid = \"3\"
								  AND entity_id
								  IN ( SELECT entity_id
										 FROM field_data_field_date
										 WHERE field_date_value LIKE \"$today_Y%\"
										)
								 )";
	$res_pl_usd_Y = mysql_query($sql_pl_usd_Y);
	$row_pl_usd_Y = mysql_fetch_array($res_pl_usd_Y);
	if ($row_pl_usd_Y['sum_pl_Y'] != NULL)
		$pl_usd_Y = "<a href=\"money_out/year/usd\"><span style=\"color:#f20606; font-weight: bold; font-size: large; \">".number_format(	$row_pl_usd_Y['sum_pl_Y'], 0, '.', ' ')."</span></a>";
	else $pl_usd_Y = "<span style=\"color:#515151;\"><b>Ничего нет</b></span>";	
	echo $pl_usd_Y;				 
?>