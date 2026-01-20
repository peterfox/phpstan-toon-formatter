<?php

namespace PeterFox\PhpStanToonFormatter\Tests;

use HelgeSverre\Toon\Toon;
use PeterFox\PhpStanToonFormatter\ToonErrorFormatter;
use PHPStan\Analyser\Error;
use PHPStan\Command\AnalysisResult;
use PHPStan\Command\Output;
use PHPUnit\Framework\TestCase;

class ToonErrorFormatterTest extends TestCase
{
    public function testFormatErrors(): void
    {
        $fileSpecificError = new Error(
            'Error message',
            'file.php',
            10,
            true,
            null,
            null,
            'Tip message',
            null,
            null,
            'error.identifier'
        );

        $analysisResult = new AnalysisResult(
            [$fileSpecificError],
            ['Global error'],
            [],
            [],
            [],
            false,
            null,
            true,
            0,
            false,
            []
        );
        $output = $this->createMock(Output::class);

        $expectedData = [
            'totals' => [
                'errors' => 1,
                'file_errors' => 1,
            ],
            'files' => [
                'file.php' => [
                    'errors' => 1,
                    'messages' => [
                        [
                            'message' => 'Error message',
                            'line' => 10,
                            'ignorable' => true,
                            'tip' => 'Tip message',
                            'identifier' => 'error.identifier',
                        ],
                    ],
                ],
            ],
            'errors' => ['Global error'],
        ];

        $output->expects($this->once())
            ->method('writeRaw')
            ->with(Toon::encode($expectedData));

        $formatter = new ToonErrorFormatter();
        $exitCode = $formatter->formatErrors($analysisResult, $output);

        $this->assertSame(1, $exitCode);
    }

    public function testFormatErrorsWithNoErrors(): void
    {
        $analysisResult = new AnalysisResult(
            [],
            [],
            [],
            [],
            [],
            false,
            null,
            true,
            0,
            false,
            []
        );
        $output = $this->createMock(Output::class);

        $expectedData = [
            'totals' => [
                'errors' => 0,
                'file_errors' => 0,
            ],
            'files' => [],
            'errors' => [],
        ];

        $output->expects($this->once())
            ->method('writeRaw')
            ->with(Toon::encode($expectedData));

        $formatter = new ToonErrorFormatter();
        $exitCode = $formatter->formatErrors($analysisResult, $output);

        $this->assertSame(0, $exitCode);
    }
}
