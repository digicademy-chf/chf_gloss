<?php
declare(strict_types=1);

# This file is part of the extension CHF Gloss for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFGloss\Domain\Model;

use Digicademy\CHFBase\Domain\Model\Traits\HiddenTrait;
use Digicademy\CHFBase\Domain\Model\Traits\ImportTrait;
use Digicademy\CHFBase\Domain\Model\Traits\ImportOriginTrait;
use Digicademy\CHFBase\Domain\Model\Traits\IriTrait;
use Digicademy\CHFBase\Domain\Model\Traits\ParentResourceTrait;
use Digicademy\CHFBase\Domain\Model\Traits\UuidTrait;
use Digicademy\CHFBase\Domain\Validator\StringOptionsValidator;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Model for GlossaryEntry
 */
class GlossaryEntry extends AbstractEntity
{
    use HiddenTrait;
    use ImportTrait;
    use ImportOriginTrait;
    use IriTrait;
    use ParentResourceTrait;
    use UuidTrait;

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
     * Construct object
     *
     * @param string $type
     * @param string $term
     * @param string $description
     * @return GlossaryEntry
     */
    public function __construct(string $type, string $term, string $description)
    {
        $this->initializeObject();

        $this->setType($type);
        $this->setTerm($term);
        $this->setDescription($description);
        $this->setIri('ge');
    }

    /**
     * Initialize object
     */
    public function initializeObject(): void
    {
        $this->parentResource = new ObjectStorage();
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
}
