<?php

namespace App\Observers;

use App\Traits\ClearCache;

class TaskObserver
{
    use ClearCache;
    
    /**
     * Handle the Task "created" event.
     */
    public function created(): void
    {
        $this->clear([
            'tasks',
            'tasks:show',
        ]);
    }

    /**
     * Handle the Task "updated" event.
     */
    public function updated(): void
    {
        $this->clear([
            'tasks',
            'tasks:show',
        ]);
    }

    /**
     * Handle the Task "deleted" event.
     */
    public function deleted(): void
    {
        $this->clear([
            'tasks',
            'tasks:show',
        ]);
    }

    /**
     * Handle the Task "restored" event.
     */
    public function restored(): void
    {
        $this->clear([
            'tasks',
            'tasks:show',
        ]);
    }

    /**
     * Handle the Task "force deleted" event.
     */
    public function forceDeleted(): void
    {
        $this->clear([
            'tasks',
            'tasks:show',
        ]);
    }
}