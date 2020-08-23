<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Flash;
use Illuminate\Http\Request;
use VNPCMS\News\News;
use VNPCMS\News\NewsApplicationService;
use VNPCMS\News\Repository\NewsRepositoryInterface;

class NewsController extends Controller
{

    /**
     * Instance of VNPCMS\News\Repository\NewsRepositoryInterface
     *
     * @var Object
     */
    private $newsRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(NewsRepositoryInterface $newsRepository)
    {
        $this->newsRepository = $newsRepository;

        $this->middleware('auth');
        $this->middleware('permission:news_view');
    }

    /**
     * Show all menus /settings/menus
     *
     * @return View;
     **/
    public function show()
    {
        $news = $this->newsRepository->getAll();
        return view('news.index', compact('news'));
    }

    public function create()
    {
        return view('news.create');
    }


    public function delete($id)
    {
        // see if authenticated user has permission to delete users
        if (!hasPermission('news_delete', true)) return back();

        $newApplicationService = new NewsApplicationService();
        $newApplicationService->delete($id);

        Flash::success(trans('VNPCMS.messages.models.delete.success', ['modelname' => trans('VNPCMS.models.news')]));

        return back();
    }

}