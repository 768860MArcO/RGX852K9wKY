<?php
// 代码生成时间: 2025-08-30 14:55:01
class JsonConverter {

    /**
     * 解析JSON字符串为PHP数组
     *
     * @param string $json JSON字符串
     * @return array 解析后的PHP数组
     * @throws InvalidArgumentException 如果JSON字符串无效
     */
    public function parseJson($json) {
        try {
            $data = json_decode($json, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new InvalidArgumentException('Invalid JSON format.');
            }
            return $data;
        } catch (InvalidArgumentException $e) {
            // 错误处理
            error_log($e->getMessage());
            return [];
        }
    }

    /**
     * 将PHP数组格式化为JSON字符串
     *
     * @param array $array PHP数组
     * @return string 格式化后的JSON字符串
     * @throws InvalidArgumentException 如果数组格式无效
     */
    public function formatJson($array) {
        try {
            $json = json_encode($array);
            if ($json === false) {
                throw new InvalidArgumentException('Invalid array format for JSON encoding.');
            }
            return $json;
        } catch (InvalidArgumentException $e) {
            // 错误处理
            error_log($e->getMessage());
            return '{}';
        }
    }
}

// 示例用法
$converter = new JsonConverter();

// 解析JSON字符串
$jsonString = '{"name":"John", "age":30}';
$parsedArray = $converter->parseJson($jsonString);
print_r($parsedArray);

// 格式化PHP数组为JSON
$array = ['name' => 'Jane', 'age' => 25];
$formattedJson = $converter->formatJson($array);
echo $formattedJson;
