<?php

declare(strict_types=1);

# This file is part of the extension CHF Gloss for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFGloss\Domain\Repository;

use Digicademy\CHFGloss\Domain\Model\GlossaryEntry;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Repository for GlossaryEntry
 * 
 * @extends Repository<GlossaryEntry>
 */
class GlossaryEntryRepository extends Repository
{
    protected $defaultOrderings = [
        'sorting'          => QueryInterface::ORDER_ASCENDING,
        'itemTitle'        => QueryInterface::ORDER_ASCENDING,
        'publicationTitle' => QueryInterface::ORDER_ASCENDING,
        'seriesTitle'      => QueryInterface::ORDER_ASCENDING,
        'meetingTitle'     => QueryInterface::ORDER_ASCENDING,
    ];
}

?>
