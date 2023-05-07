<?php

use Illuminate\Database\Seeder;
use App\TridentInfowayManagementModel;

class TridentInfowayManagementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$TridentInfowayManagementModel = TridentInfowayManagementModel::where('id',1)->first();
		if ($TridentInfowayManagementModel) {
	    	TridentInfowayManagementModel::where('id',1)->update([
	    		'username' => md5('Tridient#2020'),
	    		'password' => md5('Tridient#2020')
	    	]);
		}else{
			TridentInfowayManagementModel::create([
	    		'username' => md5('Tridient#2020'),
	    		'password' => md5('Tridient#2020')
	    	]);
		}
    }
}
