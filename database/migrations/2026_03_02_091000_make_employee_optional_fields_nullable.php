<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class MakeEmployeeOptionalFieldsNullable extends Migration
{
    public function up()
    {
        DB::statement("ALTER TABLE `employees` MODIFY `gender` TINYINT NULL COMMENT '性別：0=女 1=男'");
        DB::statement("ALTER TABLE `employees` MODIFY `nationality` VARCHAR(50) NULL COMMENT '國籍'");
        DB::statement("ALTER TABLE `employees` MODIFY `id_type` TINYINT NULL COMMENT '證件類型：1=身分證 2=護照 3=居留證'");
        DB::statement("ALTER TABLE `employees` MODIFY `id_number` VARCHAR(20) NULL COMMENT '證件號碼'");
        DB::statement("ALTER TABLE `employees` MODIFY `birth_date` DATE NULL COMMENT '出生年月日'");
        DB::statement("ALTER TABLE `employees` MODIFY `phone` VARCHAR(20) NULL COMMENT '手機'");
        DB::statement("ALTER TABLE `employees` MODIFY `hired_date` DATE NULL COMMENT '到職日'");
    }

    public function down()
    {
        DB::statement("UPDATE `employees` SET `gender` = 1 WHERE `gender` IS NULL");
        DB::statement("UPDATE `employees` SET `nationality` = '' WHERE `nationality` IS NULL");
        DB::statement("UPDATE `employees` SET `id_type` = 1 WHERE `id_type` IS NULL");
        DB::statement("UPDATE `employees` SET `id_number` = CONCAT('TEMP', `id`) WHERE `id_number` IS NULL");
        DB::statement("UPDATE `employees` SET `birth_date` = '2000-01-01' WHERE `birth_date` IS NULL");
        DB::statement("UPDATE `employees` SET `phone` = '' WHERE `phone` IS NULL");
        DB::statement("UPDATE `employees` SET `hired_date` = '2000-01-01' WHERE `hired_date` IS NULL");

        DB::statement("ALTER TABLE `employees` MODIFY `gender` TINYINT NOT NULL COMMENT '性別：0=女 1=男'");
        DB::statement("ALTER TABLE `employees` MODIFY `nationality` VARCHAR(50) NOT NULL COMMENT '國籍'");
        DB::statement("ALTER TABLE `employees` MODIFY `id_type` TINYINT NOT NULL COMMENT '證件類型：1=身分證 2=護照 3=居留證'");
        DB::statement("ALTER TABLE `employees` MODIFY `id_number` VARCHAR(20) NOT NULL COMMENT '證件號碼'");
        DB::statement("ALTER TABLE `employees` MODIFY `birth_date` DATE NOT NULL COMMENT '出生年月日'");
        DB::statement("ALTER TABLE `employees` MODIFY `phone` VARCHAR(20) NOT NULL COMMENT '手機'");
        DB::statement("ALTER TABLE `employees` MODIFY `hired_date` DATE NOT NULL COMMENT '到職日'");
    }
}
