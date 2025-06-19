<?php
include '../school/includes/connect.php';
include 'build.php';

/*
 * --------------------------------------------------------------------------------------------->
 * Adding column "amount_spent" in the table 'expense_requisitions'
 * --------------------------------------------------------------------------------------------->
 *
 */
$params = [
    'table_name' => 'expense_requisitions',
    'columns' => [
        // Adding a new column

        [
            'column_name' => 'amount_spent',
            'datatype' => 'INT',
            'nullable' => true
        ]
    ]
];

// Call the function to alter the table
$run = alterMyTable($con, $params);
// Output the result of the operation
echo $run;


$params = [
    'table_name' => 'finance_transactions',
    'columns' => [
        // Adding a new column

        [
            'column_name' => 'admissionNo_dr',
            'datatype' => 'VARCHAR(64)',
            'nullable' => true
        ]
    ]
];

// Call the function to alter the table
$run = alterMyTable($con, $params);
// Output the result of the operation
echo $run;

$params = [
    'table_name' => 'admissions',
    'columns' => [
        // Adding a new column

        [
            'column_name' => 'parentNo',
            'datatype' => 'VARCHAR(64)',
            'nullable' => true
        ],
        [
            'column_name' => 'stream',
            'datatype' => 'INT',
            'nullable' => true
        ]
    ]
];


// Call the function to alter the table
$run = alterMyTable($con, $params);
// Output the result of the operation
echo $run;

$params = [
    'table_name' => 'revenues',
    'columns' => [
        // Adding a new column

        [
            'column_name' => 'admissionNo',
            'datatype' => 'VARCHAR(64)',
            'nullable' => true
        ],
        [
            'column_name' => 'classId',
            'datatype' => 'INT',
            'nullable' => true
        ]

    ]
];


// Call the function to alter the table
$run = alterMyTable($con, $params);
// Output the result of the operation
echo $run;

$new_uneb_table_columns = [
    'table_name' => 'new_uneb_grading',
    'columns' => [
        // Adding a new column

        [
            'column_name' => 'gradeId',
            'datatype' => 'INT',
            'primary_key' => TRUE,
            'auto_increment' => TRUE,
            'nullable' => false
        ],
        [
            'column_name' => 'schoolId',
            'datatype' => 'INT',
            'nullable' => false
        ],
        [
            'column_name' => 'level',
            'datatype' => 'INT',
            'nullable' => false
        ],
        [
            'column_name' => 'start',
            'datatype' => 'INT',
            'nullable' => false
        ],
        [
            'column_name' => 'end',
            'datatype' => 'INT',
            'nullable' => false
        ],
        [
            'column_name' => 'grade',
            'datatype' => 'INT',
            'nullable' => false
        ],
        [
            'column_name' => 'achievement_level',
            'datatype' => 'VARCHAR(255)',
            'nullable' => true
        ],
        [
            'column_name' => 'descriptor',
            'datatype' => 'TEXT',
            'nullable' => true
        ],
        [
            'column_name' => 'term',
            'datatype' => 'INT',
            'nullable' => false
        ],
        [
            'column_name' => 'year',
            'datatype' => 'INT',
            'nullable' => false
        ],
        [
            'column_name' => 'enteredOn',
            'datatype' => 'datetime',
            'nullable' => false
        ],
        [
            'column_name' => 'enteredBy',
            'datatype' => 'INT',
            'nullable' => false
        ]

    ]
];


// Call the function to alter the table
$run = alterMyTable($con, $new_uneb_table_columns);
// Output the result of the operation
echo $run;

$general_settings_column = [
    'table_name' => 'general_settings',
    'columns' => [
        // Adding a new column
        [
            'column_name' => 'use_new_uneb_grading',
            'datatype' => 'INT',
            'nullable' => false
        ]

    ]
];
// Call the function to alter the table
$run = alterMyTable($con, $general_settings_column);
// Output the result of the operation
echo $run;


$optional_subjects = [
    'table_name' => 'optional_subjects',
    'columns' => [
        // Adding a new column
        [
            'column_name' => 'subject7',
            'datatype' => 'INT',
            'nullable' => true
        ],
        [
            'column_name' => 'subject8',
            'datatype' => 'INT',
            'nullable' => true
        ],
        [
            'column_name' => 'subject9',
            'datatype' => 'INT',
            'nullable' => true
        ],
        [
            'column_name' => 'subject10',
            'datatype' => 'INT',
            'nullable' => true
        ],
        [
            'column_name' => 'subject11',
            'datatype' => 'INT',
            'nullable' => true
        ],
        [
            'column_name' => 'subject12',
            'datatype' => 'INT',
            'nullable' => true

        ],
        [
            'column_name' => 'subject13',
            'datatype' => 'INT',
            'nullable' => true
        ],
        [
            'column_name' => 'subject14',
            'datatype' => 'INT',
            'nullable' => true
        ]
    ]
];
// Call the function to alter the table
$run = alterMyTable($con, $optional_subjects);
// Output the result of the operation
echo $run;

$juba_grading = [
    'table_name' => 'juba_grading',
    'columns' => [
        // Adding a new column

        [
            'column_name' => 'gradeId',
            'datatype' => 'INT',
            'primary_key' => TRUE,
            'auto_increment' => TRUE,
            'nullable' => false
        ],
        [
            'column_name' => 'schoolId',
            'datatype' => 'INT',
            'nullable' => false
        ],
        [
            'column_name' => 'level',
            'datatype' => 'INT',
            'nullable' => false
        ],
        [
            'column_name' => 'start',
            'datatype' => 'INT',
            'nullable' => false
        ],
        [
            'column_name' => 'end',
            'datatype' => 'INT',
            'nullable' => false
        ],
        [
            'column_name' => 'grade_points',
            'datatype' => 'INT',
            'nullable' => false
        ],
        [
            'column_name' => 'grade',
            'datatype' => 'VARCHAR(255)',
            'nullable' => true
        ],
        [
            'column_name' => 'comments',
            'datatype' => 'VARCHAR(255)',
            'nullable' => true
        ],

        [
            'column_name' => 'term',
            'datatype' => 'INT',
            'nullable' => false
        ],
        [
            'column_name' => 'year',
            'datatype' => 'INT',
            'nullable' => false
        ],
        [
            'column_name' => 'enteredOn',
            'datatype' => 'datetime',
            'nullable' => false
        ],
        [
            'column_name' => 'enteredBy',
            'datatype' => 'INT',
            'nullable' => false
        ]

    ]
];

// Call the function to alter the table
$run = alterMyTable($con, $juba_grading);
// Output the result of the operation
echo $run;


//Adding a column to store report card watermark
$update_schools = [
    'table_name' => 'schools',
    'columns' => [
        // Adding a new column
        [
            'column_name' => 'report_card_water_mark',
            'datatype' => 'varchar(100)',
            'nullable' => true
        ]

    ]
];
// Call the function to alter the table
$run = alterMyTable($con, $update_schools);
// Output the result of the operation
echo $run;

