<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentStoreRequest;
use App\Http\Requests\DepartmentUpdateRequest;
use App\Models\Department;
use App\Services\DepartmentService;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param \App\Services\DepartmentService  $departmentService
     * @return void
     */
    public function __construct(DepartmentService $departmentService)
    {
        $this->authorizeResource(Department::class, 'department');

        $this->service = $departmentService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = $this->service->getAll();

        return view('department.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('department.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\DepartmentStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentStoreRequest $request)
    {
        if ($request->isMethod('post')) {
    
            $item = $this->service->store($request->all());

            return redirect()->route('departments.show', $item);
        }

        $this->error(405001);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        $item = $this->service->get($department);

        return view('department.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        $item = $this->service->get($department);

        return view('department.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\DepartmentUpdateRequest  $request
     * @param  Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(DepartmentUpdateRequest $request, Department $department)
    {
        if ($request->isMethod('put')) {
    
            $this->service->update($department, $request->all());

            return redirect()->route('departments.show', $department);
        }

        $this->error(405001);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Department $department)
    {
        if ($request->isMethod('delete')) {

            $this->service->delete($department);

            return redirect()->route('departments.index');
        }

        $this->error(405001);

        return back();
    }
}
