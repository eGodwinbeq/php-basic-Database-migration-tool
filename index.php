<?php
// include you database connection file
// include 'connect.php'; // Uncomment this line if you have a connect.php file for database connection

// include 'connect.php';
include 'build.php';

/*
    * Example usage:
    * $params = [
    *     'table_name' => 'users',
    *     'columns' => [
    *         [
    *             'column_name' => 'id',
    *             'datatype' => 'INT',
    *             'nullable' => false,
    *             'primary_key' => true,
    *             'auto_increment' => true
    *         ],
    *         [
    *             'column_name' => 'username',
    *             'datatype' => 'VARCHAR(50)',
    *             'nullable' => false
    *         ],
    *         [
    *             'column_name' => 'email',
    *             'datatype' => 'VARCHAR(100)',
    *             'nullable' => false
    *         ]
    *     ]
    * ];
    *
    *

    ## Call the function to alter the table
        $result = migrate($con, $params);
    
    ##  Output the result of the operation
        echo $result;


*/