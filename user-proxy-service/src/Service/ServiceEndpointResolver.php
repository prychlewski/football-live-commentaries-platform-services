<?php

namespace App\Service;

use App\Model\EndpointToServiceMap;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ServiceEndpointResolver
{
    /**
     * @var HttpClientInterface
     */
    private $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function callService(
        string $method,
        string $url,
        string $payload,
        array $headers = [],
        string $contentType = 'application/json'
    ) {
        return $this->httpClient->request($method, $url, [
            'headers' => array_merge([
                'Content-Type' => $contentType,
            ], $headers),
            'body'    => $payload,
        ]);
    }

    public function callUsingRequestObject(Request $request)
    {
        $url = $this->prepareUrlUsingRouteName(
            $request->get('_route'),
            $request->getRequestUri()
        );

        return $this->callService(
            $request->getMethod(),
            $url,
            $request->getContent(),
            [
                'Authorization' => $request->server->get('HTTP_AUTHORIZATION'),
            ],
            $request->server->get('CONTENT_TYPE')
        );
    }

    private function prepareUrlUsingRouteName(string $routeName, string $path, string $protocol = 'http'): string
    {
        return sprintf(
            '%s://%s%s',
            $protocol,
            EndpointToServiceMap::resolveHostUsingRouteName($routeName),
            $path
        );
    }
}
