<?php

namespace JulianStark999\LaravelModelIid\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use JulianStark999\LaravelModelIid\Traits\HasIidColumn;

class InitCommand extends Command
{
    /** @var string */
    protected $signature = 'iid:init {className : Path to Model Class}';

    /** @var string|null */
    protected $description = 'initialize iid for a model';

    public function handle(): int
    {
        $className = $this->argument('className');

        if (! is_string($className)) {
            $this->error('className is not a string');

            return -4;
        }

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

        if (! schema_has_iid_column($modelClass->getTable())) {
            $this->error('model class does not have an iid column');

            return -3;
        }

        $this->info('Initializing iid started');

        $modelClass->whereNull('iid')->cursor()->each(function (Model $row): void {
            $row->update([
                'iid' => $row->id,
            ]);
        });

        $this->info('Initializing iid finished');

        return 0;
    }
}
