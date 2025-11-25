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

        // DEBUG
        #$this->view->assign('resource', $resource);
        //$glossaryEntries = $resource->getItems()->toArray();
        //$this->view->assign('glossaryEntries', $glossaryEntries);
        // CHECK HIDDEN STATE, TURN INTO PARTIAL AND ALSO USE IN PLUGIN TEMPLATE
        // MERGE authorshipRelation OF RESOURCE WITH RECORD

        // Compile relevant data
        if(!$resource->getHidden() && $resource->getType() == 'glossaryResource') {
            $this->view->assignMultiple([
                'uid' => $resource->getUid(),
                'title' => $resource->getTitle(),
                'langCode' => $resource->getLangCode(),
                'description' => $resource->getDescription(),
                'items' => $resource->getItems(), # TODO, some issue, unprotect, group by entry types
                'iri' => $resource->getIri(),
                'uuid' => $resource->getUuid(),
                'sameAs' => $resource->getSameAs(), # TODO, unprotect
                'publicationDate' => $resource->getPublicationDate(),
                'revisionDate' => $resource->getRevisionDate(),
                'revisionNumber' => $resource->getRevisionNumber(),
                #'authorshipRelation' => $resource->getAuthorshipRelation(), # TODO, SQL-Fehler, unprotect
                #'licenceRelation' => $resource->getLicenceRelation(), # TODO, SQL-Fehler, unprotect
            ]);
        }

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
