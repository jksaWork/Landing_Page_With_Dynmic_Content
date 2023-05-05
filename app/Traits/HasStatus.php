<?php

namespace App\Traits;

trait HasStatus
{
    protected $statusattrubute = 'status';
    protected $status_filed = 'active';
    public function ChangeStatus()
    {
        $this->{$this->statusattrubute} = !$this->{$this->statusattrubute};
        $this->save();
        session()->flash('success',  __('translation.Status Was Change Succesfuly'));
    }

    public function getStatusWithSpan()
    {
        if (!$this->{$this->statusattrubute}) return "<span class='badge bg-warning'> " .  __('translation.in' . $this->status_filed)  . " </span>";
        else  return "<span class='badge bg-success'> " .  __('translation.' . $this->status_filed)  . "</span>";
    }
}