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
        $model = Str::snake($name);
        $replace = [
            'DummyModel' => $model,
            'DummyCollection' => Str::kebab(Str::pluralStudly($name)),
        ];

        $paths = $this->getPaths($model);

        foreach ($paths as $method => $path) {
            if ($this->files->exists($path)) {
                $this->error(Str::ucfirst($method) . $this->type . ' already exists!');
            } else {
                $this->makeDirectory($path);

                $stub = $this->files->get($this->getStub($method));
                $replace = $this->replaceAttributes($name, $replace, $method);
                $stub = str_replace(array_keys($replace), array_values($replace), $stub);

                $this->files->put($path, $stub);

                $this->info(Str::ucfirst($method) . $this->type . ' created successfully.');
            }
        }

        $this->call('create:translation', compact('name'));
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
     * Get the service namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getServiceNamespace()
    {
        return 'App\Services';
        // return $this->laravel->getNamespace() . '\Services';
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

    /**
     * Build the attribute replacement values.
     *
     * @param  string  $name
     * @return array
     */
    protected function replaceAttributes($name, $replace, $method)
    {
        $table = Str::snake(Str::pluralStudly($name));
        $replaceMethod = '_replace' . ucfirst($method);

        return $this->$replaceMethod($table, $replace);
    }

    private function _replaceIndex($table, $replace)
    {
        $columns = Schema::getColumnListing($table);
        $columns = array_diff($columns, ['remember_token', 'created_at', 'updated_at']);

        $attributeNames = array_map(function ($column) use ($table) {
            $table = Str::singular($table);

            return "<th>{{ __('$table.$column') }}</th>";
        }, $columns);

        $attributes = array_map(function ($column) {
            return '<td>{{ $item->' . $column . ' }}</td>';
        }, $columns);

        return array_merge($replace, [
            '{{ attributeName }}' => implode(PHP_EOL . "\t\t\t\t\t\t\t", $attributeNames),
            '{{ attribute }}' => implode(PHP_EOL . "\t\t\t\t\t\t\t\t", $attributes),
        ]);
    }

    private function _replaceShow($table, $replace)
    {
        $columns = Schema::getColumnListing($table);
        $columns = array_diff($columns, ['remember_token', 'created_at', 'updated_at']);

        $attributes = array_map(function ($column) use ($table) {
            $table = Str::singular($table);

            $attribute = '
                <div class="form-group row">
                    <label for="' . $column . '" class="col-sm-3 col-form-label text-right">{{ __(\'' . $table . '.' . $column . '\') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="' . $column . '" id="' . $column . '" value="{{ $item->' . $column . ' }}" readonly>
                    </div>
                </div>';

            return $attribute;
        }, $columns);

        return array_merge($replace, [
            '{{ attribute }}' => implode(PHP_EOL, $attributes),
        ]);
    }

    private function _replaceCreate($table, $replace)
    {
        $columns = Schema::getColumnListing($table);
        $columns = array_diff($columns, ['id', 'remember_token', 'created_at', 'updated_at']);

        $attributes = array_map(function ($column) use ($table) {
            $type = Schema::getColumnType($table, $column);
            $table = Str::singular($table);

            $attribute = '
                    <div class="form-group row">
                        <label for="' . $column . '" class="col-sm-3 col-form-label text-right">{{ __(\'' . $table . '.' . $column . '\') }}</label>
                        <div class="col-sm-9">
                            ';

            if (substr($column, -3) === '_id') {
                $model = substr($column, 0, -3);
                $collection = Str::camel(Str::plural($model));
                $attribute .= '@inject(\'' . $collection . '\', \'' . $this->getServiceNamespace() . '\\' . Str::studly($model) . 'Service\')' . PHP_EOL . "\t\t\t\t\t\t\t";
                $attribute .= '<select name="' . $column . '" id="' . $column . '" class="form-control select2 select2-success{{ $errors->has(\'' . $column . '\') ? \' is_invalid\' : \'\' }}" data-dropdown-css-class="select2-success">
                                @foreach ($' . Str::camel(Str::plural($model)) . '->getAll() as $collection)
                                    <option value="{{ $collection->getKey() }}">{{ $collection->name }}</option>
                                @endforeach
                            </select>';
            } else {
                switch ($type) {
                    case 'text':
                        $attribute .= '<textarea class="form-control{{ $errors->has(\'' . $column . '\') ? \' is_invalid\' : \'\' }}" name="' . $column . '" id="' . $column . '" rows="5" placeholder="{{ __(\'' . $table . '.' . $column . '\') }}">{{ old(\'' . $column . '\') }}</textarea>';
                        break;

                    case 'boolean':
                        $attribute .= '<div class="icheck-success icheck-inline">
                                <input type="radio" name="' . $column . '" id="' . $column . '1" class="form-check-input{{ $errors->has(\'' . $column . '\') ? \' is_invalid\' : \'\' }}" value="1" checked>
                                <label class="form-check-label" for="' . $column . '1">是</label>
                            </div>
                            <div class="icheck-success icheck-inline">
                                <input type="radio" name="' . $column . '" id="' . $column . '0" class="form-check-input{{ $errors->has(\'' . $column . '\') ? \' is_invalid\' : \'\' }}" value="0">
                                <label class="form-check-label" for="' . $column . '0">否</label>
                            </div>';
                        break;

                    case 'datetime':
                        $attribute .= '<div class="form-group">
                                <div class="input-group datepicker">
                                    <input type="text" name="' . $column . '" id="' . $column . '" class="form-control{{ $errors->has(\'' . $column . '\') ? \' is_invalid\' : \'\' }}" placeholder="{{ __(\'' . $table . '.' . $column . '\') }}" value="{{ old(\'' . $column . '\') }}">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                        break;

                    default:
                        $attribute .= '<input type="text" class="form-control{{ $errors->has(\'' . $column . '\') ? \' is_invalid\' : \'\' }}" name="' . $column . '" id="' . $column . '" placeholder="{{ __(\'' . $table . '.' . $column . '\') }}" value="{{ old(\'' . $column . '\') }}">';
                        break;
                }
            }

            $attribute .=  '
                            @if ($errors->has(\'' . $column . '\'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first(\'' . $column . '\') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>';

            return $attribute;
        }, $columns);

        return array_merge($replace, [
            '{{ attribute }}' => implode(PHP_EOL, $attributes),
        ]);
    }

    private function _replaceEdit($table, $replace)
    {
        $columns = Schema::getColumnListing($table);
        $columns = array_diff($columns, ['id', 'remember_token', 'created_at', 'updated_at']);

        $attributes = array_map(function ($column) use ($table) {
            $type = Schema::getColumnType($table, $column);
            $table = Str::singular($table);

            $attribute = '
                    <div class="form-group row">
                        <label for="' . $column . '" class="col-sm-3 col-form-label text-right">{{ __(\'' . $table . '.' . $column . '\') }}</label>
                        <div class="col-sm-9">
                            ';

            if (substr($column, -3) === '_id') {
                $model = substr($column, 0, -3);
                $collection = Str::camel(Str::plural($model));
                $attribute .= '@inject(\'' . $collection . '\', \'' . $this->getServiceNamespace() . '\\' . Str::studly($model) . 'Service\')' . PHP_EOL . "\t\t\t\t\t\t\t";
                $attribute .= '<select name="' . $column . '" id="' . $column . '" class="form-control select2 select2-info{{ $errors->has(\'' . $column . '\') ? \' is_invalid\' : \'\' }}" data-dropdown-css-class="select2-info">
                                @foreach ($' . Str::camel(Str::plural($model)) . '->getAll() as $collection)
                                    <option value="{{ $collection->getKey() }}"{{ old(\'' . $column . '\', $item->' . $column . ') === $collection->getKey() ? \' selected\' : \'\' }}>{{ $collection->name }}</option>
                                @endforeach
                            </select>';
            } else {
                switch ($type) {
                    case 'text':
                        $attribute .= '<textarea class="form-control{{ $errors->has(\'' . $column . '\') ? \' is_invalid\' : \'\' }}" name="' . $column . '" id="' . $column . '" rows="5" placeholder="{{ __(\'' . $table . '.' . $column . '\') }}">{{ old(\'' . $column . '\', $item->' . $column . ') }}</textarea>';
                        break;

                    case 'boolean':
                        $attribute .= '<div class="icheck-info icheck-inline">
                                <input type="radio" name="' . $column . '" id="' . $column . '1" class="form-check-input{{ $errors->has(\'' . $column . '\') ? \' is_invalid\' : \'\' }}" value="1"{{ old(\'' . $column . '\', $item->' . $column . ') == 1 ? \' checked\' : \'\' }}>
                                <label class="form-check-label" for="' . $column . '1">是</label>
                            </div>
                            <div class="icheck-info icheck-inline">
                                <input type="radio" name="' . $column . '" id="' . $column . '0" class="form-check-input{{ $errors->has(\'' . $column . '\') ? \' is_invalid\' : \'\' }}" value="0"{{ old(\'' . $column . '\', $item->' . $column . ') == 0 ? \' checked\' : \'\' }}>
                                <label class="form-check-label" for="' . $column . '0">否</label>
                            </div>';
                        break;

                    case 'datetime':
                        $attribute .= '<div class="form-group">
                                <div class="input-group datepicker">
                                    <input type="text" name="' . $column . '" id="' . $column . '" class="form-control{{ $errors->has(\'' . $column . '\') ? \' is_invalid\' : \'\' }}" placeholder="{{ __(\'' . $table . '.' . $column . '\') }}" value="{{ old(\'' . $column . '\', $item->' . $column . ') }}">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                        break;

                    default:
                        $attribute .= '<input type="text" class="form-control{{ $errors->has(\'' . $column . '\') ? \' is_invalid\' : \'\' }}" name="' . $column . '" id="' . $column . '" placeholder="{{ __(\'' . $table . '.' . $column . '\') }}" value="{{ old(\'' . $column . '\', $item->' . $column . ') }}">';
                        break;
                }
            }

            $attribute .=  '
                            @if ($errors->has(\'' . $column . '\'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first(\'' . $column . '\') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>';

            return $attribute;
        }, $columns);

        return array_merge($replace, [
            '{{ attribute }}' => implode(PHP_EOL, $attributes),
        ]);
    }
}
