<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Services\LogService;

class LogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param \App\Services\LogService  $logService
     * @return void
     */
    public function __construct(LogService $logService)
    {
        $this->service = $logService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('list', Log::class);

        $items = $this->service->getAll();

        return view('log.index', compact('items'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Log  $log
     * @return \Illuminate\Http\Response
     */
    public function show(Log $log)
    {
        $this->authorize('view', $log);

        $item = $this->service->get($log);

        return view('log.show', compact('item'));
    }
}
