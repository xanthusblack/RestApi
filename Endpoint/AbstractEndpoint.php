<?php
/**
 * Created by PhpStorm.
 * User: Prudhvi Raj Maraboyena
 * Date: 05-11-2017
 * Time: 15:06
 *
 * This class handles request based routing
 * Also implements authentication
 *
 */

namespace Endpoint;


use Http\Request;
use Http\Response;
use API\Exception;
use Endpoint\Model\Template\TemplateFactory;

/**
 * Class AbstractEndpoint
 * @package Endpoint
 */
class AbstractEndpoint
{
    /** @var Response */
    protected $response;
    /** @var  Request */
    protected $request;

    public function __construct()
    {
        $this->response = new Response();
        $this->response->statusCode = Response::SUCCESS;
        $this->response->contentType = Response::JSON;
        $this->response->body = '';
    }

    /**
     * @param Request $request
     * @return Response
     * @throws Exception\NotImplementedException
     */
    public function handleRequest($request)
    {
        $this->request = $request;
        $this->authenticate();
        $action = $request->getAction();

        if (method_exists($this, $action)) {
            $id = $request->getId();
            switch (strtolower($action)) {
                case 'get':
                    if (empty($id)) {
                        return $this->getList();
                    }
                    return $this->$action($id);
                    break;
                case 'post':
                    $data = $_POST;
                    return $this->$action($data);
                    break;
                case 'patch':
                    $data = [];
                    $this->parse_raw_http_request($data);
                    return $this->$action($id, $data);
                    break;
                default:
                    return $this->$action($id);
            }
        } else {
            throw new Exception\NotImplementedException();
        }
        return $this->response;
    }

    public function authenticate()
    {
        global $rest_username, $rest_password;
        if ($this->request->getUser() !== $rest_username || $this->request->getPassword() !== $rest_password) {
            throw new Exception\AbstractRestException(Response::UNAUTHORIZED, 'Invalid Username or Password');
        }
    }

    /**
     * The below function was taken from:
     * https://stackoverflow.com/a/5488449
     * Is being used to here to parse encoded form-data for a Patch request
     */
    public function parse_raw_http_request(array &$a_data)
    {
        // read incoming data
        $input = file_get_contents('php://input');

        // grab multipart boundary from content type header
        preg_match('/boundary=(.*)$/', $_SERVER['CONTENT_TYPE'], $matches);
        $boundary = $matches[1];

        // split content by boundary and get rid of last -- element
        $a_blocks = preg_split("/-+$boundary/", $input);
        array_pop($a_blocks);

        // loop data blocks
        foreach ($a_blocks as $id => $block) {
            if (empty($block))
                continue;

            // parse uploaded files
            if (strpos($block, 'application/octet-stream') !== FALSE) {
                // match "name", then everything after "stream" (optional) except for prepending newlines
                preg_match("/name=\"([^\"]*)\".*stream[\n|\r]+([^\n\r].*)?$/s", $block, $matches);
            } // parse all other fields
            else {
                // match "name" and optional value in between newline sequences
                preg_match('/name=\"([^\"]*)\"[\n|\r]+([^\n\r].*)?\r$/s', $block, $matches);
            }
            $a_data[$matches[1]] = $matches[2];
        }
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param mixed $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }

    public function get(string $id)
    {
        throw new Exception\NotImplementedException();
    }

    public function getList()
    {
        throw new Exception\NotImplementedException();
    }

    public function patch(string $id, array $postData)
    {
        throw new Exception\NotImplementedException();
    }

    public function post(array $postData)
    {
        throw new Exception\NotImplementedException();
    }

    public function delete(string $id)
    {
        throw new Exception\NotImplementedException();
    }

    /**
     * @return string
     */
    public function getEndpoint(): string
    {
        return 'web.php/';
    }

}