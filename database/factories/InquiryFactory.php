<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inquiry>
 */
class InquiryFactory extends Factory
{
    protected $model = \App\Models\Inquiry::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'subject' => $this->faker->text,
            'email' => $this->faker->unique()->email,
            'contact' => $this->faker->phoneNumber,
            'message' => $this->faker->sentence
        ];
    }
}
