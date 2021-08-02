<?php

namespace JulianStark999\LaravelModelIid\Traits;

use Exception;
use Illuminate\Database\Eloquent\Builder;
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

            $latestModel = $model->when(
                method_exists($model, 'forceDelete'),
                fn(Builder $query) => $query->whereNull('deleted_at')->orWhereNotNull('deleted_at')
            )
                ->where($model->iidColumn, '=', $model[$model->iidColumn])
                ->where('iid', '!=', 'NULL')
                ->orderBy('iid', 'DESC')
                ->first();

            $model['iid'] = $latestModel ? $latestModel->iid + 1 : 1;
        });
    }
}
