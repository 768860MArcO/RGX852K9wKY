<?php
// 代码生成时间: 2025-08-23 10:40:37
// Autoload classes using Composer
require_once 'vendor/autoload.php';

use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\TableGateway\AbstractTableGateway;

/**
 * InventoryTable class
 *
 * This class is responsible for database interaction for inventory data.
 */
class InventoryTable extends AbstractTableGateway
{
    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
        $this->table = 'inventory';
    }

    /**
     * Fetch all inventory items
     *
     * @return array
     */
    public function fetchAll()
    {
        $resultSet = $this->select();
        return $resultSet->toArray();
    }

    /**
     * Fetch a single inventory item
     *
     * @param int $id
     * @return array
     */
    public function getItem($id)
    {
        $resultSet = $this->select(['id = ?' => $id]);
        return $resultSet->current();
    }

    /**
     * Add a new inventory item
     *
     * @param array $data
     * @return int
     */
    public function addItem($data)
    {
        $this->insert($data);
        return $this->getAdapter()->getDriver()->getLastGeneratedValue();
    }

    /**
     * Update an existing inventory item
     *
     * @param array $data
     * @param int $id
     * @return int
     */
    public function updateItem($data, $id)
    {
        $this->update($data, ['id = ?' => $id]);
        return $this->getAffectedRows();
    }

    /**
     * Delete an inventory item
     *
     * @param int $id
     * @return int
     */
    public function deleteItem($id)
    {
        $this->delete(['id = ?' => $id]);
        return $this->getAffectedRows();
    }
}

// Configuration for database adapter
$dbConfig = [
    'driver' => 'Pdo',
    'dsn' => 'mysql:dbname=inventory;host=localhost',
    'username' => 'root',
    'password' => '',
    'db' => 'inventory',
];

// Create the database adapter
$dbAdapter = new Adapter($dbConfig);

// Create the InventoryTable object
$inventoryTable = new InventoryTable($dbAdapter);

// Example usage
try {
    // Fetch all items
    $items = $inventoryTable->fetchAll();
    print_r($items);

    // Fetch a single item
    $item = $inventoryTable->getItem(1);
    print_r($item);

    // Add a new item
    $newItemId = $inventoryTable->addItem(['name' => 'New Item', 'quantity' => 100]);
    echo "New item added with ID: $newItemId\
";

    // Update an item
    $updateCount = $inventoryTable->updateItem(['quantity' => 150], 1);
    echo "Updated $updateCount item(s)\
";

    // Delete an item
    $deleteCount = $inventoryTable->deleteItem(1);
    echo "Deleted $deleteCount item(s)\
";
} catch (Exception $e) {
    // Error handling
    echo "Error: " . $e->getMessage();
}