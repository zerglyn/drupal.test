<?php
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	include ("connect.php");
	@$tomorrow_d = date ("Y-m-d", mktime(0, 0, 0, date("m")  , date("d")+1, date("Y")));
	
	#Сумма приходов, запланированных на завтра
	$sql_pl_usd_t = "SELECT SUM(`field_summ_pay_value`) AS sum_pl_t
							FROM field_data_field_summ_pay
							WHERE bundle = \"pay_out\"
							AND  entity_id 
							IN ( SELECT  entity_id
								  FROM  field_data_field_currency
								  WHERE field_currency_tid = \"3\"
								  AND entity_id
								  IN ( SELECT entity_id
										 FROM field_data_field_date
										 WHERE field_date_value LIKE \"$tomorrow_d%\"
										)
			    				 )";
	$res_pl_usd_t = mysql_query($sql_pl_usd_t);
	$row_pl_usd_t = mysql_fetch_array($res_pl_usd_t);
	if ($row_pl_usd_t['sum_pl_t'] != NULL)
		$pl_usd_t = "<a href=\"money_out/tomorrow/usd\"><span style=\"color:#f20606; font-weight: bold; font-size: large; \">".number_format(	$row_pl_usd_t['sum_pl_t'], 0, '.', ' ')."</span></a>";
	else $pl_usd_t = "<span style=\"color:#515151;\"><b>Ничего нет</b></span>";
	echo $pl_usd_t;				 
?>