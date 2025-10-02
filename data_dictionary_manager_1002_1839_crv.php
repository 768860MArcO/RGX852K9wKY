<?php
// 代码生成时间: 2025-10-02 18:39:47
// DataDictionaryManager.php
// 这个类负责管理数据字典的CRUD操作

class DataDictionaryManager {
    // 数据库连接对象
    protected $db;

    // 构造函数，注入数据库连接对象
    public function __construct($db) {
        $this->db = $db;
    }

    // 添加数据字典项
    public function addDictionaryItem($itemName, $itemValue) {
        try {
            $sql = "INSERT INTO data_dictionary (name, value) VALUES (?, ?)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$itemName, $itemValue]);
            return ['status' => 'success', 'message' => 'Data dictionary item added successfully'];
        } catch (Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    // 更新数据字典项
    public function updateDictionaryItem($itemId, $itemName, $itemValue) {
        try {
            $sql = "UPDATE data_dictionary SET name = ?, value = ? WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$itemName, $itemValue, $itemId]);
            return ['status' => 'success', 'message' => 'Data dictionary item updated successfully'];
        } catch (Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    // 删除数据字典项
    public function deleteDictionaryItem($itemId) {
        try {
            $sql = "DELETE FROM data_dictionary WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$itemId]);
            return ['status' => 'success', 'message' => 'Data dictionary item deleted successfully'];
        } catch (Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    // 获取数据字典项
    public function getDictionaryItem($itemId) {
        try {
            $sql = "SELECT * FROM data_dictionary WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$itemId]);
            $result = $stmt->fetch();
            if ($result) {
                return ['status' => 'success', 'data' => $result];
            } else {
                return ['status' => 'error', 'message' => 'Data dictionary item not found'];
            }
        } catch (Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    // 获取所有数据字典项
    public function getAllDictionaryItems() {
        try {
            $sql = "SELECT * FROM data_dictionary";
            $stmt = $this->db->query($sql);
            $results = $stmt->fetchAll();
            return ['status' => 'success', 'data' => $results];
        } catch (Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }
}

// 使用示例
// $db = new PDO('mysql:host=your_host;dbname=your_db', 'username', 'password');
// $manager = new DataDictionaryManager($db);
// $result = $manager->addDictionaryItem('new_item', 'value');
// print_r($result);
