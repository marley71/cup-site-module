<?php

namespace Modules\CupSite\Http\Controllers;

use Igaster\LaravelTheme\Facades\Theme;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Controllers\Controller;
use App\Models\CupSiteNews;
use Gecche\Foorm\Facades\Foorm;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Modules\CupSite\Models\CupSitePage;
use Modules\CupSite\Models\CupSiteSetting;


class CupSiteController extends Controller
{
    protected static $layout = null;
    protected $setting = null;
    protected $menu = null;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        Theme::set('cup_site');
        $setting = CupSiteSetting::where('default',1)->first();
        if (!$setting) {
            $setting = CupSiteSetting::first();
        }
        self::$layout = $setting->layout; // config('cup-site.layout');
        $this->setting = $setting?$setting->toArray():[];
        $this->menu = $this->_menu();
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('cupsite::index');
    }

    public function subPage($menu,$submenu) {
        $mainPage = CupSitePage::where('menu_it',$menu)->first();
        if (!$mainPage)
            abort('404','main page not found');

        switch ($mainPage->type) {
            case 'news':
                $item = CupSiteNews::where('menu_it',$submenu)->first();
                if (!$item)
                    abort(404);
                return $this->dettaglioNews($item);
            default:
                if ($submenu) {
                    $page = CupSitePage::where('menu_it',$submenu)->where('cup_site_page_id',$mainPage->getKey())->first();
                    if (!$page)
                        abort(404,'sub page not found');
                }

                $children = CupSitePage::where('cup_site_page_id',$mainPage->getKey())->get();
                $children = $children?$children->toArray():[];

                $page['children'] = $children;
                $pageType = Arr::get($page,'type',Arr::get($mainPage,'type'));
                switch ($pageType) {
                    case 'html':
                        //print_r($this->menu);
                        return view('cup_site.' . self::$layout . '.pages.html', [
                            'page' => $page,
                            'mainPage' => $mainPage,
                            'layout' => self::$layout,
                            'setting' => $this->setting,
                            'menu' => $this->menu,
                            'route_prefix' => config('cup-site.route_prefix'),
                        ]);
                }
        }

    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function page($menu=null)
    {
        $page = null;
        if (!$menu)
            $page = CupSitePage::first(); // bisogna prendere l'home
        else
            $page = CupSitePage::where('menu_it',urlencode($menu))->first();
        if (!$page)
            abort(404,'Pagina non trovata');

        $page = $page->toArray();
        //$cup_site_page_id = Arr::get($page,'id',0);
        $mainPage = CupSitePage::find($page['cup_site_page_id']);
        if ($mainPage)
            $mainPage = $mainPage->toArray();
        $children = [];
        if ($page['cup_site_page_id']) {
            $children = CupSitePage::where('cup_site_page_id',$page['cup_site_page_id'])->get();
            $children = $children?$children->toArray():[];
        }
        $page['children'] = $children;
        $pageType = Arr::get($page,'type');
        switch ($pageType) {
            case 'html':
                //print_r($this->menu);
                return view('cup_site.' . self::$layout .'.pages.html',[
                    'page'=> $page,
                    'mainPage' => $mainPage,
                    'layout' => self::$layout,
                    'setting' => $this->setting,
                    'menu' => $this->menu,
                    'route_prefix' => config('cup-site.route_prefix'),
                ]);
            case 'news':
            case 'eventi':
                $request = request()->merge([
                    's_cup_site_page_id' => "".$page['id'],
                    's_attivo' => "1",
                    'order_field' => 'data',
                    'order_direction' => 'DESC'
                ]);
                $newsForm = Foorm::getFoorm('cup_site_news.weblist',$request);
                $data = $newsForm->getFormData();
                $news = $data['data'];
                unset($data['data']);
                $pagination = $data;
                return view('cup_site.' . self::$layout .'.pages.' . $pageType,[
                    'page'=> $page,
                    'news'=> $news,
                    'pagination' => $pagination,
                    'layout' => self::$layout,
                    'mainPage' => null,
                    'setting' => $this->setting,
                    'menu' => $this->menu,
                    'route_prefix' => config('cup-site.route_prefix'),
                ]);
            case 'home':
                return $this->_home($page);
            case 'blade':
                return $this->_blade($page['menu_it']);
        }

        abort(404);
    }

    public function news($menu) {
        $item = CupSiteNews::where('menu_it',$menu)->first();
        if (!$item)
            abort(404);
        $newsForm = Foorm::getFoorm('cup_site_news.web',request(),['id' => $item['id']]);
        $pageForm = Foorm::getFoorm('cup_site_page.web',request(),['id' => $item['cup_site_page_id']]);

        $page = $pageForm->getFormData();
        $news = $newsForm->getFormData();
        //$item = $item?$item->toArray():[];
        //$page = CupSitePage::where('menu_it',$item['tag'])->first();
        //$page = $page?$page->toArray():[];
        $page['children'] = [];
//        print_r($page);
//        print_r($news);
//        die();
        return view('cup_site.' . self::$layout .'.pages.news_dettaglio',[
            'page'=> $page,
            'news'=> $news,
            'mainPage' => null,
            'layout' => self::$layout,
            'setting' => $this->setting,
            'menu' => $this->menu,
            'route_prefix' => config('cup-site.route_prefix'),
        ]);
    }

    public function eventi($menu) {
        $item = CupSiteNews::where('menu_it',$menu)->first();
        if (!$item)
            abort(404);
        $newsForm = Foorm::getFoorm('cup_site_news.web',request(),['id' => $item['id']]);
        $pageForm = Foorm::getFoorm('cup_site_page.web',request(),['id' => $item['cup_site_page_id']]);

        $page = $pageForm->getFormData();
        $news = $newsForm->getFormData();
        //$item = $item?$item->toArray():[];
        //$page = CupSitePage::where('menu_it',$item['tag'])->first();
        //$page = $page?$page->toArray():[];
        $page['children'] = [];
//        print_r($page);
//        print_r($news);
//        die();
        return view('cup_site.' . self::$layout .'.pages.eventi_dettaglio',[
            'page'=> $page,
            'news'=> $news,
            'mainPage' => null,
            'layout' => self::$layout,
            'setting' => $this->setting,
            'menu' => $this->menu,
            'route_prefix' => config('cup-site.route_prefix'),
        ]);
    }

    protected function _blade($page) {
        $data = [
            'setting' => $this->setting,
            'page' => $page,
            'menu' => $this->menu,
            'mainPage' => null,
            'route_prefix' => config('cup-site.route_prefix'),
        ];
        $methodPage = '_' .  Str::camel($page) . 'Data';
        $pageData = method_exists($this,$methodPage)?$this->$methodPage():[];
        $data = array_merge($data,$pageData);
        return view('cup_site.' . self::$layout .'.pages.'.$page,$data );
    }
    protected function _home($page) {
        return $this->_blade('home');
//        $data = [
//            'setting' => $this->setting,
//            'page' => $page,
//            'menu' => $this->menu,
//            'mainPage' => null,
//            'route_prefix' => config('cup-site.route_prefix'),
//        ];
//        $homeData = method_exists($this,'_homeData')?$this->_homeData():[];
//        $data = array_merge($data,$homeData);
//        return view('cup_site.' . self::$layout .'.pages.home',$data );
    }
    public function admin()
    {
        $this->middleware('auth');
        return view('cup_site.admin.index');
    }


    protected function _menu() {
        return CupSitePage::getPageTree();
    }

    protected function dettaglioNews($item) {

        $newsForm = Foorm::getFoorm('cup_site_news.web',request(),['id' => $item['id']]);
        $pageForm = Foorm::getFoorm('cup_site_page.web',request(),['id' => $item['cup_site_page_id']]);
        $page = $pageForm->getFormData();
        $news = $newsForm->getFormData();
        $page['children'] = [];
        return view('cup_site.' . self::$layout .'.pages.news_dettaglio',[
            'page'=> $page,
            'news'=> $news,
            'mainPage' => null,
            'layout' => self::$layout,
            'setting' => $this->setting,
            'menu' => $this->menu,
            'route_prefix' => config('cup-site.route_prefix'),
        ]);
    }
    protected function anteprimaNews() {
        $news = \request()->input();//CupSiteNews::where('menu_it',$menu)->first();
        if (!Arr::exists($news,'fotos'))
            $news['fotos'] = [];
        if (!Arr::exists($news,'videos'))
            $news['videos'] = [];
        $news['attachments'] = [];
        if (Arr::exists($news,'attachments-id')) {
            for($i=0;$i< count(Arr::get($news,'attachments-id',[]));$i++) {
                $news['attachments'][] = [
                    'id' => $news['attachments-id'][$i],
                    'nome_it' => $news['attachments-nome_it'][$i],
                    'resource' => json_decode($news['attachments-resource'][$i],true)
                ];
            }
        }
        //$news['info'] = json_decode($news['info'],true);
        $news['info'] = [
            'showmap' => Arr::get($news,'showmap',false),
            'lat' => Arr::get($news,'lat'),
            'lng' => Arr::get($news,'lng'),
            'thumb_url_type' => Arr::get($news,'thumb_url_type','auto'),
            'background_url_type' => Arr::get($news,'background_url_type','auto'),
        ];


        $pageForm = Foorm::getFoorm('cup_site_page.web',request(),['id' => $news['cup_site_page_id']]);
        $page = $pageForm->getFormData();
        $page['children'] = [];
        return view('cup_site.' . self::$layout .'.pages.news_dettaglio',[
            'page'=> $page,
            'news'=> $news,
            'mainPage' => null,
            'layout' => self::$layout,
            'setting' => $this->setting,
            'menu' => $this->menu,
            'route_prefix' => config('cup-site.route_prefix'),
        ]);
    }

    protected function anteprimaPage() {
        $page = \request()->input();//CupSiteNews::where('menu_it',$menu)->first();
        if (!Arr::exists($page,'fotos'))
            $page['fotos'] = [];
        if (!Arr::exists($page,'videos'))
            $page['videos'] = [];
        $page['attachments'] = [];
        if (Arr::exists($page,'attachments-id')) {
            for($i=0;$i< count(Arr::get($page,'attachments-id',[]));$i++) {
                $page['attachments'][] = [
                    'id' => $page['attachments-id'][$i],
                    'nome_it' => $page['attachments-nome_it'][$i],
                    'resource' => json_decode($page['attachments-resource'][$i],true)
                ];
            }
        }
        //$page['info'] = json_decode($page['info'],true);
        $page['info'] = [
            'showmap' => Arr::get($page,'showmap',false),
            'lat' => Arr::get($page,'lat'),
            'lng' => Arr::get($page,'lng'),
            'thumb_url_type' => Arr::get($page,'thumb_url_type','auto'),
            'background_url_type' => Arr::get($page,'background_url_type','auto'),
        ];


        $pageForm = Foorm::getFoorm('cup_site_page.web',request(),['id' => $page['cup_site_page_id']]);
        $pageParent = $pageForm->getFormData();
        $pageParent['children'] = [];
        return view('cup_site.' . self::$layout .'.pages.html',[
            'page'=> $pageParent,
            'page'=> $page,
            'mainPage' => null,
            'layout' => self::$layout,
            'setting' => $this->setting,
            'menu' => $this->menu,
            'route_prefix' => config('cup-site.route_prefix'),
        ]);
    }

    public static function block($type='news') {
        switch ($type) {
            case 'news':
            case 'eventi':
                $page = CupSitePage::where('type',$type)->first();
                $items = CupSiteNews::where('cup_site_page_id',$page->getKey());
                return view('cup_site.' . self::$layout .'.blocks.' . $type,['items' => $items]);
            case 'slider':
                $page = CupSitePage::first();
                $items = CupSiteNews::where('cup_site_page_id',$page->getKey())->get()->toArray();

                return view('cup_site.' . self::$layout .'.blocks.' . $type,['items' => $items]);

        }

    }

}
