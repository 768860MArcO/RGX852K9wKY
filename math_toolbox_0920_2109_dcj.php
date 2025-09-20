<?php
// 代码生成时间: 2025-09-20 21:09:57
class MathToolbox {

    /**
     * Add two numbers.
     *
     * @param float $a
     * @param float $b
     * @return float
     */
    public function add($a, $b) {
        return $a + $b;
    }

    /**
     * Subtract two numbers.
     *
     * @param float $a
     * @param float $b
     * @return float
     */
    public function subtract($a, $b) {
        return $a - $b;
    }

    /**
     * Multiply two numbers.
     *
     * @param float $a
     * @param float $b
     * @return float
     */
    public function multiply($a, $b) {
        return $a * $b;
    }

    /**
     * Divide two numbers.
     *
     * @param float $a
     * @param float $b
     * @return float
     */
    public function divide($a, $b) {
        if ($b == 0) {
            throw new InvalidArgumentException('Cannot divide by zero');
        }
        return $a / $b;
    }

    /**
     * Calculate the power of a number.
     *
     * @param float $base
     * @param int $exponent
     * @return float
     */
    public function power($base, $exponent) {
        return pow($base, $exponent);
    }

    /**
     * Calculate the square root of a number.
     *
     * @param float $number
     * @return float
     */
    public function squareRoot($number) {
        if ($number < 0) {
            throw new InvalidArgumentException('Cannot calculate square root of a negative number');
        }
        return sqrt($number);
    }

    // Additional mathematical functions can be added here as needed.

}

// Usage example:
$mathToolbox = new MathToolbox();
try {
    echo 'Addition: ' . $mathToolbox->add(10, 5) . '
';
    echo 'Subtraction: ' . $mathToolbox->subtract(10, 5) . '
';
    echo 'Multiplication: ' . $mathToolbox->multiply(10, 5) . '
';
    echo 'Division: ' . $mathToolbox->divide(10, 5) . '
';
    echo 'Power: ' . $mathToolbox->power(2, 3) . '
';
    echo 'Square Root: ' . $mathToolbox->squareRoot(9) . '
';
} catch (InvalidArgumentException $e) {
    echo 'Error: ' . $e->getMessage() . '
';
}
