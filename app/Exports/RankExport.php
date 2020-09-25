<?php

namespace App\Exports;

use App\Services\ScoreService;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RankExport implements FromView
{
    protected $scoreService;

    public function __construct(ScoreService $scoreService)
    {
        $this->scoreService = $scoreService;
    }

    /**
     * @return View
     */
    public function view(): View
    {
        $items = $this->scoreService->getRank();

        return view('exports.rank', compact('items'));
    }
}
