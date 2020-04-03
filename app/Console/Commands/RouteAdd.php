<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class RouteAdd extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'add route';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a new route item';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Route';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $modelTitle = ucfirst($modelName);

        $modelName = strtolower($modelName);

        $newRoutes = $this->files->get(__DIR__ . '/../Stubs/routes.stub');

        $newRoutes = str_replace('|MODEL_TITLE|', $modelTitle, $newRoutes);

        $newRoutes = str_replace('|MODEL_NAME|', $modelName, $newRoutes);

        $newRoutes = str_replace('|CONTROLLER_NAME|', $modelTitle . 'Controller', $newRoutes);

        $this->files->append(
            app_path('Http/routes.php'),
            $newRoutes
        );

        $this->info('Added routes for ' . $modelTitle);
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return base_path('stubs/route.stub');
    }
}
