<?php

namespace App\Controller;

use App\Service\ServiceEndpointResolver;
use FOS\RestBundle\Controller\Annotations\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

class RelationController extends BaseController
{
    /**
     * @var ServiceEndpointResolver
     */
    private $serviceEndpointResolver;

    public function __construct(ServiceEndpointResolver $serviceEndpointResolver)
    {
        $this->serviceEndpointResolver = $serviceEndpointResolver;
    }

    /**
     * @Route("/relation/football-match/{eventId}", name="comment_add",  methods={"POST"})
     *
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function addAction(Request $request)
    {
        $response = $this->serviceEndpointResolver->callUsingRequestObject($request);

        $this->validateResponse($response);

        return $this->viewResponseContent($response);
    }

    /**
     * @Route("/relation/{commentId}", name="comment_edit",  methods={"PATCH"})
     *
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function editAction(Request $request)
    {
        $response = $this->serviceEndpointResolver->callUsingRequestObject($request);

        $this->validateResponse($response);

        return $this->viewResponseContent($response);
    }

    /**
     * @Route("/relation/{commentId}", name="comment_delete",  methods={"DELETE"})
     *
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function deleteAction(Request $request)
    {
        $response = $this->serviceEndpointResolver->callUsingRequestObject($request);

        $this->validateResponse($response);

        return $this->viewResponseContent($response);
    }

    /**
     * @Route("/relation/football-match/{eventId}/complete", name="comments_view",  methods={"GET"})
     *
     * @Security("is_granted('ROLE_USER')")
     */
    public function viewAction(Request $request)
    {
        $response = $this->serviceEndpointResolver->callUsingRequestObject($request);

        $this->validateResponse($response);

        return $this->viewResponseContent($response);
    }
}
