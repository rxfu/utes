<?php

namespace App\Exports;

use App\Services\ScoreService;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RankExport implements FromView
{
    protected $scoreService;

    protected $year;

    public function __construct(ScoreService $scoreService, $year)
    {
        $this->scoreService = $scoreService;
        $this->year = $year;
    }

    /**
     * @return View
     */
    public function view(): View
    {
        $items = $this->scoreService->getRank($this->year);

        return view('exports.rank', compact('items'));
    }
}
