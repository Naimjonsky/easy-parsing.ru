<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class LogController extends Controller
{
    private $perPage = 10;
    private $pageTitle = 'Логи';

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /** @var Builder|Log $logs */
        $logs = Log::orderBy('created_at', 'DESC');

        // search by query
        $searchQuery = $request->input('q');
        if ($searchQuery) {
            $logs->where('request_method', 'LIKE', "%$searchQuery%");
            $logs->orWhere('request_url', 'LIKE', "%$searchQuery%");
            $logs->orWhere('response_http_code', 'LIKE', "%$searchQuery%");
            $logs->orWhere('response_body', 'LIKE', "%$searchQuery%");
        }

        $logs = $logs->paginate($this->perPage)->appends(request()->query());

        return view('pages.logs.logs', [
            'logs' => $logs,
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function show(Log $log)
    {
        return view('pages.logs.log', [
            'log' => $log,
            'title' => $this->pageTitle,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function edit(Log $log)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Log $log)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function destroy(Log $log)
    {
        //
    }
}
