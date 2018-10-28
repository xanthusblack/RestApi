<?php
/**
 * Created by PhpStorm.
 * User: Prudhvi Raj Maraboyena
 * Date: 06-11-2017
 * Time: 21:18
 *
 * Template Interface to define the rules for templates
 *
 */

namespace Endpoint\Model\Template;


/**
 * Interface TemplateInterface
 * @package Endpoint\Model\Template
 */
interface TemplateInterface
{
    /**
     * @param array $data
     * @return AbstractTemplate
     */
    public function setData(array $data): AbstractTemplate;
}