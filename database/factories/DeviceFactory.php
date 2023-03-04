<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Device>
 */
class DeviceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'device_id' => $this->faker->uuid(),
            'device_name' => $this->faker->name(),
            'device_model' => $this->faker->name(),
            'android_version' => '1.0.0',
            'app_version' => '1.0.0',
            'is_connected' => $this->faker->boolean(),
            'sim' => $this->faker->text(),
        ];
    }
}
