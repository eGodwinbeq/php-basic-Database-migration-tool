<?php
/**
 * Alters or creates a database table based on the provided parameters.
 *
 * This function either creates a new table if it doesn't exist or alters an existing table
 * by adding, modifying, or renaming columns as specified in the parameters.
 *
 * @param mysqli $con The mysqli connection object for database operations.
 * @param array $params An associative array containing table and column details:
 *                      - 'table_name': (string) The name of the table to create or alter.
 *                      - 'columns': (array) An array of column definitions, each containing:
 *                          - 'column_name': (string) The name of the column.
 *                          - 'datatype': (string) The SQL datatype of the column.
 *                          - 'nullable': (bool) Whether the column can contain NULL values.
 *                          - 'default_value': (mixed, optional) The default value for the column.
 *                          - 'primary_key': (bool, optional) Whether this column is the primary key.
 *                          - 'auto_increment': (bool, optional) Whether this column auto-increments.
 *                          - 'after_this': (string, optional) The column after which to add this column.
 *                          - 'new_name': (string, optional) New name for the column if renaming.
 *
 * @return string|void Returns "Table created successfully" if a new table is created,
 *                     "Done " if alterations are successful, or void if an error occurs.
 *                     Errors are echoed directly to the output.
 */
function alterMyTable($con, $params)
{
    $table_name = mysqli_real_escape_string($con, $params['table_name']);

    // SQL query to check if the table exists
    $tableCheck = $con->query("SHOW TABLES LIKE '$table_name'");
    $isNewTable = ($tableCheck->num_rows == 0);

    // Collect primary key column if specified
    $primaryKeyColumn = null;

    // If table doesn't exist, create it with the specified columns
    if ($isNewTable) {
        $createTableSQL = "CREATE TABLE `$table_name` (";
        $columns = [];

        foreach ($params['columns'] as $column) {
            $column_name = mysqli_real_escape_string($con, $column['column_name']);
            $datatype = mysqli_real_escape_string($con, $column['datatype']);
            $nullable = $column['nullable'] ? "NULL" : "NOT NULL";
            $default_value = isset($column['default_value']) ? "DEFAULT '" . mysqli_real_escape_string($con, $column['default_value']) . "'" : "";
            $autoIncrement = (isset($column['primary_key']) && $column['primary_key'] && isset($column['auto_increment']) && $column['auto_increment']) ? "AUTO_INCREMENT" : "";

            // Check if this column is the primary key
            if (isset($column['primary_key']) && $column['primary_key']) {
                $primaryKeyColumn = $column_name;
            }

            $columns[] = "`$column_name` $datatype $nullable $default_value $autoIncrement";
        }

        // Add primary key to the create table statement
        if ($primaryKeyColumn) {
            $columns[] = "PRIMARY KEY (`$primaryKeyColumn`)";
        }

        $createTableSQL .= implode(", ", $columns) . ");";

        if ($con->query($createTableSQL) === TRUE) {
            return "Table created successfully";
        } else {
            echo "Oops This is on our end School monitor Internal Error: " . $con->error;
            return;
        }
    }

    // If the table exists, proceed with alterations
    $alterations = [];

    foreach ($params['columns'] as $column) {
        $column_name = mysqli_real_escape_string($con, $column['column_name']);
        $datatype = mysqli_real_escape_string($con, $column['datatype']);
        $nullable = $column['nullable'] ? "NULL" : "NOT NULL";
        $default_value = isset($column['default_value']) ? "DEFAULT '" . mysqli_real_escape_string($con, $column['default_value']) . "'" : "";
        $after_this = isset($column['after_this']) ? mysqli_real_escape_string($con, $column['after_this']) : NULL;

        // Check if new_name is provided to rename the column
        $newName = isset($column['new_name']) ? mysqli_real_escape_string($con, $column['new_name']) : $column_name;

        // Check if the original column or the new name already exists in the table
        $columnCheck = $con->query("SHOW COLUMNS FROM `$table_name` LIKE '$column_name'");
        $newNameCheck = $con->query("SHOW COLUMNS FROM `$table_name` LIKE '$newName'");

        // Preserve AUTO_INCREMENT attribute if the column has it
        $autoIncrementCheck = $con->query("SHOW COLUMNS FROM `$table_name` LIKE '$column_name'");
        $autoIncrement = ($autoIncrementCheck->num_rows > 0 && strpos($autoIncrementCheck->fetch_assoc()['Extra'], 'auto_increment') !== false) ? "AUTO_INCREMENT" : "";

        if ($columnCheck->num_rows == 0 && $newNameCheck->num_rows == 0) {
            // Column doesn't exist with either name, add it
            $sql = "ADD `$column_name` $datatype $nullable $default_value $autoIncrement";
            if ($after_this !== NULL) {
                $sql .= " AFTER `$after_this`";
            }
        } elseif ($columnCheck->num_rows > 0 && $column_name !== $newName && $newNameCheck->num_rows == 0) {
            // Column exists with the original name and new_name is not in use, rename it
            $sql = "CHANGE `$column_name` `$newName` $datatype $nullable $default_value"; // Rename if new_name is provided
        } else {
            // Column exists with the new name or no renaming needed, modify it directly
            $sql = "MODIFY `$newName` $datatype $nullable $default_value $autoIncrement";
        }

        // Add the SQL statement to the list of alterations
        $alterations[] = $sql;
    }

    // Combine all column alterations into a single ALTER TABLE statement
    $fullSql = "ALTER TABLE `$table_name` " . implode(", ", $alterations) . ";";

    // Execute the query
    if ($con->query($fullSql) === TRUE) {
        return "Done";
    } else {
        echo "Oops This is on our end School monitor Internal Error: " . $con->error;
    }
}

// DEMO USAGE FOR THE alterMyTable() FUNCTION

/* --------------------------------------------------------------->
$params = [
    'table_name' => 'employees',
    'columns' => [
        // Adding a new column

        [
            'column_name' => 'id',
            'new_name' => 'Employee_id',
            'datatype' => 'INT',
            'nullable' => false,
            'primary_key' => true,
            'auto_increment' => true
        ],
        [
            'column_name' => 'first_name',
            'datatype' => 'VARCHAR(100)',
            'nullable' => true
        ],
        [
            'column_name' => 'last_name',
            'datatype' => 'VARCHAR(100)',
            'nullable' => true
        ],
        // Renaming an existing column and modifying its properties
        [
            'column_name' => 'full_name',  // old column name
            'new_name' => 'name',  // new column name
            'datatype' => 'VARCHAR(111)',
            'nullable' => false
        ],
        // Adding another column with default value
        [
            'column_name' => 'email',
            'datatype' => 'VARCHAR(255)',
            'nullable' => true,
            'default_value' => 'example@example.com'
        ]
    ]
];

// Call the function to alter the table
$result = alterMyTable($con, $params);
// Output the result of the operation
echo $result;
<---------------------------------------------------------------- */
