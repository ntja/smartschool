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
$table = 'job_types';	

// Table's primary key
$primaryKey = 'id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
// 

$columns = array(
    array( 'db' => 'name','dt' => 0, 'field' => 'name' ),    
    array( 'db' => 'is_active','dt' => 1, 'field' => 'status' ),
    array( 'db' => 'id','dt' => 2, 'field' => 'id' ),    
);
 
// SQL server connection information
require( '../../../credentials.php' );
 //var_dump($sql_details);die();
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

require( '../../../ssp.class.php' );
 
 $joinQuery = null;
//$extraCondition = "`id_client`=".$ID_CLIENT_VALUE;
//var_dump($_GET);
 if(isset($_GET['is_active'])){
     if(($_GET['is_active'] == 0)||($_GET['is_active'] == 1)){
        $extraCondition = "`is_active`='".htmlentities($_GET['is_active'])."'";
        echo json_encode(
           SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraCondition)
         );
    }
 }else{
    echo json_encode(
       SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery)
     );
}
