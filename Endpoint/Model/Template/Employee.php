<?php
/**
 * Created by PhpStorm.
 * User: Prudhvi Raj Maraboyena
 * Date: 05-11-2017
 * Time: 15:42
 *
 * To maintain a format that needs to be outputted to the user
 * Public members of this class can be json encoded
 *
 */

namespace Endpoint\Model\Template;
include_once __DIR__ .'/AbstractTemplate.php';

/**
 * Class Employee
 * @package Endpoint\Model\Template
 */
class Employee extends AbstractTemplate
{
    /** @var int */
    public $employeeCode;
    /** @var string */
    public $employeeName;
    /** @var int */
    public $age = 0;
    /** @var int */
    public $phoneNumber = 0;
    /** @var string */
    public $gender = 0;
    /** @var string */
    public $status = 'A';

    /**
     * @param array $data
     * @return AbstractTemplate
     */
    public function setData(array $data): AbstractTemplate
    {
        $this->setEmployeeCode($data['eecode']);
        $this->setEmployeeName($data['eename']);
        $this->setAge($data['age'] ?? 0);
        $this->setPhoneNumber($data['phone'] ?? 0);
        $this->setGender(\Endpoint\Model\Entity\Employee::GENDER[$data['gender']] ?? 0);
        $this->setStatus(\Endpoint\Model\Entity\Employee::STATUS[$data['status']] ?? 'A');
        return $this;
    }

    /**
     * @return int
     */
    public function getEmployeeCode(): int
    {
        return $this->employeeCode;
    }

    /**
     * @param int $employeeCode
     */
    public function setEmployeeCode(int $employeeCode)
    {
        $this->employeeCode = $employeeCode;
    }

    /**
     * @return string
     */
    public function getEmployeeName(): string
    {
        return $this->employeeName;
    }

    /**
     * @param string $employeeName
     */
    public function setEmployeeName(string $employeeName)
    {
        $this->employeeName = $employeeName;
    }

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }

    /**
     * @param int $age
     */
    public function setAge(int $age)
    {
        $this->age = $age;
    }

    /**
     * @return int
     */
    public function getPhoneNumber(): int
    {
        return $this->phoneNumber;
    }

    /**
     * @param int $phoneNumber
     */
    public function setPhoneNumber(int $phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return string
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     */
    public function setGender(string $gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status)
    {
        $this->status = $status;
    }

}