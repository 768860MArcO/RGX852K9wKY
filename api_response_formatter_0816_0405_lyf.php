<?php
// 代码生成时间: 2025-08-16 04:05:52
class ApiResponseFormatter {
# NOTE: 重要实现细节

    /**
# 扩展功能模块
     * Format the API response data.
     *
     * @param mixed $data The data to be formatted.
     * @param int $statusCode The HTTP status code to return.
     * @param array $headers Additional headers to be sent with the response.
     * @return string The formatted JSON response.
     */
    public static function formatResponse($data, $statusCode = 200, $headers = []) {
# 增强安全性
        // Set the HTTP status code
        http_response_code($statusCode);

        // Merge default headers with additional headers
        $headers = array_merge(["Content-Type: application/json