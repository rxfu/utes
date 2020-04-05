<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class ViewCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:view {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create model resource views';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'View';

    /**
     * Create a new command instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem  $files
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $modelName = $this->argument('name');
        $replace = [
            '{{ model }}' => ucfirst($modelName),
            '{{ modelVariable }}' => Str::plural(Str::lower($modelName)),
        ];

        $stubs = $this->files->get($this->getStubs());
        $stubs = str_replace(array_keys($replace), array_values($replace), $stubs);

        $paths = $this->getPaths(Str::lower($modelName));

        foreach ($paths as $method => $path) {
            $this->makeDirectory($path);

            $this->files->put($path, $stubs[$method]);
        }

        $this->info($this->type . 's created successfully.');
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return [
            'index' => base_path('stubs/index.blade.stub'),
            'show' => base_path('stubs/show.blade.stub'),
            'create' => base_path('stubs/create.blade.stub'),
            'edit' => base_path('stubs/edit.blade.stub'),
        ];
    }

    /**
     * Build the directory for the view if necessary.
     *
     * @param  string  $path
     * @return string
     */
    protected function makeDirectory($path)
    {
        if (!$this->files->isDirectory(dirname($path))) {
            $this->files->makeDirectory(dirname($path), 0777, true, true);
        }

        return $path;
    }

    /**
     * Get the destination view path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPaths($name)
    {
        return [
            'index' => resource_path('views/' . $name . '/index.blade.php'),
            'show' => resource_path('views/' . $name . '/show.blade.php'),
            'create' => resource_path('views/' . $name . '/create.blade.php'),
            'edit' => resource_path('views/' . $name . '/edit.blade.php'),
        ];
    }
}
