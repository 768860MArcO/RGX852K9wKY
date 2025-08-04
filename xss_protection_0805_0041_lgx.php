<?php
// 代码生成时间: 2025-08-05 00:41:42
class XssProtection {
    /**
     * Sanitize input to prevent XSS attacks.
     *
     * @param string $input The user input to be sanitized.
     * @return string Sanitized input.
     */
    public function sanitizeInput($input) {
        // Use htmlspecialchars to convert special characters to HTML entities
        return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Sanitize output to prevent XSS attacks.
     *
     * @param string $output The output to be sanitized.
     * @return string Sanitized output.
     */
    public function sanitizeOutput($output) {
        // Use htmlspecialchars to convert special characters to HTML entities
        return htmlspecialchars($output, ENT_QUOTES, 'UTF-8');
    }
}

/**
 * Usage Example
 */
try {
    $xssProtection = new XssProtection();

    // Simulate user input
    $userInput = "<script>alert('XSS')</script>";

    // Sanitize user input
    $sanitizedInput = $xssProtection->sanitizeInput($userInput);

    // Display sanitized input
    echo "Sanitized Input: " . $sanitizedInput;

    // Simulate HTML output
    $htmlOutput = "<script>alert('XSS')</script>";

    // Sanitize HTML output
    $sanitizedOutput = $xssProtection->sanitizeOutput($htmlOutput);

    // Display sanitized output
    echo "Sanitized Output: " . $sanitizedOutput;

} catch (Exception $e) {
    // Handle any errors that may occur
    echo "Error: " . $e->getMessage();
}
