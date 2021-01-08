<?php

namespace JulianStark999\LaravelModelIid\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use JulianStark999\LaravelModelIid\Traits\HasIidColumn;

class Init extends Command
{
    /** @var string */
    protected $signature = 'iid:init {className}';

    /** @var string */
    protected $description = 'initialize iid for a model';

    /**
     * @return int
     */
    public function handle()
    {
        $className = $this->argument('className');

        if (! class_exists($className)) {
            $this->error('model class does not exists');

            return -1;
        }

        $modelClass = new $className();

        $usesTrait = class_uses($modelClass);
        if (! array_key_exists(HasIidColumn::class, $usesTrait)) {
            $this->error('model class does not uses trait');

            return -2;
        }

        $iidColumnExist = Schema::connection(env('DB_CONNECTION'))->hasColumn($modelClass->getTable(), 'iid');
        if (! $iidColumnExist) {
            $this->error('model class does not have an iid column');

            return -3;
        }

        $this->info('Initializing iids started');

        $modelClass->whereNull('iid')->cursor()->each(function ($row) {
            $row->update([
                'iid' => $row->id,
            ]);
        });

        $this->info('Initializing iids finished');

        return 0;
    }
}
