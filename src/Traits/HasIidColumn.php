<?php

namespace JulianStark999\LaravelModelIid\Traits;

use Exception;
use Illuminate\Support\Facades\Schema;

trait HasIidColumn
{
    /**
     * @throws Exception
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $iidColumnExist = Schema::connection(config('database.default'))->hasColumn($model->getTable(), 'iid');

            if (! $iidColumnExist) {
                throw new Exception('The `iid` column was not found in `'.$model->getTable().'` table.');
            }

            $latestModel = $model->where($model->iidColumn, '=', $model[$model->iidColumn])
                ->where('iid', '!=', 'NULL')
                ->orderBy('id', 'DESC')
                ->first();

            $model['iid'] = $latestModel ? ($latestModel->iid + 1) : 1;
        });
    }
}
