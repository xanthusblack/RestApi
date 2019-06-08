<?php
/**
 * Created by PhpStorm.
 * User: Prudhvi Raj Maraboyena
 * Date: 05-11-2017
 * Time: 15:07
 *
 * Abstract class for the repositories defines all the generic database interactions
 *
 */

namespace Endpoint\Model\Repository;

use Endpoint\Model\Entity\AbstractEntity;

include __DIR__ . '/../../../config.php';

/**
 * Class AbstractRepository
 * @package Endpoint\Model\Repository
 */
class AbstractRepository
{
    /** @var string */
    protected $entityClassName;
    /** @var  \mysqli */
    protected $connection;
    /**
     * @var AbstractEntity
     */
    protected $entity;

    /**
     * @var array
     */
    protected $templateMap = [];

    /**
     * AbstractRepository constructor.
     */
    public function __construct()
    {
        if (!$this->connection instanceof \mysqli) {
            $this->initializeConnection();
        }
        $this->entity = new $this->entityClassName();
        $this->entity->getMetadata();
    }

    /**
     * @return array
     */
    public function findAll()
    {
        return $this->findBy();
    }

    /**
     * @param array|null $criteria
     * @param int|null $limit
     * @param int $offset
     * @return array
     */
    public function findBy(array $criteria = null, int $limit = null, int $offset = 0)
    {
        $return = [];
        $selects = $this->entity->getFields();
        $selectString = implode(', ', array_keys($selects));
        if ($criteria) {
            $whereString = $this->getWhereString($criteria);
            $query = <<<SQL
      SELECT {$selectString} FROM {$this->entity->getTable()} WHERE {$whereString} 
SQL;
        } else {
            $query = <<<SQL
      SELECT {$selectString} FROM {$this->entity->getTable()} 
SQL;
        }

        if ($limit) {
            $query .= <<<SQL
            LIMIT {$offset}, {$limit}
SQL;
        }
        $result = mysqli_query($this->connection, $query);
        if (mysqli_affected_rows($this->connection) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $return[] = $row;
            }
        } else {
            error_log(mysqli_error($this->connection));
        }
        return $return;
    }

    /**
     * @param array $criteria
     * @return array|null
     */
    public function findOneBy(array $criteria)
    {
        $return = $this->findBy($criteria, 1);
        return reset($return);
    }


    /**
     * @param array $criteria
     * @return int
     */
    public function deleteBy(array $criteria)
    {
        $criteria = $this->prepareCriteria($criteria);
        $whereString = $this->getWhereString($criteria);
        $query = <<<SQL
      DELETE FROM {$this->entity->getTable()} WHERE {$whereString} 
SQL;
        $result = mysqli_query($this->connection, $query);
        if ($result) {
            $return = 1;
        } else {
            error_log(mysqli_error($this->connection));
            $return = 0;
        }
        return $return;
    }

    /**
     * @param array $updateSet
     * @return int
     */
    public function update(array $updateSet)
    {
        $criteria = $this->prepareCriteria($updateSet);
        if (empty($criteria)) {
            return 0;
        }

        $whereString = $this->getWhereString($criteria);
        $updateString = $this->getUpdateString($updateSet);
        $query = <<<SQL
      UPDATE {$this->entity->getTable()} SET {$updateString} WHERE {$whereString} 
SQL;
        $result = mysqli_query($this->connection, $query);

        if (!$result) {
            $err = mysqli_error($this->connection);
            error_log($err);
            return 0;
        }
        return $result;
    }

    /**
     * @param array $insertSet
     * @return bool|int|\mysqli_result
     */
    public function insert(array $insertSet)
    {
        $insertSet = $this->mapColumns($insertSet);
        $insertString = $this->getInsertString($insertSet);
        $fieldString = $this->getFieldString();
        $query = <<<SQL
INSERT INTO {$this->entity->getTable()} ({$fieldString}) VALUES ({$insertString})  
SQL;
        $return = mysqli_query($this->connection, $query);
        if ($return) {
            $return = mysqli_insert_id($this->connection);
        } else {
            $err = mysqli_error($this->connection);
            error_log($err);
            return 0;
        }
        return $return;
    }

    /**
     * @param array $insertSet
     * @return string
     */
    private function getInsertString(array $insertSet)
    {
        $insertString = '';
        foreach ($insertSet as $item) {
            if (is_array($item)) {
                $insertString .= $this->getInsertString($item) . '), (';
            }
        }
        foreach ($this->entity->getFields() as $fieldname => $metadata) {
            if ($metadata['identifier']) {
                unset($insertSet[$fieldname]);
                continue;
            }
            $insertString .= (isset($insertSet[$fieldname]) ? '\'' . mysqli_real_escape_string($this->connection, $insertSet[$fieldname]) . '\'' : 'NULL') . ', ';
        }

        return rtrim($insertString, ', ');
    }

    /**
     * @return string
     */
    private function getFieldString()
    {
        $fieldString = '';
        foreach ($this->entity->getFields() as $fieldname => $metadata) {
            if (!isset($metadata['identifier']) || !($metadata['identifier'])) {
                $fieldString .= $fieldname . ', ';
            }
        }
        return rtrim($fieldString, ', ');
    }

    /**
     * @param array|null $criteria
     * @param string $separator
     * @return string
     */
    private function getWhereString(array $criteria = null, string $separator = ' AND ')
    {
        $whereString = '';
        foreach ($criteria as $col => $data) {
            $whereString .= $col . '= \'' . mysqli_real_escape_string($this->connection, $data) . '\'' . $separator;
        }
        return rtrim($whereString, $separator);
    }

    /**
     * @param array $updateSet
     * @return string
     */
    private function getUpdateString(array $updateSet)
    {
        return $this->getWhereString($updateSet, ' , ');
    }

    /**
     * @param string $className
     */
    public function setEntityClassName(string $className)
    {
        $this->entityClassName = $className;
    }

    /**
     * @return string
     * Entity name corresponding to the repository
     */
    public function getEntityClassName(): string
    {
        return $this->entityClassName;
    }

    /**
     * @throws \Exception
     */
    private function initializeConnection()
    {
        global $db;
        $this->connection = mysqli_connect($db['host'], $db['user'], $db['password'], $db['database'], $db['port']);
        if (!$this->connection instanceof \mysqli) {
            throw new \Exception('Failed to connect to Database');
        }
    }

    /**
     * @param $dataSet
     * @return array
     */
    private function prepareCriteria(&$dataSet)
    {
        $fields = $this->entity->getFields();
        $criteria = [];
        foreach ($fields as $fieldname => $metadata) {
            if ($metadata['identifier']) {
                $criteria[$fieldname] = $dataSet[$fieldname];
                unset($dataSet[$fieldname]);
            }
        }
        return $criteria;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function mapColumns($data)
    {
        foreach ($this->templateMap as $columnname => $columnDesc) {
            if (array_key_exists($columnDesc, $data)) {
                $value = $data[$columnDesc];
                unset($data[$columnDesc]);
                $data[$columnname] = $value;
            }
        }
        return $data;
    }
}