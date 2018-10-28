<?php
/**
 * Created by PhpStorm.
 * User: Prudhvi Raj Maraboyena
 * Date: 05-11-2017
 * Time: 15:05
 *
 * Client Entity specific db functionality
 *
 */

namespace Endpoint\Model\Repository;


/**
 * Class Client
 * @package Endpoint\Model\Repository
 * Any entity-specific queries go here
 */
class Client extends AbstractRepository
{
    public function __construct()
    {
        $this->setEntityClassName(\Endpoint\Model\Entity\Client::class);
        parent::__construct();
    }
}