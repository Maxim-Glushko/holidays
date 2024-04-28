<?php
namespace App\Services;

use App\Models\Holiday;
use Illuminate\Http\Request;
use App\Models\Result;
use Carbon\Carbon;

class HolidayService
{
    /**
     * @param Request $request
     * @return string
     */
    public function checkHoliday(Request $request)
    {
        // валідація в App\Http\Middleware\ValidateDate

        $date = Carbon::createFromFormat('d.m.Y', $request->input('date'));
        $result = Result::where('date', $date->format('Y-m-d'))->first();

        if ($result) {
            $result->increment('count');
            $name = $result->name;
        } else {
            $name = $this->checkDay($date);
            $originDate = $date->format('Y-m-d');
            if (!$name && ($date->dayOfWeek == Carbon::MONDAY)) { // якщо понеділок
                $name = $this->checkDay($date->subDay()); // неділя до нього
                if (!$name) {
                    $name = $this->checkDay($date->subDay()); // субота до нього
                }
            }
            Result::create(['date' => $originDate, 'name' => $name]);
        }

        return (string) trans('holiday.onthatdate', [
            'name' => $name ?: trans('holiday.nothing')
        ]);
    }

    /**
     * @param Carbon $date
     * @return string
     */
    private function checkDay(Carbon $date)
    {
        $name = '';
        $month = $date->month;
        $holiday = Holiday::where([
            'month' => $month,
            'day' => $date->day
        ])->first();
        if ($holiday) {
            $name = $holiday->name;
        } else {
            $dayOfWeek = $date->format('N');
            // $week = $date->weekOfMonth;
            $week = $this->customWeekOfMonth($date);
            $holiday = Holiday::where([
                'month' => $month,
                'week' => $week,
                'day_of_week' => $dayOfWeek
            ])->first();
            if ($holiday) {
                $name = $holiday->name;
            }
        }
        return $name;
    }

    private function customWeekOfMonth(Carbon $date)
    {
        // $date->weekOfMonth розпочинає кожен тиждень тим днем, який відкривав місяць,
        // у нас перший тиждень закінчуєтсья неділею, наступні також, якщо мають неділю,
        // тому і сторив цей метод

        $startOfMonth = $date->copy()->startOfMonth();
        $dayOfWeek = $date->format('N');
        $weekOfMonth = $date->weekOfMonth;
        if ($dayOfWeek < $startOfMonth->isoFormat('E')) {
            $weekOfMonth++;
        }

        return $weekOfMonth;
    }
}
