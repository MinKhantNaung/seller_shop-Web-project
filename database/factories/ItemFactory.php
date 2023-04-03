<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => 'items',
            'category_id' => 1,
            'description' => 'for sale',
            'price' => 40,
            'image' => 'ss.jpg',
            'owner_name' => 'Min',
            'phone' => 222555333,
            'address' => 'Yangon',
            'coordinates' => '22.22.22',
            'is_publish' => 1,
            'condition' => 1,
            'type' => 0,
        ];
    }
}
