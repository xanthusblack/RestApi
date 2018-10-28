<?php
/**
 * Created by PhpStorm.
 * User: Prudhvi Raj Maraboyena
 * Date: 06-11-2017
 * Time: 21:23
 *
 * Abstract Template for templates to extend and override functionality
 *
 */

namespace Endpoint\Model\Template;
include_once __DIR__.'/TemplateInterface.php';

/**
 * Class AbstractTemplate
 * @package Endpoint\Model\Template
 */
abstract class AbstractTemplate implements TemplateInterface
{

    /**
     * @param array $data
     * @return AbstractTemplate
     */
    abstract public function setData(array $data):AbstractTemplate ;
}