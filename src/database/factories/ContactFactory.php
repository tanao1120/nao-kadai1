<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition(): array
    {
        return [
            'categry_id' => $this->faker->numberBetween(1, 5),

            'first_name' => $this->faker->firstName(),
            'last_name'  => $this->faker->lastName(),

            // 1:男性 2:女性 3:その他
            'gender' => $this->faker->numberBetween(1, 3),

            'email' => $this->faker->unique()->safeEmail(),

            'tel' => $this->faker->numerify('0##########'),

            'address' => $this->faker->address(),

            'building' => $this->faker->boolean(70) ? $this->faker->secondaryAddress() : null,

            'detail' => $this->faker->realText(60),
        ];
    }
}
