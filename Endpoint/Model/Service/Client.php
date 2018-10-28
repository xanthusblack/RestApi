<?php
/**
 * Created by PhpStorm.
 * User: Prudhvi Raj Maraboyena
 * Date: 05-11-2017
 * Time: 15:06
 *
 * Client Service class fetches data from the client repository and provides it to the controller
 *
 */

namespace Endpoint\Model\Service;

/**
 * Class Client
 * @package Endpoint\Model\Service
 */
class Client
{
    /** @var \Endpoint\Model\Repository\Client */
    protected $repo;

    /**
     * Client constructor.
     */
    public function __construct()
    {
        $this->repo= new \Endpoint\Model\Repository\Client();
    }

    /**
     * @param $id
     * @return array|null
     */
    public function getClient($id)
    {
        return $this->repo->findOneBy(['clientcode'=>$id]);
    }

    /**
     * @param $filters
     * @return array
     */
    public function getClientsBy($filters){
        return $this->repo->findBy($filters);
    }

    /**
     * @return array
     */
    public function getAllClients()
    {
        return $this->repo->findAll();
    }

    /**
     * @param array $postData
     * @return bool|int|\mysqli_result
     */
    public function createClient(array $postData)
    {
        return $this->repo->insert($postData);
    }
}