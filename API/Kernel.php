<?php
/**
 * Created by PhpStorm.
 * User: Prudhvi Raj Maraboyena
 * Date: 05-11-2017
 * Time: 14:39
 *
 * Handles the user's request and returns the appropriate response
 * Invokes Endpoint controllers to fetch and post data
 * Includes necessary files
 *
 */

namespace API;


use Http\Request;
use Http\Response;

class Kernel
{

    const FILE_BLACKLIST = [
        '.',
        '..',
        'Kernel.php'
    ];

    /** @var bool  */
    protected $booted = false;

    /**
     * Kernel constructor.
     */
    public function __construct()
    {
        if (!$this->booted) {
            $this->boot();
        }
    }

    /**
     * @param Request $request
     * @return Response| null
     * @throws \Exception
     */
    public function handleRequest($request): Response
    {
        $response = new Response();
        $controllerName = $request->getController();
        $controllerName = 'Endpoint\\' . ucfirst($controllerName);
        if (class_exists($controllerName)) {
            $controller = new $controllerName();
            $response = $controller->handleRequest($request);

            if (!$response instanceof Response) {
                $response->body = json_encode($response);
                $response->statusCode = Response::SUCCESS;
                $response->contentType = Response::JSON;
            }
        } else {
            throw new Exception\NotFoundException();
        }
        return $response;
    }

    /**
     *
     */
    public function boot()
    {
        //Get all the available resources(classes) and allowed verbs(methods in them)
        $dirs = [
            'endpointDir' => __DIR__ . '/../Endpoint/',
            'APIDir' => __DIR__ . '/../API/',
            'HttpDir' => __DIR__ . '/../Http/',
            ];
        foreach ($dirs as $dir) {
            $this->includeFiles($dir);
        }
        $this->booted = true;
    }

    /**
     * @param $endpointDir
     */
    public function includeFiles($endpointDir)
    {
        if (is_dir($endpointDir)) {
            $dirHandle = opendir($endpointDir);
            if (is_resource($dirHandle)) {
                while ($item = readdir($dirHandle)) {
                    if ($item && !in_array($item, self::FILE_BLACKLIST)) {
                        if (is_dir($endpointDir . $item)) {
                            $this->includeFiles($endpointDir . $item . '/');
                        } else {
                            /** @noinspection PhpIncludeInspection */
                            include_once $endpointDir . $item;
                        }
                    }
                }
            }
        }
    }

}