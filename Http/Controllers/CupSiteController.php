<?php

namespace Modules\CupSite\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Controllers\Controller;
use App\Models\CupSiteNews;
use Gecche\Foorm\Facades\Foorm;
use Illuminate\Support\Arr;
use Modules\CupSite\Models\CupSitePage;
use Modules\CupSite\Models\CupSiteSetting;


class CupSiteController extends Controller
{
    protected static $layout = null;
    private $setting = null;
    private $menu = null;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $setting = CupSiteSetting::where('default',1)->first();
        self::$layout = $setting->layout; // config('cupparis-site.layout');
        if (!$setting) {
            $setting = CupSiteSetting::first();
        }
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
            $page = CupSitePage::where('menu_it',$menu)->first();
        if (!$page)
            abort(404);
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
                    'route_prefix' => config('cupparis-site.route_prefix'),
                ]);
            case 'news':
            case 'eventi':
//                $search_filters = [
//                    'search_filters' =>  [
//                        [
//                            'field' => 's_cup_site_page_id',
//                            'value' => "".$page['id'],
//                        ]
//                    ]
//                ];
                $request = request()->merge(['s_cup_site_page_id' => "".$page['id']]);

                //$request->set()
                $newsForm = Foorm::getFoorm('cup_site_news.weblist',$request);
//                $newsForm->input['search_filters'] = [
//                    [
//                        'field' => 'cup_site_page_id',
//                        'value' => $page['id'],
//                    ]
//                ];
                //$newsForm = Foorm::getFoorm('cup_site_news.weblist',request(),['cup_site_page_id' => $page['id']]);
                $data = $newsForm->getFormData()['data'];
                return view('cup_site.' . self::$layout .'.pages.' . $pageType,[
                    'page'=> $page,
                    'news'=> $data,
                    'layout' => self::$layout,
                    'mainPage' => null,
                    'setting' => $this->setting,
                    'menu' => $this->menu,
                    'route_prefix' => config('cupparis-site.route_prefix'),
                ]);

//                $newsForm = Foorm::getFoorm('cup_site_news.weblist',request());
//                return view('cup_site.' . self::$layout .'.pages.news',[
//                    'page'=> $page,
//                    'news'=> $newsForm->getFormData()['data'],
//                    'layout' => self::$layout,
//                    'setting' => $this->setting,
//                    'menu' => $this->menu,
//                    'route_prefix' => config('cupparis-site.route_prefix'),
//                ]);
            case 'home':
                return $this->_home($page);
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
            'route_prefix' => config('cupparis-site.route_prefix'),
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
            'route_prefix' => config('cupparis-site.route_prefix'),
        ]);
    }

    protected function _home($page) {
        return view('cup_site.' . self::$layout .'.pages.home', [
            'setting' => $this->setting,
            'page' => $page,
            'menu' => $this->menu,
            'mainPage' => null,
            'route_prefix' => config('cupparis-site.route_prefix'),
        ]);
    }
    public function admin()
    {
        $this->middleware('auth');
        return view('cup_site.admin.index');
    }

//    public function manage($model) {
//        return view('manage',['model' => $model]);
//    }
//
//    public function dashboard() {
//        return view('dashboard');
//    }
//    public function inline() {
//        return view('inline');
//    }
//
    protected function _menu() {
        return CupSitePage::getPageTree();
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

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('cupsite::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('cupsite::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('cupsite::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
