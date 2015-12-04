<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class FormGenerateCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'generate:form';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates form class and yaml or array config';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Form';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return base_path('resources').'/stubs/datatable.stub';
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $name = $this->parseName($this->getNameInput());
        $path = $this->getPath($name);

        if ($this->alreadyExists($this->getNameInput())) {
            $this->error($this->type.' already exists!');

            return false;
        }

        $this->makeDirectory($path);

        $configName = Str::snake(class_basename($this->argument('name')));
        $className = str_replace($this->getNamespace($name).'\\', '', $name);
        $functionToExec = 'loadFromConfigYaml';
        $configStub = 'form-config.yaml.stub';
        $configPath = $path;

        if ($this->option('array')) {
            $configName .= '.php';
            $functionToExec = 'loadFromConfigArray';
            $configStub = 'form-config.array.stub';
        }
        else { $configName .= '.yaml'; }

        //Put file
        $this->files->put(
            $path,
            $this->prepareFile($className, $this->getNamespace($name), $configName, $functionToExec)
        );

        //Put config
        $configPath = str_replace($className.'.php', $configName, $configPath);

        $this->files->put(
            $configPath,
            $this->files->get(base_path('resources').'/stubs/'.$configStub)
        );

        $this->info('Form created successfully!');
        $this->info('Form config: '.$configName.' created successfully!');

    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace;
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['yaml', 'y', InputOption::VALUE_NONE, 'Creates yaml config file with form class.'],
            ['array', 'a', InputOption::VALUE_NONE, 'Creates array config file with form class.'],
        ];
    }

    public function prepareFile($className, $namespace, $configName, $functionToExec) {
        $stub = $this->files->get(base_path('resources').'/stubs/form.stub');

        $stub = str_replace('{{config}}', $configName, $stub);
        $stub = str_replace('{{namespace}}', $namespace, $stub);
        $stub = str_replace('{{functionToExec}}', $functionToExec, $stub);
        return str_replace('{{class}}', $className, $stub);
    }
}
