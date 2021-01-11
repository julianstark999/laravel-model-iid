<?php

use Illuminate\Support\Facades\Schema;

if (! function_exists('schema_has_iid_column')) {
    /**
     * @param $tableName
     *
     * @return bool
     */
    function schema_has_iid_column($tableName)
    {
      return Schema::connection(config('database.default'))->hasColumn($tableName, 'iid');
    }
}
