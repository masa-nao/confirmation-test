<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => Category::inRandomOrder()->value('id') ?? 1,
            'first_name'  => $this->faker->firstName,
            'last_name'   => $this->faker->lastName,
            'gender'      => $this->faker->numberBetween(1, 3),
            'email'       => $this->faker->unique()->safeEmail,
            'tel'         => $this->faker->numerify('0##########'),
            'address'     => $this->faker->prefecture . $this->faker->city . $this->faker->streetAddress,
            'building'    => $this->faker->optional()->secondaryAddress,
            'detail'      => $this->faker->realText(60),
        ];
    }
}
