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
$table = 'jobs';	

// Table's primary key
$primaryKey = 'j.id ';
 
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
        'db' => '`jt`.`name`',
        'dt' => 1, 'field' => 'job_title_name', 
        'as' => 'job_title_name'
    ),
    array( 'db' => '`i`.`name`','dt' => 2, 'field' => 'industry_name', 'as' => 'industry_name' ),
    array( 'db' => '`j`.`salary_range`','dt' => 3, 'field' => 'salary_range' ),
    array( 'db' => '`j`.`salary_min`','dt' => 4, 'field' => 'salary_min' ),
    array( 'db' => '`j`.`salary_max`','dt' => 5, 'field' => 'salary_max' ),
    array( 'db' => '`j`.`salary_type`','dt' => 6, 'field' => 'salary_type' ),
    array( 'db' => '`j`.`description`','dt' => 7, 'field' => 'description' ),
    array( 'db' => '`j`.`status`','dt' => 8, 'field' => 'status' ),
    array( 
        'db' => '`c`.`id`',
        'dt' => 9,
        'field' => 'company_id', 'as' => 'company_id' 
    ), 
            
);
 
require( '../../credentials.php' );
 //var_dump($sql_details);die();
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( '../../ssp.class.php' );
 
 $joinQuery = "FROM `{$table}` AS `j` JOIN `companies` AS `c` JOIN `company_names` AS `cn`  JOIN `job_titles` AS `jt` JOIN `industry` AS `i` ON (`c`.`id` = `j`.`company` AND `cn`.`id` = `c`.`name` AND `jt`.`id` = `j`.`title` AND `i`.`id` = `j`.`industry`)";
//$extraCondition = "`id_client`=".$ID_CLIENT_VALUE;
 
 $extraCondition = [];
if($_GET['status']){   
    $extraCondition[] = "`j`.`status`='".htmlentities($_GET['status'])."'";
   // echo json_encode(
   //    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraCondition)
   //  );
}
//else{
  //  echo json_encode(
   //    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery)
   //  );
//}
if($_GET['company']){
    $extraCondition[] = "`j`.`company`='".htmlentities($_GET['company'])."'";
   // echo json_encode(
   //    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraCondition)
   //  );
}
if(count($extraCondition)<=1){
    $extraWhere = implode('', $extraCondition);
}else{
    $extraWhere = implode(' AND ', $extraCondition);
}
echo json_encode(
       SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere)
     );
