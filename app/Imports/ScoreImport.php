<?php

namespace App\Imports;

use App\Models\Score;
use Maatwebsite\Excel\Row;
use App\Services\SettingService;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ScoreImport implements OnEachRow, WithStartRow
{
    protected $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    /**
     * @param \Maatwebsite\Excel\Row $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row = $row->toArray();

        $score = [
            'user_id' => $row[0],
            'student1' => $row[3] ?? 0,
            'plan1' => $row[4] ?? 0,
            'plan2' => $row[5] ?? 0,
            'peer1' => $row[6] ?? 0,
            'peer2' => $row[7] ?? 0,
            'peer3' => $row[8] ?? 0,
            'expert1' => $row[9] ?? 0,
            'expert2' => $row[10] ?? 0,
            'expert3' => $row[11] ?? 0,
            'expert4' => $row[12] ?? 0,
            'expert5' => $row[13] ?? 0,
            'remark' => $row[14] ?? null,
            'creator_id' => Auth::id(),
            'year' => $this->settingService->getSetting('year'),
        ];

        Score::updateOrCreate([
            'user_id' => $row[0],
        ], $score);
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }
}
