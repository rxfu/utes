<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScorepeerStoreRequest;
use App\Http\Requests\ScorepeerUpdateRequest;
use App\Models\Scorepeer;
use App\Services\ScorepeerService;
use Illuminate\Http\Request;

class ScorepeerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param \App\Services\ScorepeerService  $scorepeerService
     * @return void
     */
    public function __construct(ScorepeerService $scorepeerService)
    {
        $this->authorizeResource(Scorepeer::class, 'scorepeer');

        $this->service = $scorepeerService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = $this->service->getAll();

        return view('scorepeer.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('scorepeer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ScorepeerStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ScorepeerStoreRequest $request)
    {
        if ($request->isMethod('post')) {
    
            $item = $this->service->store($request->all());

            return redirect()->route('scorepeers.show', $item);
        }

        $this->error(405001);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  Scorepeer  $scorepeer
     * @return \Illuminate\Http\Response
     */
    public function show(Scorepeer $scorepeer)
    {
        $item = $this->service->get($scorepeer);

        return view('scorepeer.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Scorepeer  $scorepeer
     * @return \Illuminate\Http\Response
     */
    public function edit(Scorepeer $scorepeer)
    {
        $item = $this->service->get($scorepeer);

        return view('scorepeer.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ScorepeerUpdateRequest  $request
     * @param  Scorepeer  $scorepeer
     * @return \Illuminate\Http\Response
     */
    public function update(ScorepeerUpdateRequest $request, Scorepeer $scorepeer)
    {
        if ($request->isMethod('put')) {
    
            $this->service->update($scorepeer, $request->all());

            return redirect()->route('scorepeers.show', $scorepeer);
        }

        $this->error(405001);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Scorepeer  $scorepeer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Scorepeer $scorepeer)
    {
        if ($request->isMethod('delete')) {

            $this->service->delete($scorepeer);

            return redirect()->route('scorepeers.index');
        }

        $this->error(405001);

        return back();
    }
}
