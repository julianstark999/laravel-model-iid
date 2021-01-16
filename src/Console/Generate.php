<?php

namespace JulianStark999\LaravelModelIid\Console;

use Illuminate\Console\Command;
use JulianStark999\LaravelModelIid\Traits\HasIidColumn;

class Generate extends Command
{
    /** @var string */
    protected $signature = 'iid:generate {className}';

    /** @var string */
    protected $description = 'generates missing iids for a model';

    public function handle(): int
    {
        $className = $this->argument('className');

        if (! class_exists($className)) {
            $this->error('model class does not exists');

            return -1;
        }

        $modelClass = new $className();

        $usesTrait = class_uses($modelClass);
        if (! array_key_exists(HasIidColumn::class, $usesTrait)) {
            $this->error('model class does not use trait');

            return -2;
        }

        if (! schema_has_iid_column($modelClass->getTable())) {
            $this->error('model class does not support iid');

            return -3;
        }

        $this->info('Generating iids started');

        $modelClass->whereNull('iid')->cursor()->each(function ($row) use ($modelClass): void {
            $latestModel = $row->where($modelClass->iidColumn, $row[$modelClass->iidColumn])
                ->whereNotNull('iid')
                ->orderBy('id', 'DESC')
                ->first();

            $row->update([
                'iid' => $latestModel ? $latestModel->iid + 1 : 1,
            ]);
        });

        $this->info('Generating iids finished');

        return 0;
    }
}
