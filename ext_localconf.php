<?php
declare(strict_types=1);

# This file is part of the extension CHF Gloss for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


use Digicademy\CHFGloss\Controller\GlossaryController;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') or die();

// Register 'Glossary' content element
ExtensionUtility::configurePlugin(
    'CHFGloss',
    'Glossary',
    [
        GlossaryController::class => 'index, show',
    ],
    [], // None of the actions are non-cacheable
);
