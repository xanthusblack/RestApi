<?php
/**
 * Created by PhpStorm.
 * User: Prudhvi Raj Maraboyena
 * Date: 05-11-2017
 * Time: 15:06
 *
 * Employee Entity specific db functionality
 *
 */

namespace Endpoint\Model\Repository;


/**
 * Class Employee
 * @package Endpoint\Model\Repository
 * Any entity-specific queries go here
 */
class Employee extends AbstractRepository
{
    protected $templateMap = [
        'eename'=> 'employeeName',
        'eecode'=> 'employeeCode',
        'phone'=> 'phoneNumber',
    ];

    /**
     * Employee constructor.
     */
    public function __construct()
    {
        $this->setEntityClassName(\Endpoint\Model\Entity\Employee::class);
        parent::__construct();
    }

    /**
     * @param $clientcode
     * @return array
     */
    public function findActiveEmployees($clientcode)
    {
        $criteria = [
            'clientcode' => $clientcode,
            'status' => 'A',
        ];
        return $this->findBy($criteria);
    }
}