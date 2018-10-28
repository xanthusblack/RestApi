<?php
/**
 * Created by PhpStorm.
 * User: Prudhvi Raj Maraboyena
 * Date: 06-11-2017
 * Time: 20:50
 *
 * ConflictException Class with status code and message
 *
 */

namespace API\Exception;

use Http\ResponseInterface;

class ConflictException extends AbstractRestException
{
    /**
     * NotFoundException constructor.
     */
    public function __construct()
    {
        $this->code = ResponseInterface::CONFLICT;
        $this->message = "Resource Not Updated";
    }
}