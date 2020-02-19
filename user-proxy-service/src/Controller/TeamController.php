<?php

namespace App\Controller;

use App\Service\ServiceEndpointResolver;
use FOS\RestBundle\Controller\Annotations\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TeamController extends BaseController
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
     * @Route("/team", name="team_add",  methods={"POST"})
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
     * @Route("/team/{id}", name="team_edit",  methods={"PATCH"})
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
     * @Route("/team/{id}", name="team_delete",  methods={"DELETE"})
     *
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function deleteAction(Request $request)
    {
        $response = $this->serviceEndpointResolver->callUsingRequestObject($request);

        $this->validateResponse($response);

        return $this->view(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * @Route("/team/{id}", name="team_view",  methods={"GET"})
     */
    public function viewAction(Request $request)
    {
        $response = $this->serviceEndpointResolver->callUsingRequestObject($request);

        $this->validateResponse($response);

        return $this->viewResponseContent($response);
    }
}
