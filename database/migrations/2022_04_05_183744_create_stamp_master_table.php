<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Permission;

class CreateStampMasterTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stamp_master', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('business_id');
            $table->integer('country_id');
            $table->integer('stapm_point');
            $table->string('image_of_loyalty_card');
            $table->string('setup_level');
            $table->string('daily_limit');
            $table->string('welcome_stamp');
            $table->string('birthday_step');
            $table->string('bonus_stamp');
            $table->string('stapm_expired');
            $table->string('point_per_stamp');
            $table->integer('currency');
            $table->string('ration_of_cash_out');
            $table->text('message_eng');
            $table->text('message_italian');
            $table->text('message_greek');
            $table->text('message_albanian');
            $table->timestamps();
            $table->softDeletes();
        });

        $permission = array(
            array(
                'name' => 'stamp_masters-index',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s')
            ),
            array(
                'name' => 'stamp_masters-create',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s')
            ),
            array(
                'name' => 'stamp_masters-edit',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s')
            ),
            array(
                'name' => 'stamp_masters-delete',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s')
            )
        );

        Permission::insert($permission);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('stamp_master');
    }
}
