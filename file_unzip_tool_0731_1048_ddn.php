<?php
// 代码生成时间: 2025-07-31 10:48:21
// File: file_unzip_tool.php
// Description: A utility class for unzipping compressed files using PHP and Zend Framework

/**
 * UnzipUtility class provides functionality to unzip compressed files.
 */
class UnzipUtility {

    /**
     * Unzips a compressed file to a specified directory.
     *
     * @param string $zipFilePath Path to the zip file.
     * @param string $destinationPath Path where to extract the files.
     * @return bool Returns true on success, false on failure.
     * @throws Exception If an error occurs during unzipping.
     */
    public function unzip($zipFilePath, $destinationPath) {
        // Check if the zip file exists
        if (!file_exists($zipFilePath)) {
            throw new Exception('The zip file does not exist.');
        }

        // Create the destination directory if it doesn't exist
        if (!is_dir($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        // Initialize archive extraction
        $zip = new ZipArchive();
        $result = $zip->open($zipFilePath);

        if ($result === true) {
            // Extract to the specified directory
            $zip->extractTo($destinationPath);
            // Close the zip file
            $zip->close();
            return true;
        } else {
            // Handle the error
            throw new Exception('Failed to open the zip file for extraction.');
        }
    }
}

// Usage example:
try {
    $unzipUtility = new UnzipUtility();
    $zipFilePath = 'path/to/your/file.zip';
    $destinationPath = 'path/to/extract/directory';

    if ($unzipUtility->unzip($zipFilePath, $destinationPath)) {
        echo 'File extracted successfully.';
    } else {
        echo 'Failed to extract the file.';
    }
} catch (Exception $e) {
    // Handle exceptions
    echo 'Error: ' . $e->getMessage();
}
