<?php
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	include ("connect.php");

	@$today_d = date ("Y-m-d");
	@$today_w = date ("W");
	@$today_m = date ("Y-m");
	@$today_Y = date ("Y");
	$currensy = 1;
	$bundle = "pay_in";

#Сумма приходов, запланированных на сегодня
	$sql_pr_euro_d = "SELECT SUM(`field_summ_pay_value`) AS sum_pr_d
			FROM field_data_field_summ_pay
			WHERE bundle = \"$bundle\"
			AND  entity_id 
			IN (SELECT  entity_id
			    FROM  field_data_field_currency
			    WHERE field_currency_tid = \"$currensy\"
			    AND entity_id
			    IN (SELECT entity_id
				FROM field_data_field_date
				WHERE field_date_value LIKE \"$today_d%\"
				)
			    )";
	if ($res_pr_euro_d = mysql_query($sql_pr_euro_d))
		{$row_pr_euro_d = mysql_fetch_array($res_pr_euro_d);
		$pr_euro_d = $row_pr_euro_d['sum_pr_d'];}
	else $pr_euro_d = "Ничего нет";
	
#Сумма приходов, запланированных на эту неделю
	$sql_pr_euro_w = "SELECT SUM(`field_summ_pay_value`) AS sum_pr_w
			FROM  field_data_field_summ_pay 
			WHERE  bundle =  \"pay_in\"
			AND  entity_id 
			IN (SELECT  entity_id
			    FROM  field_data_field_currency
			    WHERE field_currency_tid = \"$currensy\"
			    AND entity_id
			    IN (SELECT entity_id, field_date_value  DATE_FORMAT(field_date_value, 'W') AS pr_euro_w
				FROM field_data_field_date
				WHERE pr_euro_w = \"$today_w\"
				)
			    )";
	if ($res_pr_euro_d = mysql_query($sql_pr_euro_d))
		{$row_pr_euro_d = mysql_fetch_array($res_pr_euro_d);
		 $pr_euro_d = $row_pr_euro_d['sum_pr_w'];}
	else $pr_euro_d = "Ничего нет";									**
	
#Сумма приходов, запланированных на этот месяц
	$sql_pr_euro_m = "SELECT SUM(`field_summ_pay_value`) AS sum_pr_m
			FROM  field_data_field_summ_pay 
			WHERE  bundle =  \"$bundle\"
			AND  entity_id 
			IN (SELECT  entity_id
			    FROM  field_data_field_currency
			    WHERE field_currency_tid = \"$currensy\"
			    AND entity_id
			    IN (SELECT entity_id
				FROM field_data_field_date
				WHERE field_date_value LIKE \"$today_m%\"
				)
			    )";
	if ($res_pr_euro_m = mysql_query($sql_pr_euro_m))
		{$row_pr_euro_m = mysql_fetch_array($res_pr_euro_m);
		 $pr_euro_m = $row_pr_euro_m['sum_pr_m'];}
	else $pr_euro_m = "Ничего нет";
	
#Сумма приходов, запланированных на этот год
	$sql_pr_euro_Y = "SELECT SUM(`field_summ_pay_value`) AS sum_pr_Y
			FROM  field_data_field_summ_pay 
			WHERE  bundle =  \"$bundle\"
			AND  entity_id 
			IN (SELECT  entity_id
			    FROM  field_data_field_currency
			    WHERE field_currency_tid = \"$currensy\"
			    AND entity_id
			    IN (SELECT entity_id
				FROM field_data_field_date
				WHERE field_date_value LIKE \"$today_Y%\"
				)
			    )";
	if ($res_pr_euro_Y = mysql_query($sql_pr_euro_Y))
		{$row_pr_euro_Y = mysql_fetch_array($res_pr_euro_Y);
		 $pr_euro_Y = $row_pr_euro_Y['sum_pr_Y'];}
	else $pr_euro_Y = "Ничего нет";
	

	$bundle = "pay";
#Сумма платежей, запланированных на сегодня
	$sql_pl_euro_d = "SELECT SUM(`field_summ_pay_value`) AS sum_pl_d
			FROM  field_data_field_summ_pay 
			WHERE  bundle =  \"$bundle\"
			AND  entity_id 
			IN (SELECT  entity_id
			    FROM  field_data_field_currency
			    WHERE field_currency_tid = \"$currensy\"
			    AND entity_id
			    IN (SELECT entity_id
				FROM field_data_field_date
				WHERE field_date_value LIKE \"$today_d%\"
				)
			    )";
	if ($res_pl_euro_d = mysql_query($sql_pl_euro_d))
		{$row_pl_euro_d = mysql_fetch_array($res_pl_euro_d);
		 $pl_euro_d = $row_pl_euro_d['sum_pl_d'];}
	else $pl_euro_d = "Ничего нет";
	
#Сумма платежей, запланированных на эту неделю
	$sql_pl_euro_w = "SELECT SUM(`field_summ_pay_value`) AS sum_pl_w
			FROM  field_data_field_summ_pay 
			WHERE  bundle =  \"$bundle\"
			AND  entity_id 
			IN (SELECT  entity_id
			    FROM  field_data_field_currency
			    WHERE field_currency_tid = \"$currensy\"
			    AND entity_id
			    IN (SELECT entity_id, field_date_value  DATE_FORMAT(field_date_value, 'W') AS pl_euro_w
				FROM field_data_field_date
				WHERE pl_euro_w = \"$today_w\"
				)
			    )";
	if ($res_pl_euro_w = mysql_query($sql_pl_euro_w))
		{$row_pl_euro_w = mysql_fetch_array($res_pl_euro_w);
		 $pl_euro_w = $row_pl_euro_w['sum_pl_w'];}
	else $pl_euro_w = "Ничего нет";					**
	
#Сумма платежей, запланированных на этот месяц
	$sql_pl_euro_m = "SELECT SUM(`field_summ_pay_value`) AS sum_pl_m
			FROM  field_data_field_summ_pay 
			WHERE  bundle =  \"$bundle\"
			AND  entity_id 
			IN (SELECT  entity_id
			    FROM  field_data_field_currency
			    WHERE field_currency_tid = \"$currensy\"
			    AND entity_id
			    IN (SELECT entity_id
				FROM field_data_field_date
				WHERE field_date_value LIKE \"$today_m%\"
				)
			    )";
	if ($res_pl_euro_m = mysql_query($sql_pl_euro_m))
		{$row_pl_euro_m = mysql_fetch_array($res_pl_euro_m);
		 $pl_euro_m = $row_pl_euro_m['sum_pl_m'];}
	else $pl_euro_m = "Ничего нет";
	
#Сумма платежей, запланированных на этот год
	$sql_pl_euro_Y = "SELECT SUM(`field_summ_pay_value`) AS sum_pl_Y
			FROM  field_data_field_summ_pay 
			WHERE  bundle =  \"$bundle\"
			AND  entity_id 
			IN (SELECT  entity_id
			    FROM  field_data_field_currency
			    WHERE field_currency_tid = \"$currensy\"
			    AND entity_id
			    IN (SELECT entity_id
				FROM field_data_field_date
				WHERE field_date_value LIKE \"$today_Y%\"
				)
			    )";
	if ($res_pl_euro_Y = mysql_query($sql_pl_euro_Y))
		{$row_pl_euro_Y = mysql_fetch_array($res_pl_euro_Y);
		 $pl_euro_Y = $row_pl_euro_Y['sum_pl_Y'];}
	else $pl_euro_Y = "Ничего нет";				 			**/
?>
