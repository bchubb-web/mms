<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use PhpToken;

class MakeManagedModel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:managed-model {model} {--parent=}';

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

        $parent = $this->option('parent');

        // Create model and migration
        $this->call('make:model', ['name' => $model, '--migration' => true]);
        $this->info('Model and migration created.');

        // Create filament resources
        $this->call('make:filament-resource', ['name' => $model, '--panel' => 'admin']);
        $this->info('Admin management resource created.');

        // make controller
        if ($parent) {
            $this->call('make:controller', ['name' => $model . 'Controller', '--model' => $model, '--api' => true, '--parent' => $parent]);
        } else {
            $this->call('make:controller', ['name' => $model . 'Controller', '--model' => $model, '--api' => true]);
        }
        $this->info('Controller created.');

        // make index and show views
        $this->call('make:view', ['name' => 'resources/views/' . strtolower($model) . '/index.blade.php']);
        $this->call('make:view', ['name' => 'resources/views/' . strtolower($model) . '/show.blade.php']);
    }
}
