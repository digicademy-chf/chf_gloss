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
use TYPO3\CMS\Extbase\Persistence\Generic\LazyObjectStorage;

defined('TYPO3') or die();

/**
 * Controller for Glossary
 */
class GlossaryController extends ActionController
{
    /**
     * Constructor takes care of dependency injection
     */
    public function __construct(
        protected readonly AbstractResourceRepository $abstractResourceRepository,
    ) {}

    /**
     * Show glossary entry list
     *
     * @return ResponseInterface
     */
    public function indexAction(): ResponseInterface
    {
        // Get resource
        $resourceIdentifier = $this->settings['resource'];
        $resource = $this->abstractResourceRepository->findByIdentifier($resourceIdentifier);
        $glossaryEntries = $resource->getItems()->toArray();
        $this->view->assign('glossaryEntries', $glossaryEntries);

        // Create response
        return $this->htmlResponse();
    }

    /**
     * Show single glossary entry
     *
     * @param GlossaryEntry $glossaryEntry
     * @return ResponseInterface
     */
    public function showAction(GlossaryEntry $glossaryEntry): ResponseInterface
    {
        // Get glossary entry
        $this->view->assign('glossaryEntry', $glossaryEntry);

        // Create response
        return $this->htmlResponse();
    }
}
