<?php
// 代码生成时间: 2025-08-15 15:16:19
require_once 'Zend/Excel.php';

class ExcelGenerator {

    private $objPHPExcel;

    public function __construct() {
        // 创建一个新的PHPExcel对象
        $this->objPHPExcel = new PHPExcel();
    }

    /**
     * 添加标题行
     *
     * @param array $titles 标题数组
     */
    public function addTitle($titles) {
        $row = 1;
        foreach ($titles as $title) {
            $this->objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($row, 1, $title);
            $row++;
        }
    }

    /**
     * 添加数据行
     *
     * @param array $data 数据数组
     */
    public function addData($data) {
        $row = 2; // 从第二行开始添加数据
        foreach ($data as $rowData) {
            $column = 1;
            foreach ($rowData as $cellData) {
                $this->objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($column, $row, $cellData);
                $column++;
            }
            $row++;
        }
    }

    /**
     * 保存Excel文件
     *
     * @param string $filename 文件名
     */
    public function saveExcel($filename) {
        try {
            $objWriter = PHPExcel_IOFactory::createWriter($this->objPHPExcel, 'Excel2007');
            $objWriter->save($filename);
        } catch (Exception $e) {
            // 错误处理
            die('Error saving Excel file: ' . $e->getMessage());
        }
    }
}

// 使用示例
$excelGen = new ExcelGenerator();
$titles = array('名称', '数量', '价格');
$data = array(
    array('产品A', '100', '10.00'),
    array('产品B', '150', '15.00'),
    array('产品C', '200', '20.00')
);

$excelGen->addTitle($titles);
$excelGen->addData($data);
$excelGen->saveExcel('example.xlsx');
