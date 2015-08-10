<?php

use Faker\Generator;
use TeachMe\Entities\User;

class UserTableSeeder extends BaseSeeder {

	public function getModel(){
		return new User();
	}

	public function getDummyData(Generator $faker,array $customValues = array()){

		return [
			'name'=> $faker->name,
			'email'=> $faker->email,
			'password'=> bcrypt('123456')
		];
	}

	public function run(){

		$this->createAdmin();
		$this->createMultiple(50);
	}

	public function createAdmin(){

		$this->create([
			'name'=>'Anderson Rodriguez',
			'email'=>'andiirc@gmail.com',
			'password'=> bcrypt('admin')
			]);

	}
}
