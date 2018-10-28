<?php
/**
 * Created by PhpStorm.
 * User: Prudhvi Raj Maraboyena
 * Date: 05-11-2017
 * Time: 15:05
 *
 * Employee entity class that defines the column names and types in the Employee table
 *
 */

namespace Endpoint\Model\Entity;


class Employee extends AbstractEntity
{
    const STATUS = [
        'A' => 'Active',
        'I' => 'Inactive',
        'T' => 'Terminated',
    ];

    const GENDER = [
        '0' => 'Female',
        '1' => 'Male',
    ];

    /** @var int */
    protected $eecode;
    /** @var string */
    protected $eename;
    /** @var int */
    protected $age=0;
    /** @var \DateTime */
    protected $birthdate;
    /** @var int */
    protected $phone = 0;
    /** @var int */
    protected $gender = 0;
    /** @var string */
    protected $status = 'A';
    /** @var int */
    protected $ssn=0;

    /**
     * @return void
     */
    public function getMetadata()
    {
        $this->setTable('employee');
        $this->setField('eecode', 'int', null, true);
        $this->setField('eename', 'string');
        $this->setField('age', 'int');
        $this->setField('birthdate', 'date');
        $this->setField('phone', 'int');
        $this->setField('gender', 'int');
        $this->setField('status', 'string');
        $this->setField('ssn', 'int');
    }

    /**
     * @return int
     */
    public function getEecode(): int
    {
        return $this->eecode;
    }

    /**
     * @param int $eecode
     * @return Employee
     */
    public function setEecode(int $eecode): Employee
    {
        $this->eecode = $eecode;
        return $this;
    }

    /**
     * @return string
     */
    public function getEename(): string
    {
        return $this->eename;
    }

    /**
     * @param string $eename
     * @return Employee
     */
    public function setEename(string $eename): Employee
    {
        $this->eename = $eename;
        return $this;
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
     * @return Employee
     */
    public function setAge(int $age): Employee
    {
        $this->age = $age;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getBirthdate(): \DateTime
    {
        return $this->birthdate;
    }

    /**
     * @param \DateTime $birthdate
     * @return Employee
     */
    public function setBirthdate(\DateTime $birthdate): Employee
    {
        $this->birthdate = $birthdate;
        return $this;
    }

    /**
     * @return int
     */
    public function getPhone(): int
    {
        return $this->phone;
    }

    /**
     * @param int $phone
     * @return Employee
     */
    public function setPhone(int $phone): Employee
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return int
     */
    public function getGender(): int
    {
        return $this->gender;
    }

    /**
     * @param int $gender
     * @return Employee
     */
    public function setGender(int $gender): Employee
    {
        $this->gender = $gender;
        return $this;
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
     * @return Employee
     */
    public function setStatus(string $status): Employee
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return int
     */
    public function getSsn(): int
    {
        return $this->ssn;
    }

    /**
     * @param int $ssn
     * @return Employee
     */
    public function setSsn(int $ssn): Employee
    {
        $this->ssn = $ssn;
        return $this;
    }

}