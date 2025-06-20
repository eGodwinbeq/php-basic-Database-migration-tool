# php-basic-Database-migration-tool

# `migrate()` Function

Alters or creates a MySQL database table based on the provided configuration.

---

## Description

The `migrate()` function allows you to create a new table or alter an existing one. Alterations include adding, modifying, or renaming columns. This is especially useful for automated schema migrations in custom PHP applications.

---

## Parameters

### `mysqli $con`

The active MySQLi connection object.

### `array $params`

An associative array with the following structure:

| Key            | Type     | Description                                                                 |
|----------------|----------|-----------------------------------------------------------------------------|
| `table_name`   | `string` | The name of the table to be created or altered.                             |
| `columns`      | `array`  | Array of column definition arrays. Each array can contain:                  |

Each column definition supports:

| Key              | Type      | Required | Description                                                                 |
|------------------|-----------|----------|-----------------------------------------------------------------------------|
| `column_name`    | `string`  | ✅        | The current name of the column.                                             |
| `datatype`       | `string`  | ✅        | SQL datatype for the column (e.g., `INT`, `VARCHAR(100)`).                  |
| `nullable`       | `bool`    | ✅        | Whether the column allows NULL values.                                      |
| `default_value`  | `mixed`   | ❌        | Default value for the column.                                               |
| `primary_key`    | `bool`    | ❌        | Whether the column should be set as the primary key.                        |
| `auto_increment` | `bool`    | ❌        | Whether the column should auto-increment (usually with primary keys).       |
| `after_this`     | `string`  | ❌        | Indicates the column after which to add the new column.                     |
| `new_name`       | `string`  | ❌        | New name for the column (used when renaming).                               |

---

## Return Value

- `"Table created successfully"` if a new table is created.
- `"Done"` if the table was altered successfully.
- `void` if an error occurs (the error will be echoed to output).

---

## Behavior

- Checks if the specified table exists.
  - If not, a **CREATE TABLE** statement is generated using the provided column definitions.
  - If it exists, **ALTER TABLE** is used to:
    - Add new columns.
    - Modify existing ones.
    - Rename columns (via `CHANGE`).
- Automatically applies:
  - Primary key constraints.
  - Auto-increment where applicable.
  - Default values and nullability.
- Errors are output directly using `echo`.

---

## Example Usage

```php
$params = [
    'table_name' => 'employees',
    'columns' => [
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
        [
            'column_name' => 'full_name',
            'new_name' => 'name',
            'datatype' => 'VARCHAR(111)',
            'nullable' => false
        ],
        [
            'column_name' => 'email',
            'datatype' => 'VARCHAR(255)',
            'nullable' => true,
            'default_value' => 'example@example.com'
        ]
    ]
];

$result = migrate($con, $params);
echo $result;
