<?php

namespace Infrastructure\Api\Controller;

use Domain\Exceptions\ErrorBag;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

trait TraitController
{
    public function responseOk(ResponseInterface $response, array|object $data): ResponseInterface
    {
        $response->getBody()->write(json_encode(compact('data')));

        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    public function responseErrors(ResponseInterface $response, ErrorBag ...$errors): ResponseInterface
    {
        $response->getBody()->write(json_encode(compact('errors')));

        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(422);
    }

    public function responseNotFound(ResponseInterface $response, string $type = 'object'): ResponseInterface
    {
        $response->getBody()->write(json_encode([
            'errors' => [
                new ErrorBag($type, 'notFound', $type . ' not found.')
            ]
        ]));

        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(404);
    }

    public function getData(RequestInterface $request): array
    {
        return json_decode($request->getBody()->getContents(),true);
    }
}