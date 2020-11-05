<?php

namespace App\Service\Production;

use App\Service\ScheduleServiceInterface;
use Illuminate\Support\Facades\DB;
use App\Models\Schedule;

class ScheduleService implements ScheduleServiceInterface
{
    private $schedule;

    public function __construct(Schedule $schedule)
    {
        $this->schedule = $schedule;
    }

    public function getUserSchedule($user_id): Schedule
    {
        return $this->schedule->where('user_id', $user_id)->get();
    }

    public function createSchedule($place, $content, $begin, $end, $user_id): void
    {
        $schedule = $this->schedule->place = $place;
        $schedule = $this->schedule->content = $content;
        $schedule = $this->schedule->begin = $begin;
        $schedule = $this->schedule->end = $end;
        $schedule = $this->schedule->user_id = $user_id;
        $schedule->create();
        return;
    }

    public function updateSchedule($id, $place, $content, $begin, $end, $user_id): void
    {
        $schedule = $this->schedule->id = $id;
        $schedule = $this->schedule->place = $place;
        $schedule = $this->schedule->content = $content;
        $schedule = $this->schedule->begin = $begin;
        $schedule = $this->schedule->end = $end;
        $schedule = $this->schedule->user_id = $user_id;
        $schedule->update();
    }

    public function ScheduleFromId($schedule_id): Schedule
    {
        return $this->schedule->where('id', $schedule_id)->get();
    }

    public function deleteSchedule($schedule_id): void
    {
        $this->schedule->where('id', $schedule_id)->delete();
        return;
    }

    public function ScheduleMonth($user_id): Schedule
    {
        return $this->schedule->where('user_id', $user_id)->where('begin', '>=', DB::raw('DATE_SUB(NOW(), INTERVAL 1 MONTH)'))
            ->orWhere('end', '<=', DB::raw('DATE_SUB(NOW(), INTERVAL 1 MONTH)'))->get();
    }

    public function ScheduleWeek($user_id): Schedule
    {
        return $this->schedule->where('user_id', $user_id)->where('begin', '>=', DB::raw('DATE_SUB(NOW(), INTERVAL 1 WEEK)'))
            ->orWhere('end', '<=', DB::raw('DATE_SUB(NOW(), INTERVAL 1 MONTH)'))->get();
    }
}
