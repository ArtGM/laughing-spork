<?php

declare(strict_types=1);

use Rector\Set\ValueObject\SetList;
use Rector\Symfony\Set\SymfonySetList;

use Rector\Config\RectorConfig;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->symfonyContainerXml(__DIR__ . '/var/cache/dev/App_KernelDevDebugContainer.xml');

    $rectorConfig->sets([
        SetList::CODE_QUALITY,
        SetList::CODING_STYLE,
        SetList::PHP_81,
        SymfonySetList::SYMFONY_54,
        SymfonySetList::SYMFONY_CODE_QUALITY,
        SymfonySetList::SYMFONY_CONSTRUCTOR_INJECTION,
        SymfonySetList::ANNOTATIONS_TO_ATTRIBUTES
    ]);

};
