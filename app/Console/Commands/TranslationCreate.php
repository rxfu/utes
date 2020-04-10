<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Schema;

class TranslationCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:translation {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new translation';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Translation';

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
        $table = Str::plural(Str::lower($name));
        $stub = $this->files->get($this->getStub());
        $path = resource_path('lang/zh-cn/' . Str::lower($name) . '.php');
        if ($this->files->exists($path)) {
            $this->error($this->type . ' already exists!');
        } else {
            $columns = Schema::getColumnListing($table);
            $columns = array_diff($columns, ['remember_token', 'created_at', 'updated_at']);
            $schema = DB::getDoctrineSchemaManager()->listTableDetails($table);
            $translations = array_map(function ($v) use ($schema) {
                return "'$v' => '" . ($schema->getColumn($v)->getComment() ?: Str::upper($v)) . "',";
            }, $columns);

            $replace = [
                '{{ modelName }}' => Str::ucfirst($name),
                '{{ collection }}' => implode(PHP_EOL . "\t", $translations),
            ];
            $stub = str_replace(array_keys($replace), array_values($replace), $stub);

            $this->files->put($path, $stub);

            $this->info($this->type . ' created successfully.');
        }
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return base_path('stubs/translation.stub');
    }
}
