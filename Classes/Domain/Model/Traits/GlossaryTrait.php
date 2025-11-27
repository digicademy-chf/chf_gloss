<?php
declare(strict_types=1);

# This file is part of the extension CHF Gloss for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFGloss\Domain\Model\Traits;

use Digicademy\CHFGloss\Domain\Model\GlossaryResource;
use TYPO3\CMS\Extbase\Attribute\ORM\Lazy;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;

defined('TYPO3') or die();

/**
 * Trait for models to include a glossary property
 */
trait GlossaryTrait
{
    /**
     * Glossary of this resource
     * 
     * @var GlossaryResource|LazyLoadingProxy|null
     */
    #[Lazy()]
    protected GlossaryResource|LazyLoadingProxy|null $glossary = null;

    /**
     * Get glossary
     * 
     * @return GlossaryResource
     */
    public function getGlossary(): GlossaryResource
    {
        if ($this->glossary instanceof LazyLoadingProxy) {
            $this->glossary->_loadRealInstance();
        }
        return $this->glossary;
    }

    /**
     * Set glossary
     * 
     * @param GlossaryResource
     */
    public function setGlossary(GlossaryResource $glossary): void
    {
        $this->glossary = $glossary;
    }
}
