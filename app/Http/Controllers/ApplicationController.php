<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplicationStoreRequest;
use App\Http\Requests\ApplicationUpdateRequest;
use App\Models\Application;
use App\Services\ApplicationService;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param \App\Services\ApplicationService  $applicationService
     * @return void
     */
    public function __construct(ApplicationService $applicationService)
    {
        $this->authorizeResource(Application::class, 'application');

        $this->service = $applicationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = $this->service->getAll();

        return view('application.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('application.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ApplicationStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApplicationStoreRequest $request)
    {
        if ($request->isMethod('post')) {
    
            $item = $this->service->store($request->all());

            return redirect()->route('applications.show', $item);
        }

        $this->error(405001);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  Application  $application
     * @return \Illuminate\Http\Response
     */
    public function show(Application $application)
    {
        $item = $this->service->get($application);

        return view('application.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Application  $application
     * @return \Illuminate\Http\Response
     */
    public function edit(Application $application)
    {
        $item = $this->service->get($application);

        return view('application.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ApplicationUpdateRequest  $request
     * @param  Application  $application
     * @return \Illuminate\Http\Response
     */
    public function update(ApplicationUpdateRequest $request, Application $application)
    {
        if ($request->isMethod('put')) {
    
            $this->service->update($application, $request->all());

            return redirect()->route('applications.show', $application);
        }

        $this->error(405001);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Application  $application
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Application $application)
    {
        if ($request->isMethod('delete')) {

            $this->service->delete($application);

            return redirect()->route('applications.index');
        }

        $this->error(405001);

        return back();
    }
}
