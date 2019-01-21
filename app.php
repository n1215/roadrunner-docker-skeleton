<?php

declare(strict_types=1);

$psr17Factory = new Nyholm\Psr7\Factory\Psr17Factory();
$containerBuilder = new DI\ContainerBuilder();
$containerBuilder->addDefinitions([
    Psr\Http\Message\ResponseFactoryInterface::class => $psr17Factory,
    Psr\Http\Message\ServerRequestFactoryInterface::class => $psr17Factory,
    Psr\Http\Message\StreamFactoryInterface::class => $psr17Factory,
    Psr\Http\Message\UploadedFileFactoryInterface::class => $psr17Factory,
    Spiral\RoadRunner\WorkerInterface::class => Spiral\RoadRunner\Worker::create(),
    Spiral\RoadRunner\Http\PSR7WorkerInterface::class => DI\autowire(Spiral\RoadRunner\Http\PSR7Worker::class),
]);
$container = $containerBuilder->build();

$app = DI\Bridge\Slim\Bridge::create($container);

// define routes
$app->get('/', function (Psr\Http\Message\ServerRequestInterface $request, Psr\Http\Message\ResponseInterface $response) {
    $response->getBody()->write('Hello world from RoadRunner and Slim!');
    return $response;
});

// set routing error handling
$app->add(App\ErrorHandlingMiddleware::class);

return $app;
