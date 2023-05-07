<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Permission;

class CreateOfferBannerTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer_banner', function (Blueprint $table) {
            $table->increments('id');
            $table->string('offer_image');
            $table->timestamps();
            $table->softDeletes();
        });

        $permission = array(
            array(
                'name' => 'offer_banners-index',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s')
            ),
            array(
                'name' => 'offer_banners-create',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s')
            ),
            array(
                'name' => 'offer_banners-edit',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s')
            ),
            array(
                'name' => 'offer_banners-delete',
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
        Schema::drop('offer_banner');
    }
}
