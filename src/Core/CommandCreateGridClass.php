<?php

namespace SrkGrid\GridView\Core;


trait CommandCreateGridClass
{
    /**
     * class name
     *
     * @var string
     */
    protected $className;

    /**
     * @var array
     */
    protected $arrayDirectory;

    /**
     * @var string
     */
    protected $getFullDirectory;

    /**
     * @var string
     */
    protected $startPath = 'app/Grid/';
    /**
     * @var string
     */
    protected $getDirectory;

    /**
     * start create class grid
     */
    public function createGrid()
    {
        $this->structureDirectory();
    }

    /**
     * create structure directory grid
     */
    protected function structureDirectory()
    {
        $this->arrayDirectory = (explode('/', $this->argument('name')));

        $countStructure = count($this->arrayDirectory);

        $this->setClassName($countStructure);

        $this->makeDirectory();

        $this->makeFile();
    }

    /**
     *
     * @param $countStructure
     */
    protected function setClassName($countStructure)
    {
        $this->className = $this->arrayDirectory[$countStructure - 1];

        unset($this->arrayDirectory[$countStructure - 1]);
    }

    /**
     * create directory grid
     */
    protected function makeDirectory()
    {
        $this->getDirectory = implode('/', $this->arrayDirectory);

        $this->getFullDirectory = base_path($this->startPath) . $this->getDirectory . '/';

        if (!is_dir($this->getFullDirectory))
            mkdir($this->getFullDirectory, 0777, true);

    }

    /**
     * make class grid
     */
    protected function makeFile()
    {
        $file = $this->getFullDirectory . $this->className . '.php';

        if (!file_exists($file)) {

            $class = fopen($file, "w");

            fwrite($class, "<?php\n\n" . $this->contentClass());

            fclose($class);

            $this->info('this grid created on ' . $this->startPath.$this->getDirectory.'/'.$this->className.'.php');

        } else {
            $this->error('this file already created');
        }

    }

    /**
     * fill content class
     *
     * @return string
     */
    protected function contentClass()
    {
        $namespace = 'namespace App\GridView\\' . str_replace('/', '\\', $this->getDirectory) . ";\n\n";

        $use = "use App\Library\GridView\GridView;\nuse App\Library\GridView\BaseGrid;\n\n";

        $className = 'class ' . $this->className . ' implements BaseGrid' . "\n";

        $start = "{";

        $methodRender = $this->makeMethodRender();

        $end = '}';

        return $namespace . $use . $className . $start . $methodRender . $end;
    }

    /**
     * render method
     *
     * @return string
     */
    protected function makeMethodRender()
    {
        return '
     /**
     * Render method for get html view result
     *
     * @param GridView $grid
     * @param $data
     * @param $localization
     * @return mixed
     */
    public function render($grid, $data, $localization = null)
    {
        return $grid;
    }
         ' . "\n";
    }
}
