<?php
/**
 * Created by PhpStorm.
 * User: Prudhvi Raj Maraboyena
 * Date: 05-11-2017
 * Time: 15:40
 *
 * To maintain a format that needs to be outputted to the user
 * Public members of this class can be json encoded
 *
 */

namespace Endpoint\Model\Template;


/**
 * Class Client
 * @package Endpoint\Model\Template
 */
class Client extends AbstractTemplate
{
    /** @var int */
    public $clientcode;
    /** @var string */
    public $clientname;
    /** @var string */
    public $clientaddress;
    /** @var int */
    public $zipcode;

    /**
     * @param array $clientData
     * @return AbstractTemplate
     */
    public function setData(array $clientData): AbstractTemplate
    {
        $this->setClientcode($clientData['clientcode']);
        $this->setClientname($clientData['clientname']);
        $this->setClientaddress($clientData['address'] ?? '');
        $this->setZipcode($clientData['zipcode'] ?? 0);
        return $this;
    }

    /**
     * @return int
     */
    public function getClientcode(): int
    {
        return $this->clientcode;
    }

    /**
     * @param int $clientcode
     */
    public function setClientcode(int $clientcode)
    {
        $this->clientcode = $clientcode;
    }

    /**
     * @return string
     */
    public function getClientname(): string
    {
        return $this->clientname;
    }

    /**
     * @param string $clientname
     */
    public function setClientname(string $clientname)
    {
        $this->clientname = $clientname;
    }

    /**
     * @return string
     */
    public function getClientaddress(): string
    {
        return $this->clientaddress;
    }

    /**
     * @param string $clientaddress
     */
    public function setClientaddress(string $clientaddress)
    {
        $this->clientaddress = $clientaddress;
    }

    /**
     * @return int
     */
    public function getZipcode(): int
    {
        return $this->zipcode;
    }

    /**
     * @param int $zipcode
     */
    public function setZipcode(int $zipcode)
    {
        $this->zipcode = $zipcode;
    }

}