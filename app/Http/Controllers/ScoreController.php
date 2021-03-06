<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Exports\RankExport;
use App\Exports\ScoreExport;
use App\Imports\ScoreImport;
use Illuminate\Http\Request;
use App\Services\ScoreService;
use App\Services\SettingService;
use App\Http\Requests\ScoreStoreRequest;
use App\Http\Requests\ScoreUpdateRequest;

class ScoreController extends Controller
{
    protected $settingService;

    /**
     * Create a new controller instance.
     *
     * @param \App\Services\ScoreService  $scoreService
     * @param \App\Services\SettingService  $settingService
     * @return void
     */
    public function __construct(ScoreService $scoreService, SettingService $settingService)
    {
        $this->authorizeResource(Score::class, 'score');

        $this->service = $scoreService;
        $this->settingService = $settingService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = $this->service->getAll();

        return view('score.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('score.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ScoreStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ScoreStoreRequest $request)
    {
        if ($request->isMethod('post')) {

            $item = $this->service->store($request->all());

            return redirect()->route('scores.show', $item);
        }

        $this->error(405001);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  Score  $score
     * @return \Illuminate\Http\Response
     */
    public function show(Score $score)
    {
        $item = $this->service->get($score);

        return view('score.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Score  $score
     * @return \Illuminate\Http\Response
     */
    public function edit(Score $score)
    {
        $item = $this->service->get($score);

        return view('score.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ScoreUpdateRequest  $request
     * @param  Score  $score
     * @return \Illuminate\Http\Response
     */
    public function update(ScoreUpdateRequest $request, Score $score)
    {
        if ($request->isMethod('put')) {

            $this->service->update($score, $request->all());

            return redirect()->route('scores.show', $score);
        }

        $this->error(405001);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Score  $score
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Score $score)
    {
        if ($request->isMethod('delete')) {

            $this->service->delete($score);

            return redirect()->route('scores.index');
        }

        $this->error(405001);

        return back();
    }

    /**
     * Show the form for importing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showImportForm()
    {
        $this->authorize('import', Score::class);

        return view('score.import');
    }

    /**
     * Import the specified scores in storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request)
    {
        $this->authorize('import', Score::class);

        if ($request->isMethod('post')) {

            $this->service->import(new ScoreImport($this->settingService), $request->file('import'));

            $this->success(200009);

            return redirect()->route('scores.index');
        }

        $this->error(405001);

        return back();
    }

    /**
     * Export the specified scores in storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function export(Request $request)
    {
        $this->authorize('export', Score::class);

        $this->success(200010);

        return $this->service->exportExcel(new ScoreExport, 'score.xlsx');
    }

    /**
     * Rank the specified scores in storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function rank(Request $request)
    {
        $this->authorize('rank', Score::class);

        $items = $this->service->getRank($request->year);
        $years = $this->service->getYears();

        return view('score.rank', compact('items', 'years'));
    }

    /**
     * Export the specified scores in storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function exportRank(Request $request)
    {
        $this->authorize('export', Score::class);

        $this->success(200010);

        return $this->service->exportExcel(new RankExport($this->service, $request->year), 'rank.xlsx');
    }
}
