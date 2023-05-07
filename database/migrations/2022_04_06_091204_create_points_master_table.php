<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Permission;

class CreatePointsMasterTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('points_master', function (Blueprint $table) {
            $table->increments('id');
            $table->string('schema');
            $table->integer('currency_id');
            $table->string('ratio_of_collecting_points');
            $table->string('ratio_for_cash_out');
            $table->integer('segments_id');
            $table->string('levels_based_on_scenarios');
            $table->string('birthday');
            $table->string('welcome');
            $table->string('fraud_of_points');
            $table->string('campaign');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('choose_segments');
            $table->date('expiration_date');
            $table->string('message_eng');
            $table->string('message_italian');
            $table->string('message_greek');
            $table->string('message_albanian');
            $table->timestamps();
            $table->softDeletes();
        });

        $permission = array(
            array(
                'name' => 'points_masters-index',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s')
            ),
            array(
                'name' => 'points_masters-create',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s')
            ),
            array(
                'name' => 'points_masters-edit',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s')
            ),
            array(
                'name' => 'points_masters-delete',
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
        Schema::drop('points_master');
    }
}
