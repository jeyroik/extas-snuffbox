<?php
namespace extas\components\http;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Headers;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Psr7\Stream;
use Slim\Psr7\Uri;

/**
 * Trait THttp
 *
 * @package extas\components\http
 * @author jeyroik@gmail.com
 */
trait TSnuffHttp
{
    /**
     * @param string $streamRequestSuffix
     * @param array|string[] $headers
     * @param string $query
     * @param string $method
     * @param string $path
     * @param string $host
     * @param int $port
     * @return RequestInterface
     */
    protected function getPsrRequest(
        string $streamRequestSuffix = '',
        array $headers = ['Content-type' => 'application/json'],
        string $query = '',
        string $method = 'GET',
        string $path = '/',
        string $host = 'localhost',
        int $port = 80
    ): RequestInterface
    {
        return new Request(
            $method,
            new Uri('http', $host, $port, $path, $query),
            new Headers($headers),
            [],
            [],
            new Stream(fopen(getcwd() . '/tests/request' . $streamRequestSuffix . '.json', 'r'))
        );
    }

    /**
     * @return ResponseInterface
     */
    protected function getPsrResponse(): ResponseInterface
    {
        return new Response();
    }

    /**
     * @param ResponseInterface $psrResponse
     * @return array
     */
    protected function getJsonRpcResponse(ResponseInterface $psrResponse): array
    {
        return json_decode($psrResponse->getBody(), true);
    }

    /**
     * @param ResponseInterface $psrResponse
     * @param string $errorField
     * @return bool
     */
    protected function isJsonRpcResponseHasError(ResponseInterface $psrResponse, string $errorField = 'error'): bool
    {
        $response = $this->getJsonRpcResponse($psrResponse);

        return isset($response[$errorField]);
    }

    /**
     * @param ResponseInterface $psrResponse
     * @param string $errorField
     * @return bool
     */
    protected function isJsonRpcResponseHasNotError(ResponseInterface $psrResponse, string $errorField = 'error'): bool
    {
        return !$this->isJsonRpcResponseHasError($psrResponse, $errorField);
    }
}
