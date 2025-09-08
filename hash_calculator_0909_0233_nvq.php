<?php
// 代码生成时间: 2025-09-09 02:33:04
 * This tool provides functionality to calculate hash values for given input strings.
 *
 * @author Your Name
 * @version 1.0
 */

class HashCalculator {

    public static function calculate($input, $algorithm = 'md5') {
        // Validate the input
        if (empty($input)) {
            throw new InvalidArgumentException('Input string cannot be empty.');
        }

        // Validate the algorithm
        if (!in_array($algorithm, hash_algos(), true)) {
            throw new InvalidArgumentException('Invalid hash algorithm provided.');
        }

        // Calculate the hash
        $hash = hash($algorithm, $input);

        // Return the hash value
        return $hash;
    }
}

// Example usage
try {
    $inputString = 'Hello, World!';
    $algorithm = 'sha256';
    $hashValue = HashCalculator::calculate($inputString, $algorithm);
    echo "The hash value is: "$hashValue"";
} catch (InvalidArgumentException $e) {
    echo "Error: " . $e->getMessage();
}
