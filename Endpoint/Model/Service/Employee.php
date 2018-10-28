<?php
/**
 * Created by PhpStorm.
 * User: Prudhvi Raj Maraboyena
 * Date: 05-11-2017
 * Time: 15:06
 *
 * Employee Service class fetches data from the Employee repository and provides it to the controller
 *
 */

namespace Endpoint\Model\Service;


/**
 * Class Employee
 * @package Endpoint\Model\Service
 */
class Employee
{
    /** @var \Endpoint\Model\Repository\Employee */
    protected $repo;

    /**
     * Employee constructor.
     */
    public function __construct()
    {
        $this->repo = new \Endpoint\Model\Repository\Employee();
    }

    /**
     * @param $id
     * @return array|null
     */
    public function getEmployee($id)
    {
        return $this->repo->findOneBy(['eecode' => $id]);
    }

    /**
     * @param $filters
     * @return array
     */
    public function getEmployeesBy($filters)
    {
        return $this->repo->findBy($filters);
    }

    /**
     * @return array
     */
    public function getAllEmployees()
    {
        return $this->repo->findAll();
    }

    /**
     * @param array $postData
     * @return bool|int|\mysqli_result
     */
    public function createEmployee(array $postData)
    {
        if (!isset($postData['age'])) {
            $birthDate = date('m/d/Y', strtotime($postData['birthdate']));
            $birthDate = explode("/", $birthDate);
            //get age from birthdate
            $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
                ? ((date("Y") - $birthDate[2]) - 1)
                : (date("Y") - $birthDate[2]));
            $postData['age'] = $age;
        }
        return $this->repo->insert($postData);
    }

    /**
     * @param $employee
     * @return int
     */
    public function updateEmployee($employee)
    {
        return $this->repo->update($employee);
    }

    /**
     * @param $employee
     * @return int
     */
    public function deleteEmployee($employee)
    {
        return $this->repo->deleteBy($employee);
    }

}