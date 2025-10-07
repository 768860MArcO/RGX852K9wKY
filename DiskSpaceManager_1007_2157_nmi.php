<?php
// 代码生成时间: 2025-10-07 21:57:45
class DiskSpaceManager {

    private $path;

    /**
     * Constructor
     *
     * @param string $path The path to check disk space
     */
    public function __construct($path) {
        $this->path = $path;
    }

    /**
     * Get the total disk space
     *
     * @return float The total disk space in bytes
     */
    public function getTotalSpace() {
        return disk_total_space($this->path);
    }

    /**
     * Get the free disk space
     *
     * @return float The free disk space in bytes
     */
    public function getFreeSpace() {
        return disk_free_space($this->path);
    }

    /**
     * Get the used disk space
     *
     * @return float The used disk space in bytes
     */
    public function getUsedSpace() {
        return $this->getTotalSpace() - $this->getFreeSpace();
    }

    /**
     * Get the percentage of used disk space
     *
     * @return float The percentage of used disk space
     */
    public function getUsedSpacePercentage() {
        $total = $this->getTotalSpace();
        $used = $this->getUsedSpace();

        if ($total > 0) {
            return ($used / $total) * 100;
        } else {
            return 0;
        }
    }

    /**
     * Check if the disk space is sufficient for a given size
     *
     * @param float $size The size to check against
     * @return bool True if there's enough space, false otherwise
     */
    public function isSpaceAvailable($size) {
        return $this->getFreeSpace() >= $size;
    }
}

// Usage example
try {
    $diskManager = new DiskSpaceManager("/var/www");
    echo "Total Space: " . $diskManager->getTotalSpace() . " bytes
";
    echo "Free Space: " . $diskManager->getFreeSpace() . " bytes
";
    echo "Used Space: " . $diskManager->getUsedSpace() . " bytes
";
    echo "Used Space Percentage: " . $diskManager->getUsedSpacePercentage() . "%
";
    echo "Is Space Available for 100MB? " . ($diskManager->isSpaceAvailable(100 * 1024 * 1024) ? "Yes" : "No") . "
";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
