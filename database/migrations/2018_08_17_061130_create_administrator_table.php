<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdministratorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('administrator', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',10)->default('')->comment('名称');
            $table->string('email',50)->default('')->comment('邮箱');
            $table->string('phone',11)->default('')->comment('手机号');
            $table->string('password',100)->comment('密码');
            $table->string('work_number',10)->default('')->comment('工号');
            $table->string('avatr',100)->default('')->comment('头像');
            $table->integer('login_count')->default(0)->comment('登录次数');
            $table->string('create_ip',20)->default('')->comment('注册ip');
            $table->string('last_login_ip',20)->default('')->comment('最后登录IP');
            $table->tinyInteger('status')->index()->default(1)->comment('状态: 1=>正常, 2=>禁止');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('administrator');
    }
}
