<?php
// 代码生成时间: 2025-08-25 05:06:15
 * It follows PHP best practices and is designed to be easily maintained and extended.
 */

class XssProtection {

    /**
     * Sanitize user input to prevent XSS attacks.
     *
     * @param string $input The user input to be sanitized.
     * @return string The sanitized input.
     */
    public function sanitizeInput($input) {
        // Use htmlspecialchars to convert special characters to HTML entities
        return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Validate user input against a list of allowed tags.
     *
     * @param string $input The user input to be validated.
     * @param array $allowedTags The list of allowed HTML tags.
     * @return string The validated input or an error message.
     */
    public function validateInput($input, $allowedTags = []) {
        try {
            // Use strip_tags to remove disallowed tags and keep only the allowed ones
            $output = strip_tags($input, implode('', $allowedTags));
            if ($output !== $input) {
                // If the input has been modified, throw an exception
                throw new Exception('Invalid input detected. XSS protection in place.');
            }
            return $output;
        } catch (Exception $e) {
            // Handle the exception and return an error message
            return 'Error: ' . $e->getMessage();
        }
    }

}

// Example usage:
$xssProtection = new XssProtection();
$userInput = "<script>alert('XSS')</script>";
$sanitizedInput = $xssProtection->sanitizeInput($userInput);
$validatedInput = $xssProtection->validateInput($userInput, ['p', 'span']);

echo "Sanitized Input: " . $sanitizedInput . "
";
echo "Validated Input: " . $validatedInput . "
";
