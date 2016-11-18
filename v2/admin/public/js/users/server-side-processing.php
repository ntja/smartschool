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
$table = 'accounts';	

// Table's primary key
$primaryKey = 'id ';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
// 

$columns = array(
    array( 'db' => 'email','dt' => 0, 'field' => 'email'),
    array( 
        'db' => 'first_name',
        'dt' => 1,
        'field' => 'first_name' 
    ),
    array( 
        'db' => 'last_name',
        'dt' => 2, 'field' => 'last_name'
    ),    
    array( 'db' => 'role','dt' => 3, 'field' => 'role' ),
    array( 'db' => 'subscription','dt' => 4, 'field' => 'subscription' ),
    array( 'db' => 'verified_status','dt' => 5, 'field' => 'active_status' ),
    array( 'db' => 'id','dt' => 6, 'field' => 'id' ),       
);
 
require( '../../credentials.php' );
 //var_dump($sql_details);die();
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( '../../ssp.class.php' );
  
 $extraCondition = [];
if($_GET['active_status']){   
    $extraCondition[] = "active_status='".htmlentities($_GET['active_status'])."'";  
}

if($_GET['role']){
    $extraCondition[] = "role='".htmlentities($_GET['role'])."'";   
}
if($_GET['subscription']){
    $extraCondition[] = "subscription='".htmlentities($_GET['subscription'])."'";   
}

if(count($extraCondition)<=1){
    $extraWhere = implode('', $extraCondition);
}else{
    $extraWhere = implode(' AND ', $extraCondition);
}
echo json_encode(
       SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere)
     );
