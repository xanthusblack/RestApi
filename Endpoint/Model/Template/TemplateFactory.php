<?php
/**
 * Created by PhpStorm.
 * User: Prudhvi Raj Maraboyena
 * Date: 05-11-2017
 * Time: 20:32
 *
 * This creates template objects
 * Using design pattern principles
 */

namespace Endpoint\Model\Template;

/**
 * Class TemplateFactory
 * @package Endpoint\Model\Template
 */
class TemplateFactory
{
    /**
     * @param $templateName
     * @param $data
     * @return AbstractTemplate
     */
    public function create($templateName, $data)
    {
        /** @var AbstractTemplate $template */
        $template = new $templateName();
        return $template->setData($data);
    }
}