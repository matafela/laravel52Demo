<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    /*struct
    CREATE TABLE IF NOT EXISTS student(
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `name` CHAR(60) NOT NULL DEFAULT '' COMMENT '姓名',
        `age` TINYINT UNSIGNED NOT NULL DEFAULT 0 COMMENT '年龄',
        `sex` TINYINT UNSIGNED NOT NULL DEFAULT 10 COMMENT '性别',
        `created_at` INT NOT NULL DEFAULT 0 COMMENT '新增时间',
        `updated_at` INT NOT NULL DEFAULT 0 COMMENT '修改时间'
    )ENGINE=INNODB DEFAULT CHARSET = UTF8 AUTO_INCREMENT=1001 COMMENT='学生表';
    */
    public function up()
    {
        //默认为Not Null否则加->nullable()
        Schema::create('student', function (Blueprint $table) {
            $table->increments('id');
            $table->char('name',60);
            $table->tinyInteger('sex')->unsigned()->default(0);
            $table->tinyInteger('age')->unsigned()->default(0);
            $table->integer('created_at')->unsigned()->default(0);
            $table->integer('updated_at')->unsigned()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('student');
    }
}
