<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\HolidayService;

class HolidayController extends Controller
{
    protected $holidayService;

    public function __construct(HolidayService $holidayService)
    {
        $this->holidayService = $holidayService;
    }

    public function index()
    {
        return view('holiday.index');
    }

    public function checkHoliday(Request $request)
    {
        return response()->json([
            'message' => $this->holidayService->checkHoliday($request)
        ]);
    }
}
