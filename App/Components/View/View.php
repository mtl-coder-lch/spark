<?php

namespace App\Components\View;

class View
{
    private $file;
    private $compiler;

    public function __construct(Compiler $compiler)
    {
        $this->compiler = $compiler;
    }

    public function render($data)
    {
        if($this->file)
        {
            $fileContent = file_get_contents($this->file);

            $this->compiler
                ->setData($data)
                ->setFileContent($fileContent);

            ob_start();

            if(!file_exists('/var/www/app/Components/View/compiled/test.php'))
            {
                file_put_contents('/var/www/app/Components/View/compiled/test.php', $this->compiler->compileView());
            }
            include '/var/www/app/Components/View/compiled/test.php';
            $content = ob_get_contents();
            ob_end_clean();
            echo $content;
        }
        return false;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file): void
    {
        $this->file = $file;
    }
}
