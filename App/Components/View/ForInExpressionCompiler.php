<?php

namespace App\Components\View;

trait ForInExpressionCompiler
{
    private $startPositions;
    private $endPositions;
    private $data;
    private $fileContent;

    protected function compileForIn($fileContent)
    {
        preg_match_all('/\%\s+for\s+(?<param>[\w\d]+)\s+in\s(?<param2>[\w\d.]+)\s+\%/', $fileContent, $matchesFor);
        preg_match_all('/\%\s+endfor\s+\%/', $fileContent, $matchesEndFor);

        foreach ($matchesFor[0] as $key => $item)
        {
            $p1 = $matchesFor['param'][$key];
            $p2 = $this->dotToArrayParameters($matchesFor['param2'][$key]);

            $fileContent = preg_replace("/$item/", "<?php foreach ($$p2 as $$p1) : ?>", $fileContent);
        }

        foreach ($matchesEndFor[0] as $keyEnd => $itemEnd)
        {
            $fileContent = preg_replace("/$itemEnd/", "<?php endforeach; ?>", $fileContent);
        }
        return $fileContent;
    }

    private function dotToArrayParameters($param)
    {
        $splits = explode('.', $param);
        if(count($splits) === 0)
        {
            return $param;
        }
        else
        {
            $param = '';
            foreach ($splits as $key => $part)
            {
                if($key === 0)
                {
                    $param = $part;
                }
                else
                {
                    $param.= "['$part']";
                }
            }
            return $param;
        }
    }
}
