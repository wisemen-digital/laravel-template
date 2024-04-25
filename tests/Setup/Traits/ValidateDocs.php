<?php

namespace Tests\Setup\Traits;

use Illuminate\Contracts\Http\Kernel as HttpKernel;
use Illuminate\Foundation\Testing\Concerns\MakesHttpRequests;
use Illuminate\Http\Request;
use Osteel\OpenApi\Testing\ValidatorBuilder;
use Osteel\OpenApi\Testing\ValidatorInterface;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

trait ValidateDocs
{
    use MakesHttpRequests;

    protected ValidatorInterface $validator;

    public function getValidator(): ValidatorInterface
    {
        if (! isset($this->validator) || ! $this->validator) {
            $this->validator = ValidatorBuilder::fromYamlFile(resource_path('docs/openapi.yaml'))->getValidator();
        }

        return $this->validator;
    }

    public function call($method, $uri, $parameters = [], $cookies = [], $files = [], $server = [], $content = null)
    {
        $kernel = $this->app->make(HttpKernel::class);

        $files = array_merge($files, $this->extractFilesFromDataArray($parameters));

        $symfonyRequest = SymfonyRequest::create(
            $this->prepareUrlForRequest($uri), $method, $parameters,
            $cookies, $files, array_replace($this->serverVariables, $server), $content
        );

        $response = $kernel->handle(
            $request = Request::createFromBase($symfonyRequest)
        );

        $kernel->terminate($request, $response);

        $status_code = $response->getStatusCode();
        if ($status_code >= 200 && $status_code < 300) {
            $validator = $this->getValidator();

            $validator->validate($request, $uri, $method);
            $validator->validate($response, $uri, $method);
        }

        if ($this->followRedirects) {
            $response = $this->followRedirects($response);
        }

        return static::$latestResponse = $this->createTestResponse($response, $request);
    }
}
