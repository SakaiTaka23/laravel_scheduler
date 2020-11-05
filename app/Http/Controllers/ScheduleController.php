<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Service\ScheduleServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    private $schedule;

    public function __construct(
        ScheduleServiceInterface $schedule
    ) {
        $this->schedule = $schedule;
        $this->auth = Auth::id();
    }

    public function index()
    {
        // $schedules = $this->schedule->getUserSchedule($this->auth);
        $schedules = new Schedule();
        $schedules = $schedules->all();
        return view("schedule/index", compact('schedules'));
    }

    public function create(Request $request)
    {
        // $schedule = new Schedule();
        // $schedule->place = $request['place'];
        // $schedule->content = $request['content'];
        // $schedule->begin = $request['begin'];
        // $schedule->end = $request['end'];
        // $schedule->user_id = Auth::id();
        // $schedule->save();

        $this->schedule->createSchedule($request['place'], $request['content'], $request['begin'], $request['end'], $this->auth);

        return redirect()->route("schedule.index");
    }

    public function update(Request $request, $schedule_id)
    {
        // $schedule = new Schedule();
        // $schedule = $schedule->where('id', $schedule_id)->first();
        // $schedule->fill($request->all())->save();
        $this->schedule->updateSchedule($schedule_id, $request['place'], $request['content'], $request['begin'], $request['end'], $this->auth);

        return redirect()->route("schedule.index");
    }

    public function edit($schedule_id)
    {
        // $schedule = new Schedule();
        // $schedule = $schedule->where('id', $schedule_id)->first();
        $this->schedule->ScheduleFromId($schedule_id);
        return view("schedule/update", compact('schedule'));
    }

    public function destroy($schedule_id)
    {
        // $schedule = new Schedule();
        // $schedule = $schedule->where('id', $schedule_id);
        // $schedule->delete();
        $this->schedule->deleteSchedule($schedule_id);
        return redirect()->route("schedule.index");
    }

    public function month()
    {
        // $schedules = new Schedule();
        // $schedules = $schedules->where('user_id', Auth::id())->where('begin', '>=', DB::raw('DATE_SUB(NOW(), INTERVAL 1 MONTH)'))
        //     ->orWhere('end', '<=', DB::raw('DATE_SUB(NOW(), INTERVAL 1 MONTH)'))->get();
        $this->schedule->ScheduleMonth($this->auth);
        return view("schedule/index", compact('schedules'));
    }

    public function week()
    {
        // $schedules = new Schedule();
        // $schedules = $schedules->where('user_id', Auth::id())->where('begin', '>=', DB::raw('DATE_SUB(NOW(), INTERVAL 1 WEEK)'))
        //     ->orWhere('end', '<=', DB::raw('DATE_SUB(NOW(), INTERVAL 1 MONTH)'))->get();
        $this->schedule->ScheduleWeek($this->auth);
        return view("schedule/index", compact('schedules'));
    }
}
