<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('time_slots')->insert([
            [
				'time_start' => Carbon::parse('5:30:00'),
				'time_end'   => Carbon::parse('7:00:00'),
				'name'       => '5h30-7h',
				'status'     => '1',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
				'time_start' => Carbon::parse('7:00:00'),
				'time_end'   => Carbon::parse('8:30:00'),
				'name'       => '7h-8h30',
				'status'     => '1',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
				'time_start' => Carbon::parse('8:30:00'),
				'time_end'   => Carbon::parse('10:00:00'),
				'name'       => '8h30-10h',
				'status'     => '1',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
				'time_start' => Carbon::parse('10:00:00'),
				'time_end'   => Carbon::parse('11:30:00'),
				'name'       => '10h-11h30',
				'status'     => '1',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
				'time_start' => Carbon::parse('15:00:00'),
				'time_end'   => Carbon::parse('16:30:00'),
				'name'       => '15h-16h30',
				'status'     => '1',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
				'time_start' => Carbon::parse('16:30:00'),
				'time_end'   => Carbon::parse('18:00:00'),
				'name'       => '16h30-18h',
				'status'     => '1',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
				'time_start' => Carbon::parse('18:00:00'),
				'time_end'   => Carbon::parse('19:30:00'),
				'name'       => '18h-19h30',
				'status'     => '1',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
				'time_start' => Carbon::parse('19:30:00'),
				'time_end'   => Carbon::parse('21:00:00'),
				'name'       => '19h30-21h',
				'status'     => '1',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
    }
}
