<?php

namespace JulianStark999\LaravelModelIid\Traits;

use Exception;
use JulianStark999\LaravelModelIid\Exceptions\SchemaDoesNotHasIidColumn;

trait HasIidColumn
{
    /**
     * @throws Exception
     */
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model): void {
            $tableName = $model->getTable();
            if (! schema_has_iid_column($tableName)) {
                throw SchemaDoesNotHasIidColumn::create($tableName);
            }

            // check if iidColumn value is not null
            if ($model[$model->iidColumn] === null) {
                return;
            }

            $latestModel = $model->where($model->iidColumn, '=', $model[$model->iidColumn])
                ->where('iid', '!=', 'NULL')
                ->orderBy('id', 'DESC')
                ->first();

            $model['iid'] = $latestModel ? $latestModel->iid + 1 : 1;
        });
    }
}
