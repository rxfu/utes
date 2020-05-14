<?php

namespace App\Http\Controllers;

use App\Http\Requests\TitleStoreRequest;
use App\Http\Requests\TitleUpdateRequest;
use App\Models\Title;
use App\Services\TitleService;
use Illuminate\Http\Request;

class TitleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param \App\Services\TitleService  $titleService
     * @return void
     */
    public function __construct(TitleService $titleService)
    {
        $this->authorizeResource(Title::class, 'title');

        $this->service = $titleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = $this->service->getAll();

        return view('title.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('title.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TitleStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TitleStoreRequest $request)
    {
        if ($request->isMethod('post')) {
    
            $item = $this->service->store($request->all());

            return redirect()->route('titles.show', $item);
        }

        $this->error(405001);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  Title  $title
     * @return \Illuminate\Http\Response
     */
    public function show(Title $title)
    {
        $item = $this->service->get($title);

        return view('title.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Title  $title
     * @return \Illuminate\Http\Response
     */
    public function edit(Title $title)
    {
        $item = $this->service->get($title);

        return view('title.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TitleUpdateRequest  $request
     * @param  Title  $title
     * @return \Illuminate\Http\Response
     */
    public function update(TitleUpdateRequest $request, Title $title)
    {
        if ($request->isMethod('put')) {
    
            $this->service->update($title, $request->all());

            return redirect()->route('titles.show', $title);
        }

        $this->error(405001);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Title  $title
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Title $title)
    {
        if ($request->isMethod('delete')) {

            $this->service->delete($title);

            return redirect()->route('titles.index');
        }

        $this->error(405001);

        return back();
    }
}
