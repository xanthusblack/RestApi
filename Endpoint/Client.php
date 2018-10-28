<?php
/**
 * Created by PhpStorm.
 * User: Prudhvi Raj Maraboyena
 * Date: 05-11-2017
 * Time: 14:59
 *
 * Endpoint for the client resource
 *
 */

namespace Endpoint;


use API\Exception\AbstractRestException;
use Endpoint\Model\Template\TemplateFactory;
use Http\Response;

/**
 * Class Client
 * @package Endpoint
 */
class Client extends AbstractEndpoint
{
    /**
     * @var Model\Service\Client
     */
    protected $service;

    /**
     * Client constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->service = new \Endpoint\Model\Service\Client();
    }

    /**
     * @return Response
     */
    public function getList()
    {
        $filters = $this->request->getParams();
        if (count($filters)) {
            $clientData = $this->service->getClientsBy($filters);
        } else {
            $clientData = $this->service->getAllClients();
        }

        $return = [];
        $templateFactory = new TemplateFactory();
        foreach ($clientData as $data) {
            $return[] = $templateFactory->create(\Endpoint\Model\Template\Client::class, $data);
        }

        $this->response->body = json_encode($return);
        return $this->response;
    }

    /**
     * @param string $id
     * @return Response
     */
    public function get(string $id)
    {
        $client = $this->service->getClient($id);
        $templateFactory = new TemplateFactory();
        if(!is_array($client)){
            throw new AbstractRestException(Response::NOT_FOUND);
        }
        $return = $templateFactory->create(\Endpoint\Model\Template\Client::class, $client);

        $this->response->body = json_encode($return);
        return $this->response;
    }

    /**
     * @param array $postData
     * @return Response
     */
    public function post(array $postData)
    {
        $clientcode = $this->service->createClient($postData);

        if ($clientcode) {
            $this->response->statusCode = Response::CREATED;
            $this->response->headers['Location'] = $this->getEndpoint() . 'client/' . $clientcode;
        } else {
            $this->response->statusCode = Response::BAD_REQUEST;
        }

        return $this->response;
    }

}