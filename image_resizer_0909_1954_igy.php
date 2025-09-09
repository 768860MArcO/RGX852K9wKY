<?php
// 代码生成时间: 2025-09-09 19:54:11
 * It follows best practices for code quality and maintainability.
 *
 * @author  Your Name
 * @version 1.0
 */
class ImageResizer
{
    /**
     * @var string The path to the directory where images are stored.
     */
    private $sourceDir;
    
    /**
     * @var string The path to the directory where resized images will be stored.
     */
    private $destinationDir;
    
    /**
     * @var int The width to which the images should be resized.
     */
    private $width;
    
    /**
     * @var int The height to which the images should be resized.
     */
    private $height;
    
    /**
     * Constructor to initialize the directories and dimensions.
     *
     * @param string $sourceDir The source directory path.
     * @param string $destinationDir The destination directory path.
     * @param int $width The target width.
     * @param int $height The target height.
     */
    public function __construct($sourceDir, $destinationDir, $width, $height)
    {
        $this->sourceDir = $sourceDir;
        $this->destinationDir = $destinationDir;
        $this->width = $width;
        $this->height = $height;
    }
    
    /**
     * Resizes all images in the source directory to the specified dimensions.
     *
     * @return void
     */
    public function resizeImages()
    {
        if (!is_dir($this->sourceDir) || !is_dir($this->destinationDir)) {
            throw new Exception('Source or destination directory does not exist.');
        }
        
        $files = scandir($this->sourceDir);
        foreach ($files as $file) {
            if ($file != '.' && $file != '..') {
                $this->resizeImage($this->sourceDir . '/' . $file, $this->destinationDir . '/' . $file);
            }
        }
    }
    
    /**
     * Resizes a single image.
     *
     * @param string $sourcePath The path to the source image.
     * @param string $destinationPath The path to save the resized image.
     * @return void
     */
    private function resizeImage($sourcePath, $destinationPath)
    {
        $imageInfo = getimagesize($sourcePath);
        $mime = $imageInfo['mime'];
        
        switch ($mime) {
            case 'image/jpeg':
                $image = imagecreatefromjpeg($sourcePath);
                break;
            case 'image/png':
                $image = imagecreatefrompng($sourcePath);
                break;
            case 'image/gif':
                $image = imagecreatefromgif($sourcePath);
                break;
            default:
                throw new Exception('Unsupported image format.');
        }
        
        $resizedImage = imagecreatetruecolor($this->width, $this->height);
        imagecopyresampled($resizedImage, $image, 0, 0, 0, 0, $this->width, $this->height, $imageInfo[0], $imageInfo[1]);
        
        switch ($mime) {
            case 'image/jpeg':
                imagejpeg($resizedImage, $destinationPath, 90);
                break;
            case 'image/png':
                imagepng($resizedImage, $destinationPath);
                break;
            case 'image/gif':
                imagegif($resizedImage, $destinationPath);
                break;
        }
        
        imagedestroy($image);
        imagedestroy($resizedImage);
    }
}

// Example usage:
try {
    $sourceDir = "/path/to/source/directory";
    $destinationDir = "/path/to/destination/directory";
    $width = 800;
    $height = 600;
    
    $resizer = new ImageResizer($sourceDir, $destinationDir, $width, $height);
    $resizer->resizeImages();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
