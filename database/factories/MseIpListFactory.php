<?php

namespace Database\Factories;

use App\Models\MseIpList;
use Illuminate\Database\Eloquent\Factories\Factory;

class MseIpListFactory extends Factory
{
    protected $model = MseIpList::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // mse_ip_lists
            'name' => $this->faker->name,
            'ipv4' => $this->faker->ipv4(),
        ];
    }
}
