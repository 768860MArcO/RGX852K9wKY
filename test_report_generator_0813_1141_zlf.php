<?php
// 代码生成时间: 2025-08-13 11:41:19
class TestReportGenerator {

    /**
     * Generates a test report based on the provided test results.
     *
     * @param array $testResults The array of test results.
     * @return string The generated test report.
     * @throws InvalidArgumentException If the test results are not an array.
     */
    public function generateReport(array $testResults): string {
        // Check if the test results are valid
        if (empty($testResults)) {
            throw new InvalidArgumentException('No test results provided.');
        }

        // Start the report with a header
        $report = 'Test Report
---
';

        // Iterate over the test results and add each to the report
        foreach ($testResults as $testName => $result) {
            $report .= sprintf("Test: %s
Result: %s

", $testName, $result['status']);
            if (!empty($result['message'])) {
                $report .= sprintf("Message: %s

", $result['message']);
            }
        }

        // Add a footer to the report
        $report .= '---';

        return $report;
    }
}

/**
 * Usage example:
 *
 * $testResults = [
 *     'Test1' => ['status' => 'Passed', 'message' => 'Test completed successfully.'],
 *     'Test2' => ['status' => 'Failed', 'message' => 'Test failed due to timeout.'],
 * ];
 *
 * $reportGenerator = new TestReportGenerator();
 * echo $reportGenerator->generateReport($testResults);
 */