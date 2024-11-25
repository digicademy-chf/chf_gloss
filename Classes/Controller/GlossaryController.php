<?php
declare(strict_types=1);

# This file is part of the extension CHF Gloss for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\CHFGloss\Controller;

use Digicademy\CHFBase\Domain\Repository\AbstractResourceRepository;
use Digicademy\CHFGloss\Domain\Model\GlossaryEntry;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

defined('TYPO3') or die();

/**
 * Controller for Glossary
 */
class GlossaryController extends ActionController
{
    private AbstractResourceRepository $abstractResourceRepository;

    public function injectAbstractResourceRepository(AbstractResourceRepository $abstractResourceRepository): void
    {
        $this->abstractResourceRepository = $abstractResourceRepository;
    }

    public function indexAction(): ResponseInterface
    {
        $this->view->assign('resource', $this->abstractResourceRepository->findOneBy(['type' => 'glossaryResource']));
        return $this->htmlResponse();
    }

    public function showAction(GlossaryEntry $glossaryEntry): ResponseInterface
    {
        $this->view->assign('glossaryEntry', $glossaryEntry);
        return $this->htmlResponse();
    }
}
