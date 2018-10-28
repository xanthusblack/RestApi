<?php
/**
 * Created by PhpStorm.
 * User: Prudhvi Raj Maraboyena
 * Date: 05-11-2017
 * Time: 15:12
 *
 * Entity Interface defines rules for the entities
 *
 */

namespace Endpoint\Model\Entity;


/**
 * Interface EntityInterface
 * @package Endpoint\Model\Entity
 */
interface EntityInterface
{
    /**
     * @return string|null
     */
    public function getTable();
    /**
     * @return void
     */
    public function getMetadata();
}