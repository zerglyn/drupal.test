<?php
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	include ("connect.php");
	@$today_d = date ("Y-m-d");
	
	#Сумма приходов, запланированных на сегодня
	$sql_pl_euro_d = "SELECT SUM(`field_summ_pay_value`) AS sum_pl_d
							FROM field_data_field_summ_pay
							WHERE bundle = \"pay_out\"
							AND  entity_id 
							IN ( SELECT  entity_id
								  FROM  field_data_field_currency
								  WHERE field_currency_tid = \"4\"
								  AND entity_id
								  IN ( SELECT entity_id
										 FROM field_data_field_date
										 WHERE field_date_value LIKE \"$today_d%\"
										)
			    				 )";
	$res_pl_euro_d = mysql_query($sql_pl_euro_d);
	$row_pl_euro_d = mysql_fetch_array($res_pl_euro_d);
	if ($row_pl_euro_d['sum_pl_d'] != NULL)
		$pl_euro_d = "<a href=\"money_out/today/euro\"><span style=\"color:#f20606; font-weight: bold; font-size: large; \">".number_format($row_pl_euro_d['sum_pl_d'], 0, '.', ' ')."</span></a>";
	else $pl_euro_d = "<span style=\"color:#515151;\"><b>Ничего нет</b></span>";
	echo $pl_euro_d;				 
?>