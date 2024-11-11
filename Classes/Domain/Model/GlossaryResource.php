<?php
declare(strict_types=1);

# This file is part of the extension CHF Gloss for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFGloss\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use Digicademy\CHFBase\Domain\Model\AbstractResource;

defined('TYPO3') or die();

/**
 * Model for GlossaryResource
 */
class GlossaryResource extends AbstractResource
{
    /**
     * List of all glossary entries compiled in this resource
     * 
     * @var ?ObjectStorage<GlossaryEntry>
     */
    #[Lazy()]
    #[Cascade([
        'value' => 'remove',
    ])]
    protected ?ObjectStorage $allGlossaryEntries = null;

    /**
     * List of resources that use this resource as a glossary
     * 
     * @var ?ObjectStorage<object>
     */
    #[Lazy()]
    protected ?ObjectStorage $asGlossaryOfResource;

    /**
     * Construct object
     *
     * @param string $langCode
     * @param string $uuid
     * @return GlossaryResource
     */
    public function __construct(string $langCode, string $uuid)
    {
        parent::__construct($langCode, $uuid);
        $this->initializeObject();

        $this->setType('glossaryResource');
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->allGlossaryEntries ??= new ObjectStorage();
        $this->asGlossaryOfResource ??= new ObjectStorage();
    }

    /**
     * Get all glossary entries
     *
     * @return ObjectStorage<GlossaryEntry>
     */
    public function getAllGlossaryEntries(): ?ObjectStorage
    {
        return $this->allGlossaryEntries;
    }

    /**
     * Set all glossary entries
     *
     * @param ObjectStorage<GlossaryEntry> $allGlossaryEntries
     */
    public function setAllGlossaryEntries(ObjectStorage $allGlossaryEntries): void
    {
        $this->allGlossaryEntries = $allGlossaryEntries;
    }

    /**
     * Add all glossary entries
     *
     * @param GlossaryEntry $allGlossaryEntries
     */
    public function addAllGlossaryEntries(GlossaryEntry $allGlossaryEntries): void
    {
        $this->allGlossaryEntries?->attach($allGlossaryEntries);
    }

    /**
     * Remove all glossary entries
     *
     * @param GlossaryEntry $allGlossaryEntries
     */
    public function removeAllGlossaryEntries(GlossaryEntry $allGlossaryEntries): void
    {
        $this->allGlossaryEntries?->detach($allGlossaryEntries);
    }

    /**
     * Remove all all glossary entries
     */
    public function removeAllAllGlossaryEntries(): void
    {
        $allGlossaryEntries = clone $this->allGlossaryEntries;
        $this->allGlossaryEntries->removeAll($allGlossaryEntries);
    }

    /**
     * Get as glossary of resource
     *
     * @return ObjectStorage<object>
     */
    public function getAsGlossaryOfResource(): ?ObjectStorage
    {
        return $this->asGlossaryOfResource;
    }

    /**
     * Set as glossary of resource
     *
     * @param ObjectStorage<object> $asGlossaryOfResource
     */
    public function setAsGlossaryOfResource(ObjectStorage $asGlossaryOfResource): void
    {
        $this->asGlossaryOfResource = $asGlossaryOfResource;
    }

    /**
     * Add as glossary of resource
     *
     * @param object $asGlossaryOfResource
     */
    public function addAsGlossaryOfResource(object $asGlossaryOfResource): void
    {
        $this->asGlossaryOfResource?->attach($asGlossaryOfResource);
    }

    /**
     * Remove as glossary of resource
     *
     * @param object $asGlossaryOfResource
     */
    public function removeAsGlossaryOfResource(object $asGlossaryOfResource): void
    {
        $this->asGlossaryOfResource?->detach($asGlossaryOfResource);
    }

    /**
     * Remove all as glossary of resources
     */
    public function removeAllAsGlossaryOfResource(): void
    {
        $asGlossaryOfResource = clone $this->asGlossaryOfResource;
        $this->asGlossaryOfResource->removeAll($asGlossaryOfResource);
    }
}
