<?php

namespace App\Service\Production;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Collection;

use App\Models\Schedule;
use App\Service\ScheduleServiceInterface;

class ScheduleService implements ScheduleServiceInterface
{
    private $schedule;

    public function __construct(Carbon $carbon,Schedule $schedule)
    {
        $this->carbon = $carbon;
        $this->schedule = $schedule;
    }

    public function getUserSchedule($user_id): Collection
    {
        return $this->schedule->where('user_id', $user_id)->get();
    }

    public function createSchedule($place, $content, $begin, $end, $user_id): void
    {
        $schedule = $this->schedule;
        $schedule->place = $place;
        $schedule->content = $content;
        $schedule->begin = $begin;
        $schedule->end = $end;
        $schedule->user_id = $user_id;
        $schedule->save();
        return;
    }

    public function updateSchedule($schedule_id, $place, $content, $begin, $end, $user_id): void
    {
        $schedule = $this->ScheduleFromId($schedule_id);
        $schedule->place = $place;
        $schedule->content = $content;
        $schedule->begin = $begin;
        $schedule->end = $end;
        $schedule->user_id = $user_id;
        $schedule->update();
    }

    public function ScheduleFromId($schedule_id): Schedule
    {
        return $this->schedule->where('id', $schedule_id)->first();
    }

    public function deleteSchedule($schedule_id): void
    {
        $this->schedule->where('id', $schedule_id)->delete();
        return;
    }

    public function ScheduleMonth($user_id): Collection
    {
        $today = $this->carbon;
        $min = $today->copy()->startOfMonth();
        $max = $today->copy()->endOfMonth();
        return $this->schedule->where('user_id', $user_id)->where('begin', '>=', $min)
            ->where('begin', '<=', $max)->orwhere('end', '>=', $min)->where('end', '<=', $max)->get();
    }

    public function ScheduleWeek($user_id): Collection
    {
        $today = $this->carbon;
        $min = $today->copy()->startOfWeek();
        $max = $today->copy()->endOfWeek();
        return $this->schedule->where('user_id', $user_id)->where('begin', '>=', $min)
            ->where('end', '<=', $max)->get();
    }
}
