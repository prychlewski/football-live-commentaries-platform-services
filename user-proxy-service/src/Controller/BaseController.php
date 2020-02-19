<?php

namespace App\Controller;

use App\Exception\ModelValidationException;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class BaseController extends AbstractFOSRestController
{
    protected function handleErrors(ConstraintViolationListInterface $validationErrors): void
    {
        if ($validationErrors->count() === 0) {
            return;
        }

        $errors = [];
        /** @var ConstraintViolation $error */
        foreach ($validationErrors as $error) {
            $errors[$error->getPropertyPath()] = $error->getMessage();
        }

        throw new ModelValidationException($errors);
    }

    protected function validateResponse(ResponseInterface $response)
    {
        $statusCode = $response->getStatusCode();

        $successCodes = [
            Response::HTTP_OK,
            Response::HTTP_CREATED,
            Response::HTTP_ACCEPTED,
            Response::HTTP_NO_CONTENT,
        ];

        if (in_array($statusCode, $successCodes, true)) {
            return;
        }

        $content = json_decode($response->getContent(false), true);

        switch (true) {
            case !empty($content['error']):
                $message = $content['error'];
                break;
            case !empty($content['message']):
                $message = $content['message'];
                break;
            default:
                $message = 'Undecodable service response';
        }

        throw new HttpException($statusCode, $message);
    }

    protected static function getResponseContent(ResponseInterface $response)
    {
        return json_decode($response->getContent(), true);
    }

    protected function viewResponseContent(ResponseInterface $response): View
    {
        return View::create(self::getResponseContent($response));
    }
}
