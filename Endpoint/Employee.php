<?php
/**
 * Created by PhpStorm.
 * User: Prudhvi Raj Maraboyena
 * Date: 05-11-2017
 * Time: 15:00
 *
 * Endpoint for the employee resource
 *
 */

namespace Endpoint;

use API\Exception\AbstractRestException;
use API\Exception\ConflictException;
use Endpoint\Model\Template\TemplateFactory;
use Http\Response;

/**
 * Class Employee
 * @package Endpoint
 */
class Employee extends AbstractEndpoint
{

    /**
     * @var Model\Service\Employee
     */
    protected $service;

    /**
     * Employee constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->service = new \Endpoint\Model\Service\Employee();
    }

    /**
     * @return Response
     */
    public function getList()
    {
        $filters = $this->request->getParams();
        if (count($filters)) {
            $employeeData = $this->service->getEmployeesBy($filters);
        } else {
            $employeeData = $this->service->getAllEmployees();
        }

        $return = [];
        $templateFactory = new TemplateFactory();
        foreach ($employeeData as $data) {
            $return[] = $templateFactory->create(\Endpoint\Model\Template\Employee::class, $data);
        }

        $this->response->body = json_encode($return);
        return $this->response;
    }

    /**
     * @param string $id
     * @return Response
     */
    public function get(string $id)
    {
        $employee = $this->service->getEmployee($id);
        $templateFactory = new TemplateFactory();
        if(!is_array($employee)){
            throw new AbstractRestException(Response::NOT_FOUND);
        }
        $return = $templateFactory->create(\Endpoint\Model\Template\Employee::class, $employee);

        $this->response->body = json_encode($return);
        return $this->response;
    }

    /**
     * @param array $postData
     * @return Response
     * @throws AbstractRestException
     */
    public function post(array $postData)
    {
        $employee = $this->service->createEmployee($postData);

        if ($employee) {
            $this->response->statusCode = Response::CREATED;
            $this->response->headers['Location'] = $this->getEndpoint() . 'employee/' . $employee;
        } else {
            throw new AbstractRestException(Response::BAD_REQUEST);
        }

        return $this->response;
    }

    /**
     * @param string $id
     * @param array $data
     * @return Response
     * @throws AbstractRestException
     */
    public function patch(string $id, array $data)
    {
        $employee = $this->service->getEmployee($id);
        if (is_array($employee)) {
            $employee = array_merge($employee, $data);
            $status = $this->service->updateEmployee($employee);

            if (!$status) {
                throw new AbstractRestException(Response::BAD_REQUEST);
            }
            return $this->response;

        } else {
            throw new AbstractRestException(Response::NOT_FOUND);
        }
    }

    public function delete(string $id)
    {
        $employee = $this->service->getEmployee($id);
        if (is_array($employee)) {
            $this->service->deleteEmployee($employee);
            return $this->response;
        }
        throw new AbstractRestException(Response::NOT_FOUND);
    }

}