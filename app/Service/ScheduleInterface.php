<?php

namespace App\Service;

use App\Models\Schedule;

interface ScheduleServiceInterface
{
    public function getUserSchedule($user_id): Schedule;

    public function createSchedule($place, $content, $begin, $end, $user_id): void;

    public function updateSchedule($id,$place, $content, $begin, $end, $user_id): void;

    public function ScheduleFromId($user_id): Schedule;

    public function deleteSchedule($schedule_id): void;

    public function ScheduleMonth($user_id): Schedule;

    public function ScheduleWeek($user_id): Schedule;
}
