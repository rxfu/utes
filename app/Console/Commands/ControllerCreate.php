<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use InvalidArgumentException;
use Illuminate\Console\GeneratorCommand;

class ControllerCreate extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'create:controller';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new controller class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Controller';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return base_path('stubs/controller.stub');
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Http\Controllers';
    }

    /**
     * Execute the console command.
     *
     * @return bool|null
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        $controller = Str::studly($this->getNameInput()) . 'Controller';
        $name = $this->qualifyClass($controller);

        $path = $this->getPath($name);

        // First we will check to see if the class already exists. If it does, we don't want
        // to create the class and overwrite the user's code. So, we will bail out so the
        // code is untouched. Otherwise, we will continue generating this class' files.
        if ((!$this->hasOption('force') || !$this->option('force')) && $this->alreadyExists($controller)) {
            $this->error($this->type . ' already exists!');

            return false;
        }

        // Next, we will generate the path to the location where this class' file should get
        // written. Then, we will build the class and make the proper replacements on the
        // stub files so that it gets the correctly formatted namespace and class name.
        $this->makeDirectory($path);

        $this->files->put($path, $this->sortImports($this->buildClass($name)));

        $this->info($this->type . ' created successfully.');
    }

    /**
     * Build the class with the given name.
     *
     * Remove the base controller import if we are already in base namespace.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        $controllerNamespace = $this->getNamespace($name);

        $replace = [];
        $replace = $this->buildServiceReplacements($replace);

        $replace["use {$controllerNamespace}\Controller;\n"] = '';

        return str_replace(
            array_keys($replace),
            array_values($replace),
            parent::buildClass($name)
        );
    }

    /**
     * Build the service replacement values.
     *
     * @param  array  $replace
     * @return array
     */
    protected function buildServiceReplacements(array $replace)
    {
        $model = Str::studly($this->getNameInput());
        $serviceClass = $this->parseService($model);
        $modelClass = $this->parseModel($model);
        $storeRequestClass = $this->parseRequest($model, 'store');
        $updateRequestClass = $this->parseRequest($model, 'update');

        if (!class_exists($serviceClass)) {
            if ($this->confirm("A {$serviceClass} service does not exist. Do you want to generate it?", true)) {
                $this->call('create:service', ['name' => $model]);
            }
        }

        if (!class_exists($storeRequestClass)) {
            if ($this->confirm("A {$storeRequestClass} request does not exist. Do you want to generate it?", true)) {
                $this->call('make:request', ['name' => $storeRequestClass]);
            }
        }

        if (!class_exists($updateRequestClass)) {
            if ($this->confirm("A {$updateRequestClass} request does not exist. Do you want to generate it?", true)) {
                $this->call('make:request', ['name' => $updateRequestClass]);
            }
        }

        return array_merge($replace, [
            '{{ model }}' => $model,
            '{{ object }}' => Str::snake($model),
            '{{ collection }}' => Str::kebab(Str::pluralStudly($model)),
            '{{ namespaceStoreRequest }}' => $storeRequestClass,
            '{{ namespaceUpdateRequest }}' => $updateRequestClass,
            '{{ namespaceModel }}' => $modelClass,
            '{{ namespaceService }}' => $serviceClass,
            '{{ service }}' => class_basename($serviceClass),
            '{{ serviceVariable }}' => Str::camel(class_basename($serviceClass)),
            '{{ storeRequest }}' => class_basename($storeRequestClass),
            '{{ updateRequest }}' => class_basename($updateRequestClass),
        ]);
    }

    /**
     * Get the fully-qualified sevice class name.
     *
     * @param  string  $service
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    protected function parseService($service)
    {
        if (preg_match('([^A-Za-z0-9_/\\\\])', $service)) {
            throw new InvalidArgumentException('Service name contains invalid characters.');
        }

        $service = trim(str_replace('/', '\\', $service), '\\');
        $service = 'Services\\' . $service . 'Service';

        if (!Str::startsWith($service, $rootNamespace = $this->laravel->getNamespace())) {
            $service = $rootNamespace . $service;
        }

        return $service;
    }

    /**
     * Get the fully-qualified model class name.
     *
     * @param  string  $model
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    protected function parseModel($model)
    {
        if (preg_match('([^A-Za-z0-9_/\\\\])', $model)) {
            throw new InvalidArgumentException('Model name contains invalid characters.');
        }

        $model = trim(str_replace('/', '\\', $model), '\\');
        $model = 'Models\\' . $model;

        if (!Str::startsWith($model, $rootNamespace = $this->laravel->getNamespace())) {
            $model = $rootNamespace . $model;
        }

        return $model;
    }

    /**
     * Get the fully-qualified request class name.
     *
     * @param  string  $model
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    protected function parseRequest($model, $action)
    {
        if (preg_match('([^A-Za-z0-9_/\\\\])', $model)) {
            throw new InvalidArgumentException('Model name contains invalid characters.');
        }

        $model = trim(str_replace('/', '\\', $model), '\\');
        $model = 'Http\\Requests\\' . $model . Str::Studly($action) . 'Request';

        if (!Str::startsWith($model, $rootNamespace = $this->laravel->getNamespace())) {
            $model = $rootNamespace . $model;
        }

        return $model;
    }
}
