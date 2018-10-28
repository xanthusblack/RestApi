<?php
/**
 * Created by PhpStorm.
 * User: Prudhvi Raj Maraboyena
 * Date: 05-11-2017
 * Time: 15:05
 *
 * Client entity class that defines the column names and types in the Client table
 *
 */

namespace Endpoint\Model\Entity;


/**
 * Class Client
 * @package Endpoint\Model\Entity
 */
class Client extends AbstractEntity
{
    /** @var int */
    protected $clientcode;
    /** @var string */
    protected $clientname;
    /** @var string */
    protected $address = '';
    /** @var int */
    protected $zipcode = 0;
    /** @var float */
    protected $revenue = 0.00;
    /** @var int */
    protected $clientTier = 0;

    /**
     * @return void
     */
    public function getMetadata()
    {
        $this->setTable('client');
        $this->setField('clientcode', 'int', null, true);
        $this->setField('clientname', 'string');
        $this->setField('address', 'string');
        $this->setField('zipcode', 'string');
        $this->setField('revenue', 'string');
        $this->setField('clienttier', 'string', 'clientTier');
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
     * @return Client
     */
    public function setClientcode(int $clientcode): Client
    {
        $this->clientcode = $clientcode;
        return $this;
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
     * @return Client
     */
    public function setClientname(string $clientname): Client
    {
        $this->clientname = $clientname;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return Client
     */
    public function setAddress(string $address): Client
    {
        $this->address = $address;
        return $this;
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
     * @return Client
     */
    public function setZipcode(int $zipcode): Client
    {
        $this->zipcode = $zipcode;
        return $this;
    }

    /**
     * @return float
     */
    public function getRevenue(): float
    {
        return $this->revenue;
    }

    /**
     * @param float $revenue
     * @return Client
     */
    public function setRevenue(float $revenue): Client
    {
        $this->revenue = $revenue;
        return $this;
    }

    /**
     * @return int
     */
    public function getClientTier(): int
    {
        return $this->clientTier;
    }

    /**
     * @param int $clientTier
     * @return Client
     */
    public function setClientTier(int $clientTier): Client
    {
        $this->clientTier = $clientTier;
        return $this;
    }

}