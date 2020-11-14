<?php

namespace App\Http\Controllers;

use App\Http\Requests\DegreeStoreRequest;
use App\Http\Requests\DegreeUpdateRequest;
use App\Models\Degree;
use App\Services\DegreeService;
use Illuminate\Http\Request;

class DegreeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param \App\Services\DegreeService  $degreeService
     * @return void
     */
    public function __construct(DegreeService $degreeService)
    {
        $this->authorizeResource(Degree::class, 'degree');

        $this->service = $degreeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = $this->service->getAll();

        return view('degree.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('degree.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\DegreeStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DegreeStoreRequest $request)
    {
        if ($request->isMethod('post')) {
    
            $item = $this->service->store($request->all());

            return redirect()->route('degrees.show', $item);
        }

        $this->error(405001);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  Degree  $degree
     * @return \Illuminate\Http\Response
     */
    public function show(Degree $degree)
    {
        $item = $this->service->get($degree);

        return view('degree.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Degree  $degree
     * @return \Illuminate\Http\Response
     */
    public function edit(Degree $degree)
    {
        $item = $this->service->get($degree);

        return view('degree.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\DegreeUpdateRequest  $request
     * @param  Degree  $degree
     * @return \Illuminate\Http\Response
     */
    public function update(DegreeUpdateRequest $request, Degree $degree)
    {
        if ($request->isMethod('put')) {
    
            $this->service->update($degree, $request->all());

            return redirect()->route('degrees.show', $degree);
        }

        $this->error(405001);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Degree  $degree
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Degree $degree)
    {
        if ($request->isMethod('delete')) {

            $this->service->delete($degree);

            return redirect()->route('degrees.index');
        }

        $this->error(405001);

        return back();
    }
}
