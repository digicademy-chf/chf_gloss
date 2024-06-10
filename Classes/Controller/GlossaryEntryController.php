<?php
declare(strict_types=1);

# This file is part of the extension CHF Gloss for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFGloss\Controller;

use Psr\Http\Message\ResponseInterface;
use Digicademy\CHFGloss\Domain\Model\GlossaryEntry;
use Digicademy\CHFGloss\Domain\Repository\GlossaryEntryRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

defined('TYPO3') or die();

/**
 * Controller for GlossaryEntry
 */
class GlossaryEntryController extends ActionController
{
    private GlossaryEntryRepository $glossaryEntryRepository;

    public function injectGlossaryEntryRepository(GlossaryEntryRepository $glossaryEntryRepository): void
    {
        $this->glossaryEntryRepository = $glossaryEntryRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('glossaryEntries', $this->glossaryEntryRepository->findAll());
        return $this->htmlResponse();
    }

    public function showAction(GlossaryEntry $glossaryEntry): ResponseInterface
    {
        $this->view->assign('glossaryEntry', $glossaryEntry);
        return $this->htmlResponse();
    }
}
