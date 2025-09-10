<?php
// 代码生成时间: 2025-09-10 20:44:20
require 'Zend/Loader/AutoloaderFactory.php';
require 'Zend/Application.php';

use Zend\Loader\AutoloaderFactory;
use Zend\Application;

// Setup autoloading
$autoloader = AutoloaderFactory::factory(array(
    'Zend\Loader\StandardAutoloader' => array(
        'autoregister_zf' => true,
        'namespaces' => array(
            'Inventory' => __DIR__ . '/library/'
        )
    )
));

// Create application, bootstrap, and run
$application = new Application(APPLICATION_ENV);
$application->bootstrap()
            ->run();

// Define the Inventory namespace and its classes
namespace Inventory;

// Inventory Item class
class Item {
    private $id;
    private $name;
    private $quantity;
    private $price;

    // Constructor
    public function __construct($id, $name, $quantity, $price) {
        $this->id = $id;
        $this->name = $name;
        $this->quantity = $quantity;
        $this->price = $price;
    }

    // Getters and Setters
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    public function getPrice() {
        return $this->price;
    }

    // Method to display item details
    public function display() {
        echo "Item ID: " . $this->id . "\
";
        echo "Item Name: " . $this->name . "\
";
        echo "Quantity: " . $this->quantity . "\
";
        echo "Price: $" . $this->price . "\
";
    }
}

// Inventory Management class
class InventoryManagement {
    private $items = array();

    // Add an item to the inventory
    public function addItem(Item $item) {
        $this->items[$item->getId()] = $item;
    }

    // Remove an item from the inventory
    public function removeItem($id) {
        if (isset($this->items[$id])) {
            unset($this->items[$id]);
        } else {
            throw new \Exception("Item with ID $id not found in inventory.");
        }
    }

    // Update an existing item's quantity
    public function updateQuantity($id, $quantity) {
        if (isset($this->items[$id])) {
            $this->items[$id]->setQuantity($quantity);
        } else {
            throw new \Exception("Item with ID $id not found in inventory.");
        }
    }

    // Display all items in the inventory
    public function displayInventory() {
        foreach ($this->items as $item) {
            $item->display();
        }
    }
}

// Example usage
try {
    $inventory = new InventoryManagement();
    $item1 = new Item(1, "Laptop", 10, 999.99);
    $item2 = new Item(2, "Smartphone", 20, 499.99);

    $inventory->addItem($item1);
    $inventory->addItem($item2);

    $inventory->displayInventory();

    $inventory->updateQuantity(1, 5);
    $inventory->removeItem(2);

    $inventory->displayInventory();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
