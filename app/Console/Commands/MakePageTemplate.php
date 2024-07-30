<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakePageTemplate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:page-template {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $name = strtolower($name);

        $this->call('make:view', ['name' => 'page.templates.' . $name]);
    }
}
