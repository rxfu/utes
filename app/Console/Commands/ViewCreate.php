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
            // 'index' => resource_path('views/' . $name . '/index.blade.php'),
            // 'show' => resource_path('views/' . $name . '/show.blade.php'),
            // 'create' => resource_path('views/' . $name . '/create.blade.php'),
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
        $table = Str::plural(Str::lower($name, '\\'));

        switch ($method) {
            case 'index':
                return $this->_replaceIndex($table, $replace);

            case 'show':
                return $this->_replaceShow($table, $replace);

            case 'create':
                return $this->_replaceCreate($table, $replace);

            case 'edit':
                return $this->_replaceEdit($table, $replace);

            default:
                return $this->_replaceIndex($table, $replace);
        }
    }

    private function _replaceIndex($table, $replace)
    {
        $columns = Schema::getColumnListing($table);
        $columns = array_diff($columns, ['id', 'remember_token', 'created_at', 'updated_at']);
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
        $columns = array_diff($columns, ['id', 'remember_token', 'created_at', 'updated_at']);
        $attributes = array_map(function ($v) use ($table) {
            $table = Str::singular($table);

            $attribute = '
                <div class="form-group row">
                    <label for="' . $v . '" class="col-sm-3 col-form-label">{{ __(\'' . $table . '.' . $v . '\') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" name="' . $v . '" id="' . $v . '" value="{{ $item->' . $v . ' }}" readonly>
                    </div>
                </div>';

            return $attribute;
        }, $columns);

        return array_merge($replace, [
            '{{ attributes }}' => implode(PHP_EOL, $attributes),
        ]);
    }

    private function _replaceCreate($table, $replace)
    {

        $columns = Schema::getColumnListing($table);
        $columns = array_diff($columns, ['id', 'remember_token', 'created_at', 'update_at']);
        $attributes = array_map(function ($v) use ($table) {
            $type = Schema::getColumnType($table, $v);
            $table = Str::singular($table);

            $attribute = '
                    <div class="form-group row">
                        <label for="' . $v . '" class="col-sm-3 col-form-label">{{ __(\'' . $table . '.' . $v . '\') }}</label>
                        <div class="col-sm-9">
                            ';

            switch ($type) {
                case 'text':
                    $attribute .= '<textarea class="form-control{{ $errors->has(\'' . $v . '\') ? \' is_invalid\' : \'\' }}" name="' . $v . '" id="' . $v . '" rows="5" placeholder="{{ __(\'' . $table . '.' . $v . '\') }}">{{ old(\'' . $v . '\') }}</textarea>';
                    break;

                case 'boolean':
                    $attribute .= '<div class="form-check form-check-inline">
                                <input type="radio" name="' . $v . '" id="' . $v . '" class="form-check-input{{ $errors->has(\'' . $v . '\') ? \' is_invalid\' : \'\' }}" value="1" checked>
                                <label class="form-check-label" for="' . $v . '1">是</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="' . $v . '" id="' . $v . '0" class="form-check-input{{ $errors->has(\'' . $v . '\') ? \' is_invalid\' : \'\' }}" value="0">
                                <label class="form-check-label" for="' . $v . '0">否</label>
                            </div>';
                    break;

                case 'datetime':
                    $attribute .= '<div class="form-group">
                                <div class="input-group datepicker">
                                    <input type="text" name="' . $v . '" id="' . $v . '" class="form-control{{ $errors->has(\'' . $v . '\']) ? \' is_invalid\' : \'\' }}" placeholder="{{ __(\'' . $table . '.' . $v . '\') }}" value="{{ old(\'' . $v . '\') }}">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                    break;

                default:
                    $attribute .= '<input type="text" class="form-control{{ $errors->has(\'' . $v . '\') ? \' is_invalid\' : \'\' }}" name="' . $v . '" id="' . $v . '" placeholder="{{ __(\'' . $table . '.' . $v . '\') }}" value="{{ old(\'' . $v . '\') }}">';
                    break;
            }

            $attribute .=  '
                        </div>
                    </div>';

            return $attribute;
        }, $columns);

        return array_merge($replace, [
            '{{ attributes }}' => implode(PHP_EOL, $attributes),
        ]);
    }

    private function _replaceEdit($table, $replace)
    {

        $columns = Schema::getColumnListing($table);
        $columns = array_diff($columns, ['id', 'remember_token', 'created_at', 'updated_at']);
        $attributes = array_map(function ($v) use ($table) {
            $type = Schema::getColumnType($table, $v);
            $table = Str::singular($table);

            $attribute = '
                    <div class="form-group row">
                        <label for="' . $v . '" class="col-sm-3 col-form-label">{{ __(\'' . $table . '.' . $v . '\') }}</label>
                        <div class="col-sm-9">
                            ';

            switch ($type) {
                case 'text':
                    $attribute .= '<textarea class="form-control{{ $errors->has(\'' . $v . '\') ? \' is_invalid\' : \'\' }}" name="' . $v . '" id="' . $v . '" rows="5" placeholder="{{ __(\'' . $table . '.' . $v . '\') }}">{{ old(\'' . $v . '\', $item->' . $v . ') }}</textarea>';
                    break;

                case 'boolean':
                    $attribute .= '<div class="form-check form-check-inline">
                                <input type="radio" name="' . $v . '" id="' . $v . '" class="form-check-input{{ $errors->has(\'' . $v . '\') ? \' is_invalid\' : \'\' }}" value="1"{{ old(\'' . $v . '\', $item->' . $v .') === 1 ? \' checked\' : \'\' }}>
                                <label class="form-check-label" for="' . $v . '1">是</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="' . $v . '" id="' . $v . '0" class="form-check-input{{ $errors->has(\'' . $v . '\') ? \' is_invalid\' : \'\' }}" value="0"{{ old(\'' . $v . '\', $item->' . $v .') === 0 ? \' checked\' : \'\' }}>
                                <label class="form-check-label" for="' . $v . '0">否</label>
                            </div>';
                    break;

                case 'datetime':
                    $attribute .= '<div class="form-group">
                                <div class="input-group datepicker">
                                    <input type="text" name="' . $v . '" id="' . $v . '" class="form-control{{ $errors->has(\'' . $v . '\']) ? \' is_invalid\' : \'\' }}" placeholder="{{ __(\'' . $table . '.' . $v . '\') }}" value="{{ old(\'' . $v . '\', $item->' . $v . ') }}">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                    break;

                default:
                    $attribute .= '<input type="text" class="form-control{{ $errors->has(\'' . $v . '\') ? \' is_invalid\' : \'\' }}" name="' . $v . '" id="' . $v . '" placeholder="{{ __(\'' . $table . '.' . $v . '\') }}" value="{{ old(\'' . $v . '\', $item->' . $v . ') }}">';
                    break;
            }

            $attribute .=  '
                        </div>
                    </div>';

            return $attribute;
        }, $columns);

        return array_merge($replace, [
            '{{ attributes }}' => implode(PHP_EOL, $attributes),
        ]);
    }
}
