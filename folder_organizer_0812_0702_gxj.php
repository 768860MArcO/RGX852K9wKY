<?php
// 代码生成时间: 2025-08-12 07:02:42
class FolderOrganizer {

    private $sourceDirectory;
    private $targetDirectory;

    /**
     * Constructor
     *
     * @param string $sourceDirectory The path to the source directory to be organized.
     * @param string $targetDirectory The path to the target directory where the organized files will be moved.
     */
    public function __construct($sourceDirectory, $targetDirectory) {
        $this->sourceDirectory = $sourceDirectory;
        $this->targetDirectory = $targetDirectory;
    }

    /**
     * Organize the folder structure.
     *
     * This method checks the source directory, sorts the files and folders,
     * and moves them to the target directory.
     *
     * @throws Exception If there is an issue with the directory paths.
     */
    public function organize() {
        if (!is_dir($this->sourceDirectory)) {
            throw new Exception("Source directory does not exist.");
        }

        if (!is_dir($this->targetDirectory)) {
            if (!mkdir($this->targetDirectory, 0777, true)) {
                throw new Exception("Failed to create target directory.");
            }
        }

        // Get all files and folders in the source directory
        $items = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($this->sourceDirectory),
            RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($items as $item) {
            $targetPath = $this->targetDirectory . '/' . $item->getSubPathName();

            if ($item->isDir()) {
                // If it's a directory, create it in the target directory
                if (!is_dir($targetPath)) {
                    mkdir($targetPath, 0777, true);
                }
            } else {
                // If it's a file, move it to the target directory
                if (file_exists($targetPath)) {
                    // Handle duplicates if needed
                    $this->handleDuplicate($targetPath);
                } else {
                    if (!rename($item->getPathname(), $targetPath)) {
                        throw new Exception("Failed to move file: " . $item->getPathname());
                    }
                }
            }
        }
    }

    /**
     * Handle duplicate files.
     *
     * This method is called when a duplicate file is encountered.
     * The default behavior is to rename the file by adding a number to the end.
     *
     * @param string $targetPath The path to the duplicate file.
     */
    private function handleDuplicate($targetPath) {
        $originalPath = $targetPath;
        $counter = 1;

        while (file_exists($targetPath)) {
            $targetPath = dirname($originalPath) . '/' . pathinfo($originalPath, PATHINFO_FILENAME) . "_" . $counter . '.' . pathinfo($originalPath, PATHINFO_EXTENSION);
            $counter++;
        }

        rename($originalPath, $targetPath);
    }
}

// Usage example:
try {
    $organizer = new FolderOrganizer('/path/to/source', '/path/to/target');
    $organizer->organize();
    echo "Folder structure organized successfully.
";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "
";
}
