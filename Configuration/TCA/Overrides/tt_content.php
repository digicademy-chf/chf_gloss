<?php
declare(strict_types=1);

# This file is part of the extension CHF Gloss for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') or die();

/**
 * ContentElement and its properties
 * 
 * Extension of a database table and its editing interface in the
 * TYPO3 backend. This also serves as the basis for the Extbase
 * domain model. For more information on TCA and its options see
 * https://docs.typo3.org/m/typo3/reference-tca/main/en-us/.
 */

// Add plugin 'Glossary'
ExtensionUtility::registerPlugin(
    'CHFGloss',
    'Glossary',
    'LLL:EXT:chf_gloss/Resources/Private/Language/locallang.xlf:plugin.glossary',
    'tx-chfgloss-plugin-glossary',
    'heritage',
    'LLL:EXT:chf_gloss/Resources/Private/Language/locallang.xlf:plugin.glossary.description',
    'FILE:EXT:chf_gloss/Configuration/FlexForms/PluginData.xml',
);

// Add data tab to plugin form
ExtensionManagementUtility::addToAllTCAtypes(
    'tt_content',
    '--div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:plugin.generic.data,pi_flexform',
    'chfgloss_glossary',
    'after:subheader',
);
