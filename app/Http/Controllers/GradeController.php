<?php

namespace App\Http\Controllers;

use App\Http\Requests\GradeStoreRequest;
use App\Http\Requests\GradeUpdateRequest;
use App\Models\Grade;
use App\Services\GradeService;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param \App\Services\GradeService  $gradeService
     * @return void
     */
    public function __construct(GradeService $gradeService)
    {
        $this->authorizeResource(Grade::class, 'grade');

        $this->service = $gradeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = $this->service->getAll();

        return view('grade.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('grade.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\GradeStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GradeStoreRequest $request)
    {
        if ($request->isMethod('post')) {
    
            $item = $this->service->store($request->all());

            return redirect()->route('grades.show', $item);
        }

        $this->error(405001);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function show(Grade $grade)
    {
        $item = $this->service->get($grade);

        return view('grade.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function edit(Grade $grade)
    {
        $item = $this->service->get($grade);

        return view('grade.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\GradeUpdateRequest  $request
     * @param  Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function update(GradeUpdateRequest $request, Grade $grade)
    {
        if ($request->isMethod('put')) {
    
            $this->service->update($grade, $request->all());

            return redirect()->route('grades.show', $grade);
        }

        $this->error(405001);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Grade $grade)
    {
        if ($request->isMethod('delete')) {

            $this->service->delete($grade);

            return redirect()->route('grades.index');
        }

        $this->error(405001);

        return back();
    }
}
