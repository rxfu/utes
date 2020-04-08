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
     * Parse the class name and format according to the root namespace.
     *
     * @param  string  $name
     * @return string
     */
    protected function qualifyClass($name)
    {
        $name = Str::ucfirst($name) . 'Controller';
        
        dd(parent::qualifyClass($name));
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
        $replace = $this->buildModelReplacements($replace);

        $replace["use {$controllerNamespace}\Controller;\n"] = '';

        return str_replace(
            array_keys($replace),
            array_values($replace),
            parent::buildClass($name)
        );
    }

    /**
     * Build the model replacement values.
     *
     * @param  array  $replace
     * @return array
     */
    protected function buildModelReplacements(array $replace)
    {
        $model = Str::ucfirst($this->getNameInput());
        $serviceClass = $this->parseService($model);

        if (!class_exists($serviceClass)) {
            if ($this->confirm("A {$serviceClass} service does not exist. Do you want to generate it?", true)) {
                $this->call('create:service', ['name' => $serviceClass]);
            }
        }

        return array_merge($replace, [
            '{{ collection }}' => lcfirst(class_basename($model)),
            '{{ namespaceService }}' => $serviceClass,
            '{{namespaceService}}' => $serviceClass,
            '{{ service }}' => class_basename($serviceClass),
            '{{service}}' => class_basename($serviceClass),
            '{{ serviceVariable }}' => lcfirst(class_basename($serviceClass)),
            '{{servicevariable}}' => lcfirst(class_basename($serviceClass)),
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
}
