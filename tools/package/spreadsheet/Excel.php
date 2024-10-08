<?php
declare(strict_types=1);

namespace tools\package\spreadsheet;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PHPUnit\Framework\TestCase;

// 安装 composer require phpoffice/phpspreadsheet
// 文档安装 composer require phpoffice/phpspreadsheet --prefer-source

class Excel extends TestCase
{

    // test_create 创建文件测试
    public function test_create(): void
    {

        // 创建一个sheet
        $spreadsheet = new Spreadsheet();
        // 创建一个xlsx
        $xlsx = new Xlsx($spreadsheet);
        // 保存
        $xlsx->save('hello.xlsx');


        $this->assertTrue(true);
    }

    // test_reader 加载读取文件测试
    public function test_load(): void
    {
        // 创建读取器对象
        $reader = IOFactory::createReader('Xlsx');
        // 只读取数据
        $reader->setReadDataOnly(TRUE);
        // 加载文件
        $xlsx = $reader->load('hello.xlsx');
        // 获取活动工作表
        $sheet = $xlsx->getActiveSheet();
        // 获取数据
        $sheet->getCell("A1")->getValue();


        $this->assertTrue(true);
    }

    // test_writer 写入单元格
    public function test_writer(): void
    {
        // 创建新的 Spreadsheet 对象
        $spreadSheet = new SpreadSheet();
        // 获取活动工作表
        $sheet = $spreadSheet->getActiveSheet();

        // 写入单元格
        $sheet->getCell("A1")->setValue("hello");

        // 将 Spreadsheet 保存到文件
        $xlsx = new Xlsx($spreadSheet);
        $xlsx->save('hello.xlsx');

        $this->assertTrue(true);
    }

    // test_update 修改文件
    public function test_update(): void
    {
        # 加载已存在的文件
        $spreadsheet = IOFactory::load("hello.xlsx");
        # 获取sheet
        $sheet = $spreadsheet->getActiveSheet();
        # 设置值
        $sheet->getCell("A4")->setValue("132");

        # 保存到原文件或新文件
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save("hello.xlsx");

        $this->assertTrue(true);
    }

    // test_get_all 读取所有内容
    public function test_get_all()
    {
        // 创建读取器对象
        $reader = IOFactory::createReader('Xlsx');
        // 只读取数据
        $reader->setReadDataOnly(true);

        // 加载文件
        $spreadsheet = $reader->load('hello.xlsx');
        // 获取活动工作表
        $sheet = $spreadsheet->getActiveSheet();

        // 将数据转为数组
        $data = $sheet->toArray();
        var_dump($data);

        $this->assertTrue(true);
    }


    public function test_func()
    {

        $spreadsheet = new Spreadsheet();
        // getSheetCount 获取Sheet的数量
        $_ = $spreadsheet->getSheetCount();

        // getSheetCount 获取Sheet的名字列表
        $_ = $spreadsheet->getSheetNames();

        // createSheet 创建新的sheet index为指定sheet列表的下标(可为空)
        // 返回创建的sheet对象
        $_ = $spreadsheet->createSheet(0);

        // getActiveSheetIndex 获取当前sheet对象指针下标
        $_ = $spreadsheet->getActiveSheetIndex();

        // getActiveSheetIndex 根据name切换到active
        $_ = $spreadsheet->setActiveSheetIndexByName('Worksheet 3');

        $this->assertTrue(true);
    }
}