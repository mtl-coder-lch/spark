<?php

namespace App\Components\View;

class Compiler
{
    use ForInExpressionCompiler;
    use EchoExpressionCompiler;

    private $fileContent;
    private $data;

    public function compileView()
    {
        $this->fileContent = $this->compileForIn($this->fileContent);
        $this->fileContent = $this->compileEcho($this->fileContent);
        return $this->fileContent;
    }

    /**
     * @param $fileContent
     * @return $this
     */
    public function setFileContent($fileContent)
    {
        $this->fileContent = $fileContent;
        return $this;
    }

    /**
     * @param $data
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }
}
