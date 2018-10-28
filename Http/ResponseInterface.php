<?php
/**
 * Created by PhpStorm.
 * User: Prudhvi Raj Maraboyena
 * Date: 05-11-2017
 * Time: 14:20
 *
 * Interface defining status codes and content types
 *
 */


namespace Http{
    /**
     * Interface ResponseInterface
     * @package Http
     */
    interface ResponseInterface{
        //Headers
        //StatusCodes
        /**
         * @const INTERNAL_SERVER_ERROR
         * Specifies that an error occurred on the server side and the user is not to blame
         */
        const INTERNAL_SERVER_ERROR = 500;
        /**
         * @const NOT_IMPLEMENTED
         * Specifies that the verb requested by the user has not been implemented
         */
        const NOT_IMPLEMENTED = 501;
        /**
         * @const NOT_FOUND
         * Requested resource not found
         */
        const NOT_FOUND = 404;
        /**
         * @const METHOD_NOT_ALLOWED
         * Specifies that the verb requested by the user will not be allowed for the resource
         */
        const METHOD_NOT_ALLOWED = 405;
        /**
         *
         */
        const CONFLICT = 409;
        /**
         * @const SUCCESS
         * Specifies that the request has been successfully processed
         */
        const SUCCESS = 200;
        /**
         *
         */
        const CREATED = 201;
        /**
         *
         */
        const NOT_MODIFIED = 304;
        /**
         *
         */
        const BAD_REQUEST = 400;
        /**
         *
         */
        const UNAUTHORIZED = 401;

        //ContentTypes
        /**
         *
         */
        const JSON = 'application/json';
        /**
         *
         */
        const XML = 'application/xml';

    }
}