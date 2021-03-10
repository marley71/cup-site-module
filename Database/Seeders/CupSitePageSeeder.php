<?php
namespace Modules\CupSite\Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use App\Models\CupSitePage;
use App\Models\CupSiteNews;
class CupSitePageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        CupSitePage::create([
           'titolo_it' => 'Home',
            'menu_it' => 'home',
           'type' => 'home',
//           'fix' => 1,
           'content_it' => 'contenuto1'
        ]);

        $page = CupSitePage::create([
            'titolo_it' => 'news',
            'menu_it' => 'news',
            'type' => 'news',
            'content_it' => ''
        ]);
        for ($i=0;$i<10;$i++) {
            CupSiteNews::create([
                'titolo_it' => 'news' .$i,
                'menu_it' => 'news'.$i,
                'data' => date('Y-m-d',time() + $i*98000),
                'descrizione_it' => 'corpo '.$i,
                'cup_site_page_id' => $page->getKey(),
            ]);
        }

        $page = CupSitePage::create([
            'titolo_it' => 'eventi',
            'menu_it' => 'eventi',
            'type' => 'eventi',
            'content_it' => ''
        ]);
        for ($i=0;$i<10;$i++) {
            CupSiteNews::create([
                'titolo_it' => 'evento' .$i,
                'menu_it' => 'evento'.$i,
                'descrizione_it' => 'corpo evento'.$i,
                'data' => date('Y-m-d',time() + $i*98000),
                'data_fine' => date('Y-m-d',time() + ($i+3)*98000),
                'cup_site_page_id' => $page->getKey(),
            ]);
        }
        CupSitePage::create([
            'titolo_it' => "l'azienda",
            'menu_it' => 'azienda',
            'type' => 'html',
            'content_it' => 'Nata il 25 ecc.'
        ]);

        // -- pagina con sottopagine
        $page = CupSitePage::create([
            'titolo_it' => "Prodotti",
            'menu_it' => 'Prodotti',
            'type' => 'html',
            'content_it' => 'Nata il 25 ecc.'
        ]);
        CupSitePage::create([
            'titolo_it' => "Shampo",
            'menu_it' => 'Shampo',
            'type' => 'html',
            'content_it' => 'il miglior shampo',
            'cup_site_page_id' => $page->getKey()
        ]);
        CupSitePage::create([
            'titolo_it' => "Saponi",
            'menu_it' => 'Saponi',
            'type' => 'html',
            'content_it' => 'il miglior Sapone',
            'cup_site_page_id' => $page->getKey()
        ]);

        CupSitePage::create([
            'titolo_it' => "Creme",
            'menu_it' => 'Creme',
            'type' => 'html',
            'content_it' => 'la miglior Crema',
            'cup_site_page_id' => $page->getKey()
        ]);

        $page = CupSitePage::create([
            'titolo_it' => 'notizie estere',
            'menu_it' => 'notizie estere',
            'type' => 'news',
            'content_it' => ''
        ]);
        for ($i=0;$i<10;$i++) {
            CupSiteNews::create([
                'titolo_it' => 'estere' .$i,
                'menu_it' => 'estere'.$i,
                'data' => date('Y-m-d',time() + $i*98000),
                'descrizione_it' => 'corpo estere'.$i,
                'cup_site_page_id' => $page->getKey(),
            ]);
        }
    }
}
