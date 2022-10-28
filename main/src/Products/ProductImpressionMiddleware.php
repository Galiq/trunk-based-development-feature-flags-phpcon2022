<?php

namespace Tbd\Main\Products;

use Psr\Http\Message\ServerRequestInterface;
use Tbd\Main\Recommendations\RecommendationsServiceInterface;

class ProductImpressionMiddleware
{
    private $service;

    public function __construct(RecommendationsServiceInterface $service){
        $this->service = $service;
    }

    public function __invoke(ServerRequestInterface $request, callable $next)
    {
        $response = $next($request);
        if ($response->getStatusCode() == 200) {
            $id = $request->getAttribute('id');
            $this->service->createImpression($id);
        }
        return $response;
    }
}
