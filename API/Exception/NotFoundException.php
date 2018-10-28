<?php
/**
 * Created by PhpStorm.
 * User: Prudhvi Raj Maraboyena
 * Date: 05-11-2017
 * Time: 17:52
 *
 * NotFoundException Class with status code and message
 *
 */

namespace API\Exception;


use Http\ResponseInterface;

class NotFoundException extends AbstractRestException
{

    /**
     * NotFoundException constructor.
     */
    public function __construct()
    {
        $this->code = ResponseInterface::NOT_FOUND;
        $this->message = "Resource Not Found";
    }
}