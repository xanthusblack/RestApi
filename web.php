<?php
/**
 * Created by PhpStorm.
 * User: Prudhvi Raj Maraboyena
 * Date: 05-11-2017
 * Time: 13:21
 *
 * End point for the API application
 *  Handles all the requests
 */
include_once __DIR__ . '/config.php';
include_once __DIR__ . '/Http/ResponseInterface.php';
include_once __DIR__ . '/Http/Request.php';
include_once __DIR__ . '/Http/Response.php';
include_once __DIR__ . '/API/Kernel.php';


use \Http\{
    Request, Response
};
use API\{
    Kernel
};

// Creates a new request object and populates the request data
$request = new Request();

try {
    // Figures out all the available endpoints
    $kernel = new Kernel();
    $response = $kernel->handleRequest($request);
} catch (Exception $e) {
    $errorMsg = $e->getMessage() . '\n' . $e->getTraceAsString();

    $response = new Response();
    $response->contentType = Response::JSON;
    if ($e instanceof \API\Exception\AbstractRestException) {
        $response->statusCode = $e->getCode();
        $response->body = $e->getMessage();
    } else {
        $response->statusCode = Response::INTERNAL_SERVER_ERROR;
        $response->body = '';       //To prevent malformed responses from being returned
        error_log(' PHP Error:  ' . $errorMsg);
    }
}
http_response_code($response->statusCode);
header('Content-Type: ' . $response->contentType);
foreach ($response->headers as $header => $data) {
    header($header . ': ' . $data);
}
echo $response->body;
