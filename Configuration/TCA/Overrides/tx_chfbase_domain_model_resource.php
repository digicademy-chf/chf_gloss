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

// Add columns 'glossary', 'allGlossaryEntries', and 'asGlossaryOfResource'
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_chfbase_domain_model_resource',
    [
        'glossary' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.abstractResource.glossary',
            'description' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.abstractResource.glossary.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_chfbase_domain_model_resource',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_resource}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfbase_domain_model_resource}.{#type}=\'glossaryResource\'',
                'sortItems' => [
                    'label' => 'asc',
                ],
            ],
        ],
        'allGlossaryEntries' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_gloss/Resources/Private/Language/locallang.xlf:object.glossaryResource.allGlossaryEntries',
            'description' => 'LLL:EXT:chf_gloss/Resources/Private/Language/locallang.xlf:object.glossaryResource.allGlossaryEntries.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_chfgloss_domain_model_glossary_entry',
                'foreign_field' => 'parentResource',
                'foreign_sortby' => 'sorting',
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                    'newRecordLinkAddTitle' => true,
                    'levelLinksPosition' => 'top',
                    'useSortable' => false,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                ],
            ],
        ],
        'asGlossaryOfResource' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.glossaryResource.asGlossaryOfResource',
            'description' => 'LLL:EXT:chf_map/Resources/Private/Language/locallang.xlf:object.glossaryResource.asGlossaryOfResource.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_chfobject_domain_model_resource',
                'foreign_table_where' => 'AND {#tx_chfbase_domain_model_resource}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_chfbase_domain_model_resource}.{#type}=\'bibliographicResource\''
                    . ' OR {#tx_chfbase_domain_model_resource}.{#type}=\'lexicographicResource\''
                    . ' OR {#tx_chfbase_domain_model_resource}.{#type}=\'publicationResource\''
                    . ' OR {#tx_chfbase_domain_model_resource}.{#type}=\'objectResource\'',
                'MM' => 'tx_chfbase_domain_model_resource_resource_glossary_mm',
                'MM_opposite_field' => 'glossary',
                'size' => 5,
                'autoSizeMax' => 10,
                'fieldControl' => [
                    'editPopup' => [
                        'disabled' => false,
                    ],
                    'addRecord' => [
                        'disabled' => false,
                    ],
                    'listModule' => [
                        'disabled' => false,
                    ],
                ],
                'readOnly' => true,
            ],
        ],
    ]
);

// Add type 'glossaryResource' and its 'showitem' list
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
   'tx_chfbase_domain_model_resource',
   'hiddenUuid,typeUri,titleLangCode,description,sameAs,
   --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.editorial,authorshipRelation,licenceRelation,publicationDateRevisionNumberRevisionDate,editorialNote,
   --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.content,allAgents,allFileGroups,allLocations,allPeriods,allRelations,allTags,allGlossaryEntries,
   --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.import,importOrigin,importState,
   --div--;LLL:EXT:chf_base/Resources/Private/Language/locallang.xlf:object.generic.usage,asGlossaryOfResource',
   'glossaryResource'
);
