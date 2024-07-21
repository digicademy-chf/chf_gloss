<?php
declare(strict_types=1);

# This file is part of the extension CHF Gloss for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


use TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider;
use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;

defined('TYPO3') or die();

// Extension-provided icons
return [
    'tx-chfgloss' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:chf_gloss/Resources/Public/Icons/Extension.svg',
    ],
    'tx-chfgloss-table-glossary-entry' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:chf_gloss/Resources/Public/Icons/TableGlossaryEntry.svg',
    ],
    'tx-chfgloss-plugin-gloss-glossary' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:chf_gloss/Resources/Public/Icons/PluginGlossGlossary.svg',
    ],
];
