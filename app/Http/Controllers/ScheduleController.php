<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Schedule;

class ScheduleController extends Controller
{

    public function index(Application $app)
    {
        $schedules = new Schedule();
        $schedules = $schedules->all();
        return view("schedule/index", compact('schedules'));
    }

    public function create(Request $request)
    {
        $schedule = new Schedule();
        $schedule->place = $request['place'];
        $schedule->content = $request['content'];
        $schedule->begin = $request['begin'];
        $schedule->end = $request['end'];
        $schedule->user_id = Auth::id();
        $schedule->save();

        return redirect()->route("schedule.index");
    }

    public function update(Request $request, $schedule_id)
    {
        $schedule = new Schedule();
        $schedule = $schedule->where('id', $schedule_id)->first();
        $schedule->fill($request->all())->save();

        return redirect()->route("schedule.index");
    }

    public function edit($schedule_id)
    {
        $schedule = new Schedule();
        $schedule = $schedule->where('id', $schedule_id)->first();
        return view("schedule/update", compact('schedule'));
    }

    public function destroy($schedule_id)
    {
        $schedule = new Schedule();
        $schedule = $schedule->where('id', $schedule_id);
        $schedule->delete();
        return redirect()->route("schedule.index");
    }

    public function month()
    {
        $schedules = new Schedule();
        $schedules = $schedules->where('user_id', Auth::id())->where('begin', '>=', DB::raw('DATE_SUB(NOW(), INTERVAL 1 MONTH)'))
            ->orWhere('end', '<=', DB::raw('DATE_SUB(NOW(), INTERVAL 1 MONTH)'))->get();
        return view("schedule/index", compact('schedules'));
    }

    public function week()
    {
        $schedules = new Schedule();
        $schedules = $schedules->where('user_id', Auth::id())->where('begin', '>=', DB::raw('DATE_SUB(NOW(), INTERVAL 1 WEEK)'))
            ->orWhere('end', '<=', DB::raw('DATE_SUB(NOW(), INTERVAL 1 MONTH)'))->get();
        return view("schedule/index", compact('schedules'));
    }
}
