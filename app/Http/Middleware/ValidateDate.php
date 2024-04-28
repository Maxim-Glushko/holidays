<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ValidateDate
{
    public function handle(Request $request, Closure $next)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required|date_format:d.m.Y',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()]);
        }

        return $next($request);
    }
}
