<?php

namespace App\Components\View;

trait EchoExpressionCompiler
{
    protected function compileEcho($fileContent)
    {
        preg_match_all('/{(?<name>[A-za-z0-9]+)}/', $fileContent, $matchSquare);

        foreach ($matchSquare[0] as $keySquare => $itemSquare)
        {
            $fileContent = preg_replace("/$itemSquare/", '<?php echo $'.$matchSquare['name'][$keySquare]. '; ?>', $fileContent);
        }
        return $fileContent;
    }
}
