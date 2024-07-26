<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeManagedModel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:managed-model {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generate laravel model and admin panel resource';

    public function __construct(protected Filesystem $files)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $model = $this->argument('model');
        $model = ucfirst($model);

        // Create model and migration
        $this->call('make:model', ['name' => $model, '--migration' => true]);

        // Create filament resources
        $this->call('make:filament-resource', ['name' => $model, '--panel' => 'admin']);

        // make controller
        $this->call('make:controller', ['name' => $model . 'Controller', '--model' => $model, '--api' => true]);
    }
}
