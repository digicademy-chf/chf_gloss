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

// Add columns 'glossary', 'all_glossary_entries', and 'as_glossary_of_resource'
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
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_resource}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfbase_domain_model_resource}.{#type}=\'glossaryResource\'',
                'sortItems' => [
                    'label' => 'asc',
                ],
                'MM' => 'tx_chfbase_domain_model_resource_resource_glossary_mm',
                'multiple' => 1,
            ],
        ],
        'all_glossary_entries' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_gloss/Resources/Private/Language/locallang.xlf:object.glossaryResource.allGlossaryEntries',
            'description' => 'LLL:EXT:chf_gloss/Resources/Private/Language/locallang.xlf:object.glossaryResource.allGlossaryEntries.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfgloss_domain_model_glossary_entry',
                'foreign_field' => 'parent_resource',
                'foreign_sortby' => 'sorting',
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                    'newRecordLinkAddTitle' => true,
                    'levelLinksPosition' => 'bottom',
                    'useSortable' => false,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                ],
            ],
        ],
        'as_glossary_of_resource' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_gloss/Resources/Private/Language/locallang.xlf:object.glossaryResource.asGlossaryOfResource',
            'description' => 'LLL:EXT:chf_gloss/Resources/Private/Language/locallang.xlf:object.glossaryResource.asGlossaryOfResource.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_chfbase_domain_model_resource',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_resource}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfbase_domain_model_resource}.{#type}=\'bibliographicResource\''
                    . ' OR {#tx_chfbase_domain_model_resource}.{#type}=\'lexicographicResource\''
                    . ' OR {#tx_chfbase_domain_model_resource}.{#type}=\'publicationResource\''
                    . ' OR {#tx_chfbase_domain_model_resource}.{#type}=\'objectResource\'',
                'MM' => 'tx_chfbase_domain_model_resource_resource_glossary_mm',
                'MM_opposite_field' => 'glossary',
                'multiple' => 1,
                'size' => 5,
                'autoSizeMax' => 10,
            ],
        ],
    ]
);

// Add type 'glossaryResource' and its 'showitem' list
$GLOBALS['TCA']['tx_chfbase_domain_model_resource']['types'] += ['glossaryResource' => [
   'showitem' => 'type,--palette--;;titleLangCodeDescription,
   --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.structured,all_glossary_entries,all_agents,all_locations,all_periods,all_tags,all_keywords,all_relations,all_file_groups,
   --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.placement,--palette--;;iriUuidSameAs,
   --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.editorial,--palette--;;publicationDateRevisionDateRevisionNumberEditorialNote,--palette--;;authorshipRelationLicenceRelation,
   --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.import,--palette--;;importOriginImportState,
   --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.usage,as_glossary_of_resource,',
]];
