<?php

namespace App\Service;

use  Illuminate\Database\Eloquent\Collection;

use App\Models\Schedule;

interface ScheduleServiceInterface
{
    public function getUserSchedule($user_id): Collection;

    public function createSchedule($place, $content, $begin, $end, $user_id): void;

    public function updateSchedule($schedule_id,$place, $content, $begin, $end, $user_id): void;

    public function ScheduleFromId($user_id): Schedule;

    public function deleteSchedule($schedule_id): void;

    public function ScheduleMonth($user_id): Collection;

    public function ScheduleWeek($user_id): Collection;
}
