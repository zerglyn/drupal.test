<?php
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	include ("connect.php");
	@$today_m = date ("Y-m");
	
	#Сумма приходов, запланированных на этот месяц
	$sql_pr_rur_m = "SELECT SUM(`field_summ_pay_value`) AS sum_pr_m
							FROM  field_data_field_summ_pay 
							WHERE  bundle =  \"pay_in\"
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
	$res_pr_rur_m = mysql_query($sql_pr_rur_m);
	$row_pr_rur_m = mysql_fetch_array($res_pr_rur_m);
	if ($row_pr_rur_m['sum_pr_m'] != NULL)
		$pr_rur_m = "<a href=\"money_in/month/rur\"><span style=\"color:#3ce42e; font-weight: bold; font-size: large; \">".number_format(	$row_pr_rur_m['sum_pr_m'], 0, '.', ' ')."</span></a>";
	else $pr_rur_m = "<span style=\"color:#515151;\"><b>Ничего нет</b></span>";
	echo $pr_rur_m;
?>