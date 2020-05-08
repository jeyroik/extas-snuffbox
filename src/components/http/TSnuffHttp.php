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
     * @return RequestInterface
     */
    protected function getPsrRequest(
        string $streamRequestSuffix = '',
        array $headers = ['Content-type' => 'application/json'],
        string $query = '',
        string $method = 'GET'
    ): RequestInterface
    {
        return new Request(
            $method,
            new Uri('http', 'localhost', 80, '/', $query),
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
}
