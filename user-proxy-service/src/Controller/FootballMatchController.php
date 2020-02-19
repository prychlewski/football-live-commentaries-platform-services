<?php

namespace App\Controller;

use App\Service\ServiceEndpointResolver;
use FOS\RestBundle\Controller\Annotations\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

class FootballMatchController extends BaseController
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
     * @Route("/football-match", name="football_match_add",  methods={"POST"})
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
     * @Route("/football-match/{id}", name="football_match_edit",  methods={"PATCH"})
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
     * @Route("/football-match/{id}", name="football_match_delete",  methods={"DELETE"})
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
     * @Route("/football-match/{id}", name="football_match_view",  methods={"GET"})
     */
    public function viewAction(Request $request)
    {
        $response = $this->serviceEndpointResolver->callUsingRequestObject($request);

        $this->validateResponse($response);

        return $this->viewResponseContent($response);
    }

    /**
     * @Route("/football-match/{eventId}/goal", name="football_match_goal",  methods={"PATCH"})
     *
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function scoreAGoalAction(Request $request)
    {
        $response = $this->serviceEndpointResolver->callUsingRequestObject($request);

        $this->validateResponse($response);

        return $this->viewResponseContent($response);
    }
}
