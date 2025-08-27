<?php
declare(strict_types=1);

# This file is part of the extension CHF Gloss for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFGloss\Domain\Model;

use Digicademy\CHFBase\Domain\Model\AbstractResource;

defined('TYPO3') or die();

/**
 * Model for GlossaryResource
 */
class GlossaryResource extends AbstractResource
{
    /**
     * Construct object
     *
     * @param string $langCode
     * @return GlossaryResource
     */
    public function __construct(string $langCode)
    {
        parent::__construct($langCode);

        $this->setType('glossaryResource');
    }
}
