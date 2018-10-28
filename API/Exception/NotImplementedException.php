<?php
/**
 * Created by PhpStorm.
 * User: Prudhvi Raj Maraboyena
 * Date: 05-11-2017
 * Time: 17:57
 *
 * NotImplementedException Class with status code and message
 *
 */

namespace API\Exception;
include_once __DIR__.'/AbstractRestException.php';

use Http\ResponseInterface;

class NotImplementedException extends AbstractRestException
{

    /**
     * NotImplementedException constructor.
     */
    public function __construct()
    {
        $this->code = ResponseInterface::NOT_IMPLEMENTED;
        $this->message = 'Method Not Implemented';
    }
}