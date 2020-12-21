<?php

namespace Modules\CupSite\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CupSiteDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(CupSitePageSeeder::class);
        $this->call(CupSiteSettingSeeder::class);
        // $this->call("OthersTableSeeder");
    }
}
