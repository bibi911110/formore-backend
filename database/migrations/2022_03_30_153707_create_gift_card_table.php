<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Permission;

class CreateGiftCardTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gift_card', function (Blueprint $table) {
            $table->increments('id');
            $table->string('to_name');
            $table->string('to_email');
            $table->string('from_name');
            $table->string('message');
            $table->integer('voucher_id');
            $table->integer('user_id');
            $table->smallInteger('status');
            $table->timestamps();
            $table->softDeletes();
        });

        $permission = array(
            array(
                'name' => 'gift_cards-index',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s')
            ),
            array(
                'name' => 'gift_cards-create',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s')
            ),
            array(
                'name' => 'gift_cards-edit',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s')
            ),
            array(
                'name' => 'gift_cards-delete',
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
        Schema::drop('gift_card');
    }
}
