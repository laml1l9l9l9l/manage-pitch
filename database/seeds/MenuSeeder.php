<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu')->insert([
            [
				'name'       => 'Quản Lý',
				'icon'       => 'ti-panel',
				'link'       => '/#',
				'level_menu' => '1',
				'index_menu' => '1',
				'index_sub_menu' => '',
				'link_relevant_menu' => '',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
				'name'       => 'Thêm Menu',
				'icon'       => '',
				'link'       => '/menu/add',
				'level_menu' => '0',
				'index_menu' => '',
				'index_sub_menu' => '',
				'link_relevant_menu' => '/menu',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
				'name'       => 'Hóa Đơn',
				'icon'       => 'HĐ',
				'link'       => '/bill',
				'level_menu' => '0',
				'index_menu' => '',
				'index_sub_menu' => '1',
				'link_relevant_menu' => '',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
				'name'       => 'Khách Hàng',
				'icon'       => 'KH',
				'link'       => '/customer',
				'level_menu' => '0',
				'index_menu' => '',
				'index_sub_menu' => '2',
				'link_relevant_menu' => '',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
				'name'       => 'Sân Bóng',
				'icon'       => 'SB',
				'link'       => '/pitch',
				'level_menu' => '0',
				'index_menu' => '',
				'index_sub_menu' => '3',
				'link_relevant_menu' => '',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
				'name'       => 'Ngày Tháng',
				'icon'       => 'NT',
				'link'       => '/date',
				'level_menu' => '0',
				'index_menu' => '',
				'index_sub_menu' => '4',
				'link_relevant_menu' => '',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
				'name'       => 'Thời Gian',
				'icon'       => 'TG',
				'link'       => '/time',
				'level_menu' => '0',
				'index_menu' => '',
				'index_sub_menu' => '5',
				'link_relevant_menu' => '',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
				'name'       => 'Căng Tin',
				'icon'       => 'ti-shopping-cart',
				'link'       => '/#',
				'level_menu' => '1',
				'index_menu' => '2',
				'index_sub_menu' => '',
				'link_relevant_menu' => '',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
    }
}
