<?php
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	include ("connect.php");
	@$tomorrow_d = date ("Y-m-d", mktime(0, 0, 0, date("m")  , date("d")+1, date("Y")));
	
	#Сумма приходов, запланированных на завтра
	$sql_pr_usd_t = "SELECT SUM(`field_summ_pay_value`) AS sum_pr_t
							FROM field_data_field_summ_pay
							WHERE bundle = \"pay_in\"
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
	$res_pr_usd_t = mysql_query($sql_pr_usd_t);
	$row_pr_usd_t = mysql_fetch_array($res_pr_usd_t);
	if ($row_pr_usd_t['sum_pr_t'] != NULL)
		$pr_usd_t = "<a href=\"money_in/tomorrow/usd\"><span style=\"color:#3ce42e; font-weight: bold; font-size: large; \">".number_format(	$row_pr_usd_t['sum_pr_t'], 0, '.', ' ')."</span></a>";
	else $pr_usd_t = "<span style=\"color:#515151;\"><b>Ничего нет</b></span>";
	echo $pr_usd_t;				 
?>