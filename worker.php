<?php
declare(strict_types=1);

ini_set('display_errors', 'stderr');
include 'vendor/autoload.php';

$relay = new Spiral\Goridge\StreamRelay(STDIN, STDOUT);
$worker = new Spiral\RoadRunner\Worker($relay);
$psr17Factory = new Nyholm\Psr7\Factory\Psr17Factory();
$psr7 = new Spiral\RoadRunner\PSR7Client($worker, $psr17Factory, $psr17Factory, $psr17Factory);

while ($req = $psr7->acceptRequest()) {
    try {
        $resp = $psr17Factory->createResponse();
        $resp->getBody()->write('Hello world from RoadRunner!');
        $psr7->respond($resp);
    } catch (Throwable $e) {
        $psr7->getWorker()->error((string)$e);
    }
}
