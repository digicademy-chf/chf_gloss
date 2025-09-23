<?php
declare(strict_types=1);

# This file is part of the extension CHF Gloss for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


defined('TYPO3') or die();

/**
 * AbstractResource and its properties
 * 
 * Extension of a database table and its editing interface in the
 * TYPO3 backend. This also serves as the basis for the Extbase
 * domain model. For more information on TCA and its options see
 * https://docs.typo3.org/m/typo3/reference-tca/main/en-us/.
 */

// Add select item 'glossaryResource'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem('tx_chfbase_domain_model_resource', 'type',
    [
        'label' => 'LLL:EXT:chf_gloss/Resources/Private/Language/locallang.xlf:object.glossaryResource.type.glossaryResource',
        'value' => 'glossaryResource',
    ]
);

// Add column 'glossary'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_chfbase_domain_model_resource',
    [
        'glossary' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_gloss/Resources/Private/Language/locallang.xlf:object.abstractResource.glossary',
            'description' => 'LLL:EXT:chf_gloss/Resources/Private/Language/locallang.xlf:object.abstractResource.glossary.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => '',
                        'value' => 0,
                    ],
                ],
                'foreign_table' => 'tx_chfbase_domain_model_resource',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_resource}.{#sys_language_uid} IN (-1, 0)'
                    . ' AND {#tx_chfbase_domain_model_resource}.{#type}=\'glossaryResource\'',
                'sortItems' => [
                    'label' => 'asc',
                ],
            ],
        ],
    ]
);

// Add type 'glossaryResource' and its 'showitem' list
$GLOBALS['TCA']['tx_chfbase_domain_model_resource']['types'] += ['glossaryResource' => [
   'showitem' => 'type,--palette--;;titleLangCode,description,
   --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.structured,items,
   --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.management,--palette--;;iriUuid,same_as,
   --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.editorial,--palette--;;publicationDateRevisionDateRevisionNumber,editorial_note,authorship_relation,licence_relation,
   --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.import,import_origin,import_state,',
]];

// Add opposite usage info to 'items' column
$GLOBALS['TCA']['tx_chfbase_domain_model_resource']['columns']['items']['config']['allowed'] .= ',tx_chfgloss_domain_model_glossaryentry';
$GLOBALS['TCA']['tx_chfbase_domain_model_resource']['columns']['items']['config']['MM_oppositeUsage']['tx_chfgloss_domain_model_glossaryentry'] = ['parent_resource'];
