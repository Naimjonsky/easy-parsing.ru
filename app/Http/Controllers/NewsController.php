<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    private $perPage = 10;
    private $pageTitle = 'Новости';

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
        /** @var Builder|News $news */
        $news = News::orderBy('published_at', 'DESC');

        // search by query
        $searchQuery = $request->input('q');
        if ($searchQuery) {
            $news->where('title', 'LIKE', "%$searchQuery%");
            $news->orWhere('description', 'LIKE', "%$searchQuery%");
            $news->orWhere('author', 'LIKE', "%$searchQuery%");
        }

        $news = $news->paginate($this->perPage)->appends(request()->query());

        return view('pages.news.news', [
            'news' => $news,
            'title' => $this->pageTitle,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\News $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\News $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\News $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\News $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        //
    }
}
