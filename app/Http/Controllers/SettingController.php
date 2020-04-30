<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingStoreRequest;
use App\Http\Requests\SettingUpdateRequest;
use App\Models\Setting;
use App\Services\SettingService;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param \App\Services\SettingService  $settingService
     * @return void
     */
    public function __construct(SettingService $settingService)
    {
        $this->service = $settingService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('list', Setting::class);

        $items = $this->service->getAll();

        return view('setting.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Setting::class);

        return view('setting.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SettingStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SettingStoreRequest $request)
    {
        $this->authorize('create', Setting::class);

        if ($request->isMethod('post')) {

            $item = $this->service->store($request->all());

            return redirect()->route('settings.show', $item);
        }

        $this->error(405001);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        $this->authorize('view', $setting);

        $item = $this->service->get($setting);

        return view('setting.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        $this->authorize('update', $setting);

        $item = $this->service->get($setting);

        return view('setting.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SettingUpdateRequest  $request
     * @param  Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(SettingUpdateRequest $request, Setting $setting)
    {
        $this->authorize('update', $setting);

        if ($request->isMethod('put')) {

            $this->service->update($setting, $request->all());

            return redirect()->route('settings.show', $setting);
        }

        $this->error(405001);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Setting $setting)
    {
        $this->authorize('delete', $setting);

        if ($request->isMethod('delete')) {

            $this->service->delete($setting);

            return redirect()->route('settings.index');
        }

        $this->error(405001);

        return back();
    }
}
