<?php

namespace Database\Seeders;

use App\Models\Holiday;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HolidaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*DB::table('holidays')->insert([
            ['month' => 1, 'day' => 1, 'name' => 'New Year'],
            ['month' => 1, 'day' => 7, 'name' => 'Orthodox Christmas'],
            ['month' => 5, 'day' => 1, 'name' => 'May Days'],
            ['month' => 5, 'day' => 2, 'name' => 'May Days'],
            ['month' => 5, 'day' => 3, 'name' => 'May Days'],
            ['month' => 5, 'day' => 4, 'name' => 'May Days'],
            ['month' => 5, 'day' => 5, 'name' => 'May Days'],
            ['month' => 5, 'day' => 6, 'name' => 'May Days'],
            ['month' => 5, 'day' => 7, 'name' => 'May Days'],
            ['month' => 1, 'day_of_week' => 1, 'week' => 3, 'name' => 'Monday of the 3rd week of January'],
            ['month' => 3, 'day_of_week' => 1, 'week' => 5, 'name' => 'Monday of the last week of March'],
            ['month' => 11, 'day_of_week' => 4, 'week' => 4, 'name' => 'Thursday of the 4th week of November'],
        ]);*/
        Holiday::create([
            'month' => 1,
            'day' => 1,
            'name' => 'New Year',
        ]);

        Holiday::create([
            'month' => 1,
            'day' => 7,
            'name' => 'Orthodox Christmas',
        ]);

        Holiday::create([
            'month' => 5,
            'day' => 1,
            'name' => 'May Days',
        ]);

        Holiday::create([
            'month' => 5,
            'day' => 2,
            'name' => 'May Days',
        ]);

        Holiday::create([
            'month' => 5,
            'day' => 3,
            'name' => 'May Days',
        ]);

        Holiday::create([
            'month' => 5,
            'day' => 4,
            'name' => 'May Days',
        ]);

        Holiday::create([
            'month' => 5,
            'day' => 5,
            'name' => 'May Days',
        ]);

        Holiday::create([
            'month' => 5,
            'day' => 6,
            'name' => 'May Days',
        ]);

        Holiday::create([
            'month' => 5,
            'day' => 7,
            'name' => 'May Days',
        ]);

        Holiday::create([
            'month' => 1,
            'day_of_week' => 1,
            'week' => 3,
            'name' => 'Monday of the 3rd week of January',
        ]);

        Holiday::create([
            'month' => 3,
            'day_of_week' => 1,
            'week' => 5,
            'name' => 'Monday of the last week of March',
        ]);

        Holiday::create([
            'month' => 11,
            'day_of_week' => 4,
            'week' => 4,
            'name' => 'Thursday of the 4th week of November',
        ]);
    }
}
