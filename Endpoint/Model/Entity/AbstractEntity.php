<?php
/**
 * Created by PhpStorm.
 * User: Prudhvi Raj Maraboyena
 * Date: 05-11-2017
 * Time: 15:09
 *
 * Abstract class for entities
 *
 */

namespace Endpoint\Model\Entity;
include_once __DIR__.'/EntityInterface.php';


/**
 * Class AbstractEntity
 * @package Endpoint\Model\Entity
 */
abstract class AbstractEntity implements EntityInterface
{
    /** @var string */
    protected $table;

    /** @var  array */
    protected $fields = [];

    /**
     * @param string $tableName
     */
    public function setTable(string $tableName)
    {
        $this->table = $tableName;
    }

    /**
     * @return string
     * Table Name corresponding to the entity
     */
    public function getTable(): string
    {
        return $this->table;
    }

    /**
     * @return array
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * @param array $fields
     */
    public function setFields(array $fields)
    {
        $this->fields = $fields;
    }

    /**
     * @param string $columnName
     * @param string $dataType
     * @param string|null $alias
     * @param bool $identifier
     */
    public function setField(string $columnName, string $dataType, string $alias = null, bool $identifier = false): void
    {
        $this->fields[$columnName] = [
            'type' => $dataType,
            'alias' => $alias,
            'identifier' => $identifier,
        ];
    }
}