<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SupperMenus;
use VNPCMS\Flasher\Facades\Flash;
use Illuminate\Http\Request;
use VNPCMS\Article\Repository\ArticlesRepositoryInterface;
use VNPCMS\Article\ArticlesApplicationService;
use VNPCMS\Article\Articles;
use VNPCMS\Catearticle\Repository\CateArticlesRepositoryInterface;
use Illuminate\Support\Facades\App;
use App\Utils\FileUtils;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;
use App\Models\Join;
use App\Models\Linktype;
use VNPCMS\Catearticle\CateArticles;
use App\Models\Join_mode;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;


class ArticlesController extends Controller {

    /**
     * Instance of VNPCMS\News\Repository\NewsRepositoryInterface
     *
     * @var Object
     */
    private $articlesRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ArticlesRepositoryInterface $articlesRepository) {
        $this->articlesRepository = $articlesRepository;

        $this->middleware('auth');
        $this->middleware('permission:info_management');
    }

    /**

     *
     * @return View;
     * */
    public function show(Request $request) {
        $group = $request->group;
        $content = Linktype::where('code',$group)->first();
        $cates = App::make(CateArticlesRepositoryInterface::class);
        $cates = $cates->getData($group);
        $type = Linktype::where('code', $group)->first();
        $articles = $this->articlesRepository->getByGroup($group);

        return view('articles.index', compact('articles', 'group', 'cates', 'type','content'));
    }

    public function seach(Request $request) {
        $group = $request->group;

        $text = $request->get('nameseach');
        $categories = CateArticles::find($request->get('categories'));

        $cates = App::make(CateArticlesRepositoryInterface::class);
        $cates = $cates->getData($group);
        $type = Linktype::where('code', $group)->first();

        $articles = $this->articlesRepository->getBySeach($group, $categories, $text);

        return view('articles.index', compact('articles', 'group', 'cates', 'type'));
    }

    public function create(Request $request) {
        $group = $request->group;
        $content = Linktype::where('code',$group)->first();
        $cates = App::make(CateArticlesRepositoryInterface::class);
        $cates = $cates->getData($group);
        $modes = CateArticles::where('group', 'mode')->get();
        $type = Linktype::where('code', $group)->first();
        return view('articles.create', compact('group', 'cates', 'modes','content','type'));
    }

    public function postcreate(Request $request) {
        $group = $request->group;
        $articles = $request->all();
        $articles['group'] = $group;

        $linktype = Linktype::where('code', $request->group)->first();
        /*  $slug = $linktype->vn.'/'.Str::slug(Input::get('name')).'.html'; */
        $slug = Str::slug(Input::get('name')) . '.html';
        $lang = getCurrentSessionAppLocale();
        if ($lang != 'vn') {
            /* $slug = $linktype->en.'/'.Str::slug(Input::get('name')).'.html'; Link cũ có cả danh mục */
            $slug = Str::slug(Input::get('name')) . '.html';
        }
        $articles['slug'] = $slug;

        $null = $this->articlesRepository->ArticleNull($request->name);

        if ($null == false) {
            return redirect()->back()->withErrors('Bài viết đã tồn tại!');
        }

        $articles['images'] = null;


        $articles['cate_id'] = $request->categories;
        if ($request->categories == null) {
            return redirect()->back()->withErrors('Bạn chưa lựa chọn danh mục bài viết!');
        }

        $articles['locale'] = getCurrentSessionAppLocale();
        $newarticle = $this->articlesRepository->create($articles);

        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $name = Str::slug(Input::get('name')) . '.' . $file->getClientOriginalExtension();
            $path = 'articles/' . $group.'/'.$newarticle->id.'/' . $name;
            $newarticle->images= $name;
            $newarticle->save();
            FileUtils::save_images($path, $file, 300, null);
        }

        if ($request->hasFile('input-files')){
            $files = $request->file('input-files');
            foreach($files as $file){
                $name = $file->getClientOriginalName();
                $path = 'articles/'.$group.'/'.$newarticle->id;
                FileUtils::save_files($path);
                $destinationPath = public_path() .'/files/'.$path.'/';
                $file->move($destinationPath, $name);
            }
        }

        return redirect('admin/articles/' . $group)->with('status', 'Bạn đã tạo bài viết thành công');
    }

    public function edit(Request $request) {
        $group = $request->group;
        $content = Linktype::where('code',$group)->first();
        $article = $this->articlesRepository->ById($request->id);
        $path ='articles/'.$article->group.'/'.$article->id;
        $files_images = Storage::disk('files')->files($path);
        $category = App::make(CateArticlesRepositoryInterface::class);
        $category = $category->getData($group);
        $type = Linktype::where('code', $group)->first();
        return view('articles.edit', compact('article', 'category', 'group','files_images','content','type'));
    }

    public function postupdate(Request $request) {
        $group = $request->group;
        $articles = $request->all();
        $articles['group'] = $group;
        ini_set('max_execution_time',360);
        ini_set('max_input_time',300);
        $linktype = Linktype::where('code', $request->group)->first();
        /*  $slug = $linktype->vn.'/'.Str::slug(Input::get('name')).'.html'; */
        $slug = Str::slug(Input::get('name')) . '.html';
        $lang = getCurrentSessionAppLocale();
        if ($lang != 'vn') {
            /*  $slug = $linktype->en.'/'.Str::slug(Input::get('name')).'.html'; */
            $slug = Str::slug(Input::get('name')) . '.html';
        }
        $articles['slug'] = $slug;


        $null = $this->articlesRepository->ArticleNullUpdate($request->name, $request->id);

        if ($null == false) {
            return redirect()->back()->withErrors('Bài viết đã tồn tại!');
        }

        /*  if(!isset($articles['categories']))
          {
          return redirect()->back()->withErrors('Bạn chưa chọn danh mục bài viết!');
          } */

        $article = $this->articlesRepository->ById($request->id);

        $articles['images'] = $article->images;


        $articles['cate_id'] = $request->categories;


        /* Đổi tên thư mực chưa ảnh khi đổi tên bài viết */
        if (Str::slug($article->name) != Str::slug(Input::get('name'))) {
            $oldpath = public_path() . '/images/articles/' . $group . '/' . Str::slug($article->name);
            $newpath = public_path() . '/images/articles/' . $group . '/' . Str::slug(Input::get('name'));
            if (!is_dir($oldpath)) {
                mkdir($newpath);
            } else {
                rename($oldpath, $newpath);
            }
        }

        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $name = Str::slug(Input::get('name')) . '.' . $file->getClientOriginalExtension();
            $path = 'articles/' . $group . '/' .$article->id. '/' . $name;
            $articles['images'] = $name;
            if ($article->images != null) {
                $foderpath = public_path() . '/images/articles/' . $group . '/' . $article->id . '/' . $article->images;
                File::delete($foderpath);
            }
            FileUtils::save_images($path, $file, 300, null);
        }

        if ($request->hasFile('input-files')){
            $files = $request->file('input-files');
            foreach($files as $file){
                $name = $file->getClientOriginalName();
                $path = 'articles/'.$group.'/'.$article->id;
                FileUtils::save_files($path);
                $destinationPath = public_path() .'/files/'.$path.'/';
                $file->move($destinationPath, $name);
            }
        }
        $this->articlesRepository->update($article, $articles);

        $article = $this->articlesRepository->ById($request->id);
        /* Cập nhật link menu khi đổi thay đổi thư mục */
        $menu = SupperMenus::where('url', $request->id)->first();
        if ($menu != null) {
            $menu->link = $article->slug;
            $menu->save();
        }
        return redirect()->back();
    }
    public function delete($id){
        // see if authenticated user has permission to delete users
        if (!hasPermission('info_management', true))
            return back();
        $article = Articles::find($id);
        $aAricles = Articles::find($id);
        $count = $this->hasmenus($id,$aAricles->group);
        if($count!=0){
            return Redirect::back()->with('flash_message', 'Không thể xóa bài viết do tồn tại Menus trỏ tới bài viết!');
        }

        $articleApplicationService = new ArticlesApplicationService();
        $articleApplicationService->delete($id);
        // Xoa file dinh kem
        $path = public_path().'/files/articles/'.$article->group.'/'.$article->id;
        File::cleanDirectory($path);
        File::deleteDirectory($path);
        // Xoa hinh anh dai dien
        $path = public_path().'/images/articles/'.$article->group.'/'.$article->id;
        File::cleanDirectory($path);
        File::deleteDirectory($path);

        Flash::success(trans('VNPCMS.messages.models.delete.success', ['modelname' => trans('VNPCMS.models.articles')]));
        return back();
    }

    public function orders(Request $request) {
        $orders = $request->order;
        foreach ($orders as $key => $value) {
            $update = Articles::find($key);
            $update->order = $orders[$key];
            $update->save();
        }
        return redirect()->back()->with('status', 'Đã cập nhật thành công!');
    }

    public function files_delete(Request $request)
    {
        $data = Input::all();
        $path = public_path().'/files/'.$data['link'];
        File::delete($path);
        $msg = "Đã xóa file đính kèm";
        return response()->json(array('msg'=> $msg), 200);
    }

}
