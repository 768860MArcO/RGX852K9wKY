<?php
// 代码生成时间: 2025-09-11 05:05:51
 * It includes error handling and documentation for clarity and maintainability.
 *
 * @author Your Name
 * @version 1.0
 */

namespace Application\Service;

use Zend\File\Filesystem;
use Zend\File\Exception;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use InvalidArgumentException;

class BulkFileRenamer 
{
    /**
     * @var string $sourceDirectory The directory containing files to rename.
     */
    protected $sourceDirectory;

    /**
     * @var string $prefix Prefix to add to file names.
     */
    protected $prefix;

    /**
     * @var string $datePrefix Optional date prefix.
     */
    protected $datePrefix;

    public function __construct($sourceDirectory, $prefix, $datePrefix = null)
    {
        $this->setSourceDirectory($sourceDirectory);
        $this->setPrefix($prefix);
        $this->datePrefix = $datePrefix;
    }

    /**
     * Set the source directory.
     *
     * @param string $sourceDirectory
     * @return self
     * @throws InvalidArgumentException If the directory does not exist.
     */
    public function setSourceDirectory($sourceDirectory)
    {
        if (!is_dir($sourceDirectory)) {
            throw new InvalidArgumentException("Source directory does not exist: {$sourceDirectory}");
        }

        $this->sourceDirectory = $sourceDirectory;
        return $this;
    }

    /**
     * Set the prefix for file names.
     *
     * @param string $prefix
     * @return self
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
        return $this;
    }

    /**
     * Start the file renaming process.
     *
     * @return void
     */
    public function renameFiles()
    {
        $filesystem = new Filesystem($this->sourceDirectory);
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($this->sourceDirectory, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $name => $file) {
            if ($file->isFile()) {
                $newName = $this->generateNewName($file->getFilename());
                try {
                    $filesystem->rename($file->getPathname(), $newName);
                } catch (Exception\FileException $e) {
                    // Handle error during file renaming
                    echo "Error renaming file {$file->getPathname()}: " . $e->getMessage() . "
";
                }
            }
        }
    }

    /**
     * Generate a new file name with the prefix and optional date prefix.
     *
     * @param string $originalName Original file name.
     * @return string New file name.
     */
    protected function generateNewName($originalName)
    {
        $extension = pathinfo($originalName, PATHINFO_EXTENSION);
        $newName = $this->prefix . ($this->datePrefix ? $this->datePrefix . '-' : '') . $originalName;
        return $newName . ($extension ? '.' . $extension : '');
    }
}

// Example usage:
try {
    $renamer = new BulkFileRenamer('/path/to/directory', 'new-');
    $renamer->renameFiles();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "
";
}
