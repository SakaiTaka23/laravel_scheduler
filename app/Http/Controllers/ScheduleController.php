<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;

use App\Service\ScheduleServiceInterface;

class ScheduleController extends Controller
{
    private $schedule;

    public function __construct(
        ScheduleServiceInterface $schedule
    ) {
        $this->schedule = $schedule;
        $this->middleware(function ($request, $next) {
            $this->auth = Auth::id();
            return $next($request);
        });
    }

    public function index(Application $app)
    {
        $schedules = $this->schedule->getUserSchedule($this->auth);
        return view("schedule/index", compact('schedules'));
    }

    public function create(Request $request)
    {
        $this->schedule->createSchedule($request['place'], $request['content'], $request['begin'], $request['end'], $this->auth);
        return redirect()->route("schedule.index");
    }

    public function update(Request $request, $schedule_id)
    {
        $this->schedule->updateSchedule($schedule_id, $request['place'], $request['content'], $request['begin'], $request['end'], $this->auth);
        return redirect()->route("schedule.index");
    }

    public function edit($schedule_id)
    {
        $schedule = $this->schedule->ScheduleFromId($schedule_id);
        return view("schedule/update", compact('schedule','schedule_id'));
    }

    public function destroy($schedule_id)
    {
        $this->schedule->deleteSchedule($schedule_id);
        return redirect()->route("schedule.index");
    }

    public function month()
    {
        $this->schedule->ScheduleMonth($this->auth);
        $schedules = $this->schedule->ScheduleMonth($this->auth);
        return view("schedule/index", compact('schedules'));
    }

    public function week()
    {
        $this->schedule->ScheduleWeek($this->auth);
        $schedules = $this->schedule->ScheduleWeek($this->auth);
        return view("schedule/index", compact('schedules'));
    }
}
