<?php
declare(strict_types=1);

# This file is part of the extension CHF Gloss for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFGloss\Domain\Model;

use Digicademy\CHFBase\Domain\Model\Traits\IriTrait;
use Digicademy\CHFBase\Domain\Model\Traits\UuidTrait;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use Digicademy\CHFBase\Domain\Validator\StringOptionsValidator;

defined('TYPO3') or die();

/**
 * Model for GlossaryEntry
 */
class GlossaryEntry extends AbstractEntity
{
    use IriTrait;
    use UuidTrait;

    /**
     * Record visible or not
     * 
     * @var bool
     */
    #[Validate([
        'validator' => 'Boolean',
    ])]
    protected bool $hidden = true;

    /**
     * Specific type of glossary entry
     * 
     * @var string
     */
    #[Validate([
        'validator' => StringOptionsValidator::class,
        'options'   => [
            'allowed' => [
                'regular',
                'abbreviation',
            ],
        ],
    ])]
    protected string $type = 'regular';

    /**
     * Term to be defined
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options' => [
            'maximum' => 255,
        ],
    ])]
    protected string $term = '';

    /**
     * Comma-separated list of variant forms to annotate
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options' => [
            'maximum' => 255,
        ],
    ])]
    protected string $additionalStrings = '';

    /**
     * Brief explanation of the term in question
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'String',
    ])]
    protected string $description = '';

    /**
     * Resource that this database record is part of
     * 
     * @var ?ObjectStorage<GlossaryResource>
     */
    #[Lazy()]
    protected ?ObjectStorage $parentResource = null;

    /**
     * URI or other identifier of the imported original
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 255,
        ],
    ])]
    protected string $importOrigin = '';

    /**
     * Full import code that this record is based on
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'maximum' => 100000,
        ],
    ])]
    protected string $import = '';

    /**
     * Construct object
     *
     * @param string $type
     * @param string $term
     * @param string $description
     * @param GlossaryResource $parentResource
     * @param string $iri
     * @param string $uuid
     * @return GlossaryEntry
     */
    public function __construct(string $type, string $term, string $description, GlossaryResource $parentResource, string $iri, string $uuid)
    {
        $this->initializeObject();

        $this->setType($type);
        $this->setTerm($term);
        $this->setDescription($description);
        $this->addParentResource($parentResource);
        $this->setIri($iri);
        $this->setUuid($uuid);
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->parentResource ??= new ObjectStorage();
    }

    /**
     * Get hidden
     *
     * @return bool
     */
    public function getHidden(): bool
    {
        return $this->hidden;
    }

    /**
     * Set hidden
     *
     * @param bool $hidden
     */
    public function setHidden(bool $hidden): void
    {
        $this->hidden = $hidden;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Set type
     *
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * Get term
     *
     * @return string
     */
    public function getTerm(): string
    {
        return $this->term;
    }

    /**
     * Set term
     *
     * @param string $term
     */
    public function setTerm(string $term): void
    {
        $this->term = $term;
    }

    /**
     * Get additional strings
     *
     * @return string
     */
    public function getAdditionalStrings(): string
    {
        return $this->additionalStrings;
    }

    /**
     * Set additional strings
     *
     * @param string $additionalStrings
     */
    public function setAdditionalStrings(string $additionalStrings): void
    {
        $this->additionalStrings = $additionalStrings;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * Get parent resource
     *
     * @return ObjectStorage<GlossaryResource>
     */
    public function getParentResource(): ?ObjectStorage
    {
        return $this->parentResource;
    }

    /**
     * Set parent resource
     *
     * @param ObjectStorage<GlossaryResource> $parentResource
     */
    public function setParentResource(ObjectStorage $parentResource): void
    {
        $this->parentResource = $parentResource;
    }

    /**
     * Add parent resource
     *
     * @param GlossaryResource $parentResource
     */
    public function addParentResource(GlossaryResource $parentResource): void
    {
        $this->parentResource?->attach($parentResource);
    }

    /**
     * Remove parent resource
     *
     * @param GlossaryResource $parentResource
     */
    public function removeParentResource(GlossaryResource $parentResource): void
    {
        $this->parentResource?->detach($parentResource);
    }

    /**
     * Remove all parent resources
     */
    public function removeAllParentResource(): void
    {
        $parentResource = clone $this->parentResource;
        $this->parentResource->removeAll($parentResource);
    }

    /**
     * Get import origin
     *
     * @return string
     */
    public function getImportOrigin(): string
    {
        return $this->importOrigin;
    }

    /**
     * Set import origin
     *
     * @param string $importOrigin
     */
    public function setImportOrigin(string $importOrigin): void
    {
        $this->importOrigin = $importOrigin;
    }

    /**
     * Get import
     *
     * @return string
     */
    public function getImport(): string
    {
        return $this->import;
    }

    /**
     * Set import
     *
     * @param string $import
     */
    public function setImport(string $import): void
    {
        $this->import = $import;
    }
}
