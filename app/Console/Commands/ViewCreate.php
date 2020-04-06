<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Schema;

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
        $name = $this->argument('name');
        $replace = [
            'DummyModel' => Str::lower($name),
            'DummyCollection' => Str::plural(Str::lower($name)),
        ];

        $paths = $this->getPaths(Str::lower($name));

        foreach ($paths as $method => $path) {
            $this->makeDirectory($path);

            $stub = $this->files->get($this->getStub($method));
            $replace = $this->replaceAttributes($name, $replace, $method);
            $stub = str_replace(array_keys($replace), array_values($replace), $stub);

            $this->files->put($path, $stub);

            $this->info(Str::ucfirst($method) . $this->type . ' created successfully.');
        }
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub($name)
    {
        return base_path('stubs/' . $name . '.blade.stub');
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
            // 'create' => resource_path('views/' . $name . '/create.blade.php'),
            // 'edit' => resource_path('views/' . $name . '/edit.blade.php'),
        ];
    }

    /**
     * Build the attribute replacement values.
     *
     * @param  string  $name
     * @return array
     */
    protected function replaceAttributes($name, $replace, $method)
    {
        $table = Str::plural(Str::lower($name, '\\'));

        switch ($method) {
            case 'index':
                return $this->_replaceIndex($table, $replace);

            case 'show':
                return $this->_replaceShow($table, $replace);

            default:
                return $this->_replaceIndex($table, $replace);
        }
    }

    private function _replaceIndex($table, $replace)
    {
        $columns = Schema::getColumnListing($table);
        $columns = array_diff($columns, ['id', 'created_at', 'updated_at']);
        $attributeNames = array_map(function ($v) use ($table) {
            $table = Str::singular($table);
            return "<th>{{ __('$table.$v') }}</th>";
        }, $columns);
        $attributes = array_map(function ($v) {
            return '<td>{{ $item->' . $v . ' }}</td>';
        }, $columns);

        return array_merge($replace, [
            '{{ attributeNames }}' => implode(PHP_EOL . "\t\t\t\t\t\t", $attributeNames),
            '{{ attributes }}' => implode(PHP_EOL . "\t\t\t\t\t\t\t", $attributes),
        ]);
    }

    private function _replaceShow($table, $replace)
    {

        $columns = Schema::getColumnListing($table);
        $columns = array_diff($columns, ['id', 'created_at', 'updated_at']);
        $attributes = array_map(function ($v) use ($table) {
            $table = Str::singular($table);

            $attribute = '
                <div class="form-group row">
                    <label for="' . $v . '" class="col-sm-3 col-form-label">{{ __(\'' . $table . '.' . $v . '\') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="{{ __(\'' . $table . '.' . $v . '\') }}" id="{{ __(\'' . $table . '.' . $v . '\') }}" value="{{ $item->' . $v . ' }}" readonly>
                    </div>
                </div>';

            return $attribute;
        }, $columns);

        return array_merge($replace, [
            '{{ attributes }}' => implode(PHP_EOL, $attributes),
        ]);
    }
}
