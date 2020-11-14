<?php

namespace App\Presenters;

use Laracasts\Presenter\Presenter;

class ApplicationPresenter extends Presenter
{
    public function isAppliedExpert()
    {
        return $this->is_applied_expert ? '是' : '否';
    }

    public function hasCourse()
    {
        return $this->has_course ? '有' : '没有';
    }

    public function reason()
    {
        return config('setting.reason.' . $this->entity->reason);
    }

    public function isAudit()
    {
        switch ($this->is_audit) {
            case 0:
                return '未审核';

            case 1:
                return '审核已通过';

            case 2:
                return '审核未通过';

            default:
                return '未审核';
        }
    }

    public function files()
    {
        if (!is_null($this->file)) {
            $files = explode(';', $this->file);

            return implode(',', array_map(function ($file) {
                return '<a href="' . asset('storage/' . $file) . '"><img src="' . asset('storage/' . $file) . '" width="120"></a><br>';
            }, $files));
        }
    }
}
