<?php

namespace PeterFox\PhpStanToonFormatter;

use HelgeSverre\Toon\Toon;
use PHPStan\Command\AnalysisResult;
use PHPStan\Command\ErrorFormatter\ErrorFormatter;
use PHPStan\Command\Output;

class ToonErrorFormatter implements ErrorFormatter
{
    public function formatErrors(AnalysisResult $analysisResult, Output $output): int
    {
        if (!$analysisResult->hasErrors()) {
            $output->writeRaw('ok');

            return 0;
        }

        $errorsArray = [
            'totals' => [
                'errors' => count($analysisResult->getNotFileSpecificErrors()),
                'file_errors' => count($analysisResult->getFileSpecificErrors()),
            ],
            'files' => [],
            'errors' => [],
        ];

        foreach ($analysisResult->getFileSpecificErrors() as $fileSpecificError) {
            $file = $fileSpecificError->getFile();
            if (! isset($errorsArray['files'][$file])) {
                $errorsArray['files'][$file] = [
                    'errors' => 0,
                    'messages' => [],
                ];
            }
            $errorsArray['files'][$file]['errors']++;

            $message = [
                'message' => $fileSpecificError->getMessage(),
                'line' => $fileSpecificError->getLine(),
                'ignorable' => $fileSpecificError->canBeIgnored(),
            ];

            if ($fileSpecificError->getTip() !== null) {
                $message['tip'] = $fileSpecificError->getTip();
            }

            if ($fileSpecificError->getIdentifier() !== null) {
                $message['identifier'] = $fileSpecificError->getIdentifier();
            }

            $errorsArray['files'][$file]['messages'][] = $message;
        }

        foreach ($analysisResult->getNotFileSpecificErrors() as $notFileSpecificError) {
            $errorsArray['errors'][] = $notFileSpecificError;
        }

        $output->writeRaw(Toon::encode($errorsArray));

        return $analysisResult->hasErrors() ? 1 : 0;
    }
}
