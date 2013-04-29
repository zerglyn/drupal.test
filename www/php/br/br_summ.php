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
	$bundle1 = "pay";

#Сумма приходов, запланированных на сегодня
	$sql_pr_br_d = "SELECT SUM(`field_summ_pay_value`) AS sum_pr_d
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
	$res_pr_br_d = mysql_query($sql_pr_br_d);
	if ($row_pr_br_d = mysql_fetch_array($res_pr_br_d))
		$pr_br_d = $row_pr_br_d['sum_pr_d'];
	else $pr_br_d = "Ничего нет";
	
#Сумма приходов, запланированных на эту неделю
	$sql_pr_br_w = "SELECT SUM(`field_summ_pay_value`) AS sum_pr_w
							FROM  field_data_field_summ_pay 
							WHERE  bundle =  \"$bundle\"
							AND  entity_id 
							IN (SELECT  entity_id
			    				 FROM  field_data_field_currency
							    WHERE field_currency_tid = \"$currensy\"
			   				 AND entity_id
							    IN ( SELECT entity_id
										FROM field_data_field_date
										WHERE DATE_FORMAT(field_date_value, '%u') = $today_w
										)
				    			)";
	$res_pr_br_w = mysql_query($sql_pr_br_w);
	if ($row_pr_br_w = mysql_fetch_array($res_pr_br_w))
		$pr_br_w = $row_pr_br_w['sum_pr_w'];
	else $pr_br_w = "Ничего нет";
	
#Сумма приходов, запланированных на этот месяц
	$sql_pr_br_m = "SELECT SUM(`field_summ_pay_value`) AS sum_pr_m
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
	$res_pr_br_m = mysql_query($sql_pr_br_m);
	if ($row_pr_br_m = mysql_fetch_array($res_pr_br_m))
		$pr_br_m = $row_pr_br_m['sum_pr_m'];
	else $pr_br_m = "Ничего нет";
	
#Сумма приходов, запланированных на этот год
	$sql_pr_br_Y = "SELECT SUM(`field_summ_pay_value`) AS sum_pr_Y
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
	$res_pr_br_Y = mysql_query($sql_pr_br_Y);
	if ($row_pr_br_Y = mysql_fetch_array($res_pr_br_Y))
		$pr_br_Y = $row_pr_br_Y['sum_pr_Y'];
	else $pr_br_Y = "Ничего нет";
	


#Сумма платежей, запланированных на сегодня
	$sql_pl_br_d = "SELECT SUM(`field_summ_pay_value`) AS sum_pl_d
			FROM  field_data_field_summ_pay 
			WHERE  bundle =  \"$bundle1\"
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
	$res_pl_br_d = mysql_query($sql_pl_br_d);
	if ($row_pl_br_d = mysql_fetch_array($res_pl_br_d))
		$pl_br_d = $row_pl_br_d['sum_pl_d'];
	else $pl_br_d = "Ничего нет";
	
#Сумма платежей, запланированных на эту неделю
	$sql_pl_br_w = "SELECT SUM(`field_summ_pay_value`) AS sum_pl_w
			FROM  field_data_field_summ_pay 
			WHERE  bundle =  \"$bundle1\"
			AND  entity_id 
			IN (SELECT  entity_id
			    FROM  field_data_field_currency
			    WHERE field_currency_tid = \"$currensy\"
			    AND entity_id
			    IN (SELECT entity_id
				FROM field_data_field_date
				WHERE  DATE_FORMAT(field_date_value, '%u') = $today_w
				)
			    )";
	$res_pl_br_w = mysql_query($sql_pl_br_w);
	if (!$row_pl_br_w = mysql_fetch_array($res_pl_br_w))
		$pl_br_w = $row_pl_br_w['sum_pl_w'];
	else $pl_br_w = "Ничего нет";
	
#Сумма платежей, запланированных на этот месяц
	$sql_pl_br_m = "SELECT SUM(`field_summ_pay_value`) AS sum_pl_m
			FROM  field_data_field_summ_pay
			WHERE  bundle =  \"$bundle1\"
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
	$res_pl_br_m = mysql_query($sql_pl_br_m);
	if ($row_pl_br_m = mysql_fetch_array($res_pl_br_m))
		$pl_br_m = $row_pl_br_m['sum_pl_m'];
	else $pl_br_m = "Ничего нет";
	
#Сумма платежей, запланированных на этот год
	$sql_pl_br_Y = "SELECT SUM(`field_summ_pay_value`) AS sum_pl_Y
			FROM  field_data_field_summ_pay 
			WHERE  bundle =  \"$bundle1\"
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
	$res_pl_br_Y = mysql_query($sql_pl_br_Y);
	if ($row_pl_br_Y = mysql_fetch_array($res_pl_br_Y))
		$pl_br_Y = $row_pl_br_Y['sum_pl_Y'];
	else $pl_br_Y = "Ничего нет";

?>
