<?php

declare(strict_types=1);

namespace DaveLiddament\StaticAnalysisResultsBaseliner\Tests\Unit\Plugins\OutputFormatters;

use DaveLiddament\StaticAnalysisResultsBaseliner\Domain\OutputFormatter\OutputFormatter;
use DaveLiddament\StaticAnalysisResultsBaseliner\Plugins\OutputFormatters\TableOutputFormatter;

class TableOutputFormatterTest extends AbstractOutputFormatterTest
{
    public function testName(): void
    {
        $this->assertName('table');
    }

    public function testNoIssues(): void
    {
        $expectedOutput = <<<EOF
Latest issue count: 2
Baseline issue count: 4
Issues count with baseline removed: 0
EOF;

        $this->assertNoIssuesOutput($expectedOutput);
    }

    public function testWithIssues(): void
    {
        $expectedOuput = <<<EOF
Latest issue count: 2
Baseline issue count: 4
Issues count with baseline removed: 3

FILE: FILE_1
+------+-------------+
| Line | Description |
+------+-------------+
| 10   | MESSAGE_1   |
| 12   | MESSAGE_2   |
+------+-------------+

FILE: FILE_2
+------+-------------+
| Line | Description |
+------+-------------+
| 0    | MESSAGE_3   |
+------+-------------+

EOF;

        $this->assertIssuesOutput($expectedOuput);
    }

    protected function getOutputFormatter(): OutputFormatter
    {
        return new TableOutputFormatter();
    }
}
