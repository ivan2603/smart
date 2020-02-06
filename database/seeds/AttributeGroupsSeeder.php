<?php

use Illuminate\Database\Seeder;

class AttributeGroupsSeeder extends Seeder
    {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$data = array(
			array('id' => '1',
			      'title' => 'Механизм',
			),
			array(
				'id' => '2',
				'title' => 'Стекло',
			),
			array(
				'id' => '3',
				'title' => 'Ремешок',
			),
			array(
				'id' => '4',
				'title' => 'Корпус',
			),
			array(
				'id' => '5',
				'title' => 'Индикация',
			),
		);
		DB::table('attribute_groups')->insert($data);
	}
}
