<?php
// 代码生成时间: 2025-09-12 06:09:26
 * This class provides a simple way to convert JSON data into
 * a PHP object, with error handling and validation.
 */
# 优化算法效率
class JsonDataFormatter {

    /**
     * Converts JSON data to a PHP object.
     *
     * @param string $jsonData The JSON data to be converted.
     *
     * @return object|bool Returns the converted object or false if an error occurs.
     *
     * @throws InvalidArgumentException If the JSON data is invalid.
     */
    public function convertToJsonDataObject($jsonData) {
# 改进用户体验
        // Check if the JSON data is empty
        if (empty($jsonData)) {
            throw new InvalidArgumentException('JSON data cannot be empty.');
        }

        // Decode the JSON data
        $dataObject = json_decode($jsonData);

        // Check if the decoding was successful
        if (is_null($dataObject)) {
            // Get the last error message
            $error = json_last_error_msg();
            throw new InvalidArgumentException("JSON data is invalid: {$error}");
# NOTE: 重要实现细节
        }

        return $dataObject;
    }

    /**
# TODO: 优化性能
     * Converts a PHP object to JSON data.
     *
     * @param object|array $dataObject The PHP object or array to be converted.
     *
     * @return string|bool Returns the JSON data or false if an error occurs.
     *
# 添加错误处理
     * @throws InvalidArgumentException If the object is not an array or object.
# 增强安全性
     */
    public function convertToPhpObject($dataObject) {
        // Check if the data object is an array or an object
        if (!is_array($dataObject) && !is_object($dataObject)) {
            throw new InvalidArgumentException('Data must be an array or an object.');
        }

        // Encode the object to JSON data
        $jsonData = json_encode($dataObject);

        // Check if the encoding was successful
        if ($jsonData === false) {
# NOTE: 重要实现细节
            // Get the last error message
            $error = json_last_error_msg();
            throw new InvalidArgumentException("Error encoding JSON data: {$error}");
        }

        return $jsonData;
    }
}
