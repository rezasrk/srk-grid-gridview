<?php

namespace SrkGrid\GridView\Core;


use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

class CommandCreateGridClass extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:grid {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new GridView';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'GridView';

    /**
     * The name of class being generated.
     *
     * @var string
     */
    private $gridViewClass;

    /**
     * The name of class being generated.
     *
     * @var string
     */
    private $model;

    /**
     * Execute the console command.
     *
     * @return bool|null
     */
    public function fire()
    {

        $this->setGridViewClass();

        $path = $this->getPath($this->gridViewClass);

        if ($this->alreadyExists($this->getNameInput())) {
            $this->error($this->type . ' already exists!');

            return false;
        }

        $this->makeDirectory($path);

        $this->files->put($path, $this->buildClass($this->gridViewClass));

        $this->info($this->type . ' created successfully.');

        $this->line("<info>Created Repository :</info> $this->gridViewClass");
    }

    /**
     * Set setGridViewClass class name
     *
     * @return  void
     */
    private function setGridViewClass()
    {
        $name = ucwords(strtolower($this->argument('name')));

        $this->model = $name;

        $gridViewClass = $this->parseName($name);

        $this->gridViewClass =   $gridViewClass . 'GridView';

        return $this;
    }

    /**
     * Replace the class name for the given stub.
     *
     * @param  string $stub
     * @param  string $name
     * @return string
     */
    protected function replaceClass($stub, $name)
    {
        $stub = parent::replaceClass($stub, $name);

        $nameArray = explode('/',$this->argument('name'));

        $className = $nameArray[count($nameArray) -1];

        return str_replace('DummyGrid', $className, $stub);
    }

    /**
     *
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return base_path('/vendor/srk-grid/gridview/stub/gridview.stub');
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Grid';
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the gird class.'],
        ];
    }
}
