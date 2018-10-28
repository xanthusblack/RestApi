<?php
/**
 * Created by PhpStorm.
 * User: Prudhvi Raj Maraboyena
 * Date: 05-11-2017
 * Time: 14:06
 *
 * Http Response class for standard responses
 *
 */

namespace Http;


/**
 * Class Response
 * @package Http
 */
class Response implements ResponseInterface
{
    /**
     * @var
     */
    public $statusCode;
    /**
     * @var
     */
    public $body;
    /**
     * @var
     */
    public $contentType;
    /**
     * @var array
     */
    public $headers = [];

}