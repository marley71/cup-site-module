<?php
namespace Modules\CupSite\Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use App\Models\CupSiteSetting;

class CupSiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        CupSiteSetting::create([
           'titolo_it' => 'settings1',
           'logo' => '/images/default_image.png'
        ]);
        CupSiteSetting::create([
            'titolo_it' => 'settings2',
        ]);
    }
}
