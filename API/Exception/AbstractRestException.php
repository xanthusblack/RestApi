<?php
/**
 * Created by PhpStorm.
 * User: Prudhvi Raj Maraboyena
 * Date: 06-11-2017
 * Time: 20:04
 *
 * Abstract class to create the exceptions that will be handled in web.php
 *
 */

namespace API\Exception;

class AbstractRestException extends \Exception
{
    /**
     * AbstractRestException constructor.
     * @param int $statusCode
     * @param null $message
     */
    public function __construct(int $statusCode, $message = null)
    {
        $this->code = $statusCode;
        if (isset($message)) {
            $this->message = $message;
        }
    }
}