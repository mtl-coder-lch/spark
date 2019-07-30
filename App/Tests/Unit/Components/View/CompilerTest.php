<?php

namespace App\Tests\Unit\Components\View;

use App\Components\View\Compiler;
use PHPUnit\Framework\TestCase;

class CompilerTest extends TestCase
{
    private $compiler;

    public function setUp()
    {
        $this->compiler = new Compiler();
    }

    public function testViewIsCompiledWithPhpNativeCode()
    {
        $htmlContent = '<html>
                            <head>
                                <body>
                                    <div style="background-color: mediumseagreen; width: 300px; height: 300px;">
                                        % for param in data %
                                          <p>{param}</p>
                                          % for new in param.data %
                                            <p>{new}</p>
                                          % endfor %
                                        % endfor %
                                    </div>
                                </body>
                            </head>
                    </html>';

        $this->compiler->setData(['any', 'one', 'data' => ['test']]);
        $this->compiler->setFileContent($htmlContent);
        $viewContent = $this->compiler->compileView();

        preg_match_all('/<\?php foreach/', $viewContent, $matchesFor);
        preg_match_all('/<\?php echo/', $viewContent, $matchesEcho);

        $this->assertEquals(2, count($matchesFor[0]));
        $this->assertEquals(2, count($matchesEcho[0]));
    }
}
