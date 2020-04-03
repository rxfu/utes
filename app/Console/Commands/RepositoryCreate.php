<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use InvalidArgumentException;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class RepositoryCreate extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'create:repository';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Repository';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        parent::handle();
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return base_path('stubs\repository.stub');
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Repositories';
    }

    /**
     * Build the class with the given name.
     *
     * Remove the base repository import if we are already in base namespace.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        $repositoryNamespace = $this->getNamespace($name);

        $replace = [];

        if ($this->option('model')) {
            $modelClass = $this->parseModel($this->option('model'));

            if (!class_exists($modelClass)) {
                if ($this->confirm("A {$modelClass} model does not exist. Do you want to generate it?", true)) {
                    $this->call('make:model', ['name' => $modelClass]);
                }
            }

            $replace = array_merge($replace, [
                'DummyFullModelClass' => $modelClass,
                '{{ namespacedModel }}' => $modelClass,
                '{{namespacedModel}}' => $modelClass,
                'DummyModelClass' => class_basename($modelClass),
                '{{ model }}' => class_basename($modelClass),
                '{{model}}' => class_basename($modelClass),
                'DummyModelVariable' => lcfirst(class_basename($modelClass)),
                '{{ modelVariable }}' => lcfirst(class_basename($modelClass)),
                '{{modelVariable}}' => lcfirst(class_basename($modelClass)),
            ]);
        }

        $replace["use {$repositoryNamespace}\Repository;\n"] = '';

        return str_replace(
            array_keys($replace),
            array_values($replace),
            parent::buildClass($name)
        );
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
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['model', 'm', InputOption::VALUE_OPTIONAL, 'Generate a repository for the given model.'],
        ];
    }
}
