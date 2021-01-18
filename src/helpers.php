<?php

use Illuminate\Support\Facades\Schema;

if (! function_exists('schema_has_iid_column')) {
    function schema_has_iid_column(string $tableName): bool
    {
        return Schema::connection(config('database.default'))->hasColumn($tableName, 'iid');
    }
}
