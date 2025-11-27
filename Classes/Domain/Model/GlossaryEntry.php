<?php
declare(strict_types=1);

# This file is part of the extension CHF Gloss for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFGloss\Domain\Model;

use Digicademy\CHFBase\Domain\Model\AbstractBase;
use Digicademy\CHFBase\Domain\Model\Traits\ImportTrait;
use Digicademy\CHFBase\Domain\Model\Traits\LabelTrait;
use Digicademy\CHFBase\Domain\Model\Traits\LinkRelationTrait;
use Digicademy\CHFBase\Domain\Model\Traits\ParentResourceTrait;
use Digicademy\CHFBase\Domain\Validator\StringOptionsValidator;
use Digicademy\CHFBib\Domain\Model\Traits\SourceRelationTrait;
use Digicademy\CHFPub\Domain\Model\Traits\PublicationRelationTrait;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Attribute\Validate;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

defined('TYPO3') or die();

/**
 * Model for AbstractGlossaryEntry
 */
class AbstractGlossaryEntry extends AbstractBase
{
    use ImportTrait;
    use LabelTrait;
    use LinkRelationTrait;
    use ParentResourceTrait;

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
        parent::__construct();
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
        $this->label = new ObjectStorage();
        $this->linkRelation = new ObjectStorage();
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

# If CHF Bib and CHF Pub are available
if (ExtensionManagementUtility::isLoaded('chf_bib') && ExtensionManagementUtility::isLoaded('chf_pub')) {

    /**
     * Model for GlossaryEntry (with source-relation and publication-relation properties)
     */
    class GlossaryEntry extends AbstractGlossaryEntry
    {
        use PublicationRelationTrait;
        use SourceRelationTrait;

        /**
         * Initialize object
         */
        public function initializeObject(): void
        {
            $this->label = new ObjectStorage();
            $this->sourceRelation = new ObjectStorage();
            $this->linkRelation = new ObjectStorage();
            $this->publicationRelation = new ObjectStorage();
            $this->parentResource = new ObjectStorage();
        }
    }

# If only CHF Bib is available
} elseif (ExtensionManagementUtility::isLoaded('chf_bib')) {

    /**
     * Model for GlossaryEntry (with source-relation property)
     */
    class GlossaryEntry extends AbstractGlossaryEntry
    {
        use SourceRelationTrait;

        /**
         * Initialize object
         */
        public function initializeObject(): void
        {
            $this->label = new ObjectStorage();
            $this->sourceRelation = new ObjectStorage();
            $this->linkRelation = new ObjectStorage();
            $this->parentResource = new ObjectStorage();
        }
    }

# If only CHF Pub is available
} elseif (ExtensionManagementUtility::isLoaded('chf_pub')) {

    /**
     * Model for GlossaryEntry (with publication-relation property)
     */
    class GlossaryEntry extends AbstractGlossaryEntry
    {
        use PublicationRelationTrait;

        /**
         * Initialize object
         */
        public function initializeObject(): void
        {
            $this->label = new ObjectStorage();
            $this->linkRelation = new ObjectStorage();
            $this->publicationRelation = new ObjectStorage();
            $this->parentResource = new ObjectStorage();
        }
    }

# If no relevant extensions are available
} else {

    /**
     * Model for GlossaryEntry
     */
    class GlossaryEntry extends AbstractGlossaryEntry
    {}
}
