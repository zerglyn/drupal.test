<?php
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	include ("connect.php");
	@$today_Y = date("Y");
	
	#Сумма приходов, запланированных на этот год
	$sql_pr_euro_Y = "SELECT SUM(`field_summ_pay_value`) AS sum_pr_Y
							FROM  field_data_field_summ_pay 
							WHERE  bundle =  \"pay_in\"
							AND  entity_id 
							IN ( SELECT  entity_id
			    				  FROM  field_data_field_currency
								  WHERE field_currency_tid = \"4\"
								  AND entity_id
								  IN ( SELECT entity_id
										 FROM field_data_field_date
										 WHERE field_date_value LIKE \"$today_Y%\"
										)
								 )";
	$res_pr_euro_Y = mysql_query($sql_pr_euro_Y);
	$row_pr_euro_Y = mysql_fetch_array($res_pr_euro_Y);
	if ($row_pr_euro_Y['sum_pr_Y'] != NULL)
		$pr_euro_Y = "<a href=\"money_in/year/euro\"><span style=\"color:#3ce42e; font-weight: bold; font-size: large; \">".number_format($row_pr_euro_Y['sum_pr_Y'], 0, '.', ' ')."</span></a>";
	else $pr_euro_Y = "<span style=\"color:#515151;\"><b>Ничего нет</b></span>";
	echo $pr_euro_Y;
?>