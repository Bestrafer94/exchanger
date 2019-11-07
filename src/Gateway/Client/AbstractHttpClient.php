<?php

declare(strict_types=1);

namespace App\Gateway\Client;

use App\Gateway\Request\RequestInterface;
use App\Gateway\Response\ResponseInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;

abstract class AbstractHttpClient extends AbstractClient
{
    /**
     * {@inheritdoc}
     */
    protected function sendRequest(RequestInterface $request): ResponseInterface
    {
        $responseClass = $request->getResponseClass();

        try {
            $response = new $responseClass($this->sendRequestAndGetContents($request));
        } catch (GuzzleException $e) {
            if ($e instanceof RequestException && ($errRes = $e->getResponse())) {
                $response = new $responseClass($errRes->getBody()->getContents());
            } else {
                $response = $this->buildErrorResponse($responseClass, $e);
            }
        }

        return $response;
    }

    /**
     * @param RequestInterface $request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function sendHttpRequest(RequestInterface $request): \Psr\Http\Message\ResponseInterface
    {
        return $this->http->request(
            $request->getMethod(),
            $request->getRequestTarget().$request->getParameters()
        );
    }

    /**
     * @param RequestInterface $request
     * @param array $options
     *
     * @return string
     */
    private function sendRequestAndGetContents(RequestInterface $request, array $options = []): string
    {
        return $this->sendHttpRequest($request, $options)->getBody()->getContents();
    }

    /**
     * @param string $responseClass
     *
     * @return ResponseInterface
     */
    abstract protected function buildErrorResponse(string $responseClass, \Exception $e): ResponseInterface;
}
