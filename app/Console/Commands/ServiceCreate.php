<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use InvalidArgumentException;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class ServiceCreate extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'create:service';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Service';

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
        return base_path('stubs\service.stub');
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Services';
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
        $serviceNamespace = $this->getNamespace($name);

        $replace = [];

        if ($this->option('repository')) {
            $repositoryClass = $this->parseRepository($this->option('repository'));

            if (!class_exists($repositoryClass)) {
                if ($this->confirm("A {$repositoryClass} repository does not exist. Do you want to generate it?", true)) {
                    $this->call('create:repository', ['name' => $repositoryClass]);
                }
            }

            $replace = array_merge($replace, [
                'DummyFullRepositoryClass' => $repositoryClass,
                '{{ namespacedRepository }}' => $repositoryClass,
                '{{namespacedRepository}}' => $repositoryClass,
                'DummyRepositoryClass' => class_basename($repositoryClass),
                '{{ repository }}' => class_basename($repositoryClass),
                '{{repository}}' => class_basename($repositoryClass),
                'DummyRepositoryVariable' => lcfirst(class_basename($repositoryClass)),
                '{{ repositoryVariable }}' => lcfirst(Str::plural($this->option('repository'))),
                '{{repositoryVariable}}' => lcfirst(Str::plural($this->option('repository'))),
            ]);
        }

        $replace["use {$serviceNamespace}\Service;\n"] = '';

        return str_replace(
            array_keys($replace),
            array_values($replace),
            parent::buildClass($name)
        );
    }

    /**
     * Get the fully-qualified repository class name.
     *
     * @param  string  $repository
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    protected function parseRepository($repository)
    {
        if (preg_match('([^A-Za-z0-9_/\\\\])', $repository)) {
            throw new InvalidArgumentException('Repository name contains invalid characters.');
        }

        $repository = trim(str_replace('/', '\\', $repository), '\\');
        $repository = 'Repositories\\' . $repository . 'Repository';

        if (!Str::startsWith($repository, $rootNamespace = $this->laravel->getNamespace())) {
            $repository = $rootNamespace . $repository;
        }

        return $repository;
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['repository', 'm', InputOption::VALUE_OPTIONAL, 'Generate a service for the given repository.'],
        ];
    }
}
