<?php

namespace App\Models;

trait RecordActivity
{
    public function activity()
    {
        return $this->morphMany(Activity::class, 'subject');
    }
    protected static function bootRecordActivity()
    {
        if (auth()->guest()) {
            return;
        }
        foreach (static::getActivityEvent() as $event) {
            static::$event(function ($model) use ($event) {
                $model->recordActivity($event);
            });
        }

        static::deleting(function ($model) {
            $model->activity()->delete();
        });
    }
    public static function getActivityEvent()
    {
        return ['created'];
    }
    protected function recordActivity($event)
    {
        $this->activity()->create([
            'type' => $this->getAcitvityType($event),
            'user_id' => auth()->id(),
        ]);
    }
    protected function getAcitvityType($event)
    {
        return $event . '_' . (new \ReflectionClass($this))->getShortName();
    }
}
