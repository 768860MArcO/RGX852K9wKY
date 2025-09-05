<?php
// 代码生成时间: 2025-09-05 10:52:50
class FileUnzipTool {

    /**
     * 解压ZIP文件
     *
     * @param string $zipFilePath 压缩文件路径
     * @param string $extractTo 目标解压路径
     * @return bool
     */
    public function unzip($zipFilePath, $extractTo) {
        try {
            // 检查压缩文件是否存在
            if (!file_exists($zipFilePath)) {
                throw new Exception('压缩文件不存在');
            }

            // 检查目标解压路径是否存在，如果不存在则创建
            if (!is_dir($extractTo)) {
                mkdir($extractTo, 0777, true);
            }

            // 使用ZEND框架的Zip类进行解压
            $zip = new ZipArchive();
            if ($zip->open($zipFilePath) !== true) {
                throw new Exception('无法打开压缩文件');
            }

            // 将文件解压到指定目录
            $zip->extractTo($extractTo);
            $zip->close();

            return true;
        } catch (Exception $e) {
            // 错误处理
            error_log($e->getMessage());
            return false;
        }
    }

    /**
     * 检查文件是否为压缩文件
     *
     * @param string $filePath 文件路径
     * @return bool
     */
    public function isZipFile($filePath) {
        if (!file_exists($filePath)) {
            return false;
        }

        $fileType = mime_content_type($filePath);
        return $fileType === 'application/zip';
    }
}

// 示例用法
$unzipTool = new FileUnzipTool();
$zipFilePath = 'path/to/your/zipfile.zip';
$extractTo = 'path/to/extract/directory';

if ($unzipTool->isZipFile($zipFilePath)) {
    if ($unzipTool->unzip($zipFilePath, $extractTo)) {
        echo '文件解压成功！';
    } else {
        echo '文件解压失败！';
    }
} else {
    echo '不是压缩文件！';
}
