<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$users = User::all();

		for ($i = 0; $i < 200; $i++) {
			$user = $users->random();
			Event::create([
				'name' => fake()->unique()->sentence(3),
				'description' => fake()->text,
				'location' => fake()->city(),
				'start_time' => fake()->dateTimeBetween('now', '+1 month'),
				'end_time' => fake()->dateTimeBetween('+1 month', '+2 months'),
				'user_id' => $user->id,
			]);
		}
	}
}
