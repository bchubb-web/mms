<?php

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Artisan;

Artisan::command('make:page-template {name}', function () {
    $name = strtolower($this->argument('name'));

    $this->call('make:view', ['name' => 'page.templates.' . $name]);
})->purpose('Create a template for a Page');

Artisan::command('make:managed-model {model} {--parent=}', function (Filesystem $files) {
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
    $controllerOptions = ['name' => $model . 'Controller', '--model' => $model];
    if ($parent) {
        $this->call('make:controller', [ ...$controllerOptions, '--parent' => $parent, '--type' => 'nested.managed']);
    } else {
        $this->call('make:controller', [ ...$controllerOptions, '--type' => 'managed' ]);
    }
    $this->info('Controller created.');

    // make index and show views
    $this->call('make:view', ['name' => strtolower($model) . '.index']);
    $this->call('make:view', ['name' => strtolower($model) . '.show']);
    $this->info('Views created.');
})->purpose('Generate model and matching admin panel resource');

