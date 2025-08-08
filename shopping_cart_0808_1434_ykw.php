<?php
// 代码生成时间: 2025-08-08 14:34:11
class ShoppingCart {

    private $items = []; // Array to store cart items

    /**
     * Add an item to the cart
     *
     * @param string $id The ID of the item to add
     * @param string $name The name of the item
     * @param float $price The price of the item
     * @param int $quantity The quantity of the item to add
     * @return void
     */
    public function addItem($id, $name, $price, $quantity) {
        if (isset($this->items[$id])) {
            // If item already exists, update quantity
            $this->items[$id]['quantity'] += $quantity;
        } else {
            // Add new item to the cart
            $this->items[$id] = [
                'name' => $name,
                'price' => $price,
                'quantity' => $quantity
            ];
        }
    }

    /**
     * Remove an item from the cart
     *
     * @param string $id The ID of the item to remove
     * @return void
     */
    public function removeItem($id) {
        if (isset($this->items[$id])) {
            unset($this->items[$id]);
        } else {
            // Handle error: Item not found
            // You can throw an exception or handle it as per your requirement
        }
    }

    /**
     * Update the quantity of an item in the cart
     *
     * @param string $id The ID of the item to update
     * @param int $quantity The new quantity of the item
     * @return void
     */
    public function updateQuantity($id, $quantity) {
        if (isset($this->items[$id])) {
            $this->items[$id]['quantity'] = $quantity;
        } else {
            // Handle error: Item not found
            // You can throw an exception or handle it as per your requirement
        }
    }

    /**
     * Get the contents of the cart
     *
     * @return array The items in the cart
     */
    public function getContents() {
        return $this->items;
    }
}

// Example usage:
$cart = new ShoppingCart();
$cart->addItem('1', 'Apple', 0.50, 10);
$cart->addItem('2', 'Banana', 0.20, 5);
$cart->updateQuantity('1', 15);
$cart->removeItem('2');
$cartContents = $cart->getContents();
print_r($cartContents);

