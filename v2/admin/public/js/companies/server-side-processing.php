<?php
 
/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */
//var_dump($_GET['status']);die();

// DB table to use
$table = 'companies';	

// Table's primary key
$primaryKey = 'c.id ';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
// 

$columns = array(
    /*
     array(
        'db' => 'j.id',
        'dt' => 'DT_RowId',
        'formatter' => function( $d, $row ) {
            //var_dump($row,$d);//die();
            // Technically a DOM id cannot start with an integer, so we prefix
            // a string. This can also be useful if you have multiple tables
            // to ensure that the id is unique with a different prefix
            return 'row_'.$row[id];
        }
    ),
    */
    array( 
        'db' => '`cn`.`name`',
        'dt' => 0,
        'field' => 'name' 
    ),
    array( 
        'db' => "CONCAT(`u`.`first_name`,' ',`u`.`last_name`)",
        'dt' => 1, 'field' => 'user_name', 
        'as' => 'user_name'
    ),
    array( 'db' => '`c`.`phone_number`','dt' => 2, 'field' => 'phone_number', 'as' => 'phone_number' ),
    array( 'db' => '`c`.`description`','dt' => 3, 'field' => 'description' ),
    array( 'db' => '`c`.`email`','dt' => 4, 'field' => 'email' ),
    array( 'db' => '`c`.`status`','dt' => 5, 'field' => 'status' ),
    array( 
        'db' => '`c`.`id`',
        'dt' => 6,
        'field' => 'company_id', 'as' => 'company_id' 
    ),
    array( 
        'db' => '`u`.`id`',
        'dt' => 7,
        'field' => 'user_id', 'as' => 'user_id' 
    ),
            
);
 
require( '../../credentials.php' );
 //var_dump($sql_details);die();
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( '../../ssp.class.php' );
 
 $joinQuery = "FROM `{$table}` AS `c` JOIN `accounts` AS `u` JOIN `company_names` AS `cn` ON (`c`.`id` = `u`.`company` AND `c`.`name` = `cn`.`id`)";
//$extraCondition = "`id_client`=".$ID_CLIENT_VALUE;
if($_GET['status']){
    $extraCondition = "`c`.`status`='".htmlentities($_GET['status'])."'";
    echo json_encode(
       SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraCondition)
     );
}else{
    echo json_encode(
       SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery)
     );
}
