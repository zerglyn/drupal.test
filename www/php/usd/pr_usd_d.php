<?php
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	include ("connect.php");
	@$today_d = date ("Y-m-d");
	
	#Сумма приходов, запланированных на сегодня
	$sql_pr_usd_d = "SELECT SUM(`field_summ_pay_value`) AS sum_pr_d
							FROM field_data_field_summ_pay
							WHERE bundle = \"pay_in\"
							AND  entity_id 
							IN ( SELECT  entity_id
								  FROM  field_data_field_currency
								  WHERE field_currency_tid = \"3\"
								  AND entity_id
								  IN ( SELECT entity_id
										 FROM field_data_field_date
										 WHERE field_date_value LIKE \"$today_d%\"
										)
								 )";
	$res_pr_usd_d = mysql_query($sql_pr_usd_d);
	$row_pr_usd_d = mysql_fetch_array($res_pr_usd_d);
	if ($row_pr_usd_d['sum_pr_d'] != NULL)
		$pr_usd_d = "<a href=\"money_in/today/usd\"><span style=\"color:#3ce42e; font-weight: bold; font-size: large; \">".number_format(	$row_pr_usd_d['sum_pr_d'], 0, '.', ' ')."</span></a>";
	else $pr_usd_d = "<span style=\"color:#515151;\"><b>Ничего нет</b></span>";
	echo $pr_usd_d;				 
?>