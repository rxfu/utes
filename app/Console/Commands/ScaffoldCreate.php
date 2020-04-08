<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ScaffoldCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:scaffold {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create some new classes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');

        $this->call('create:controller', compact('name'));
        $this->call('add:route', compact('name'));
        $this->call('create:view', compact('name'));
    }
}
