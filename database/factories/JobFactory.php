<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Job;

class JobFactory extends Factory
{
    protected $model = Job::class;

    public function definition(): array
    {
        return [
            "user_id" => User::factory(),
            'title' => $this->faker->jobTitle(),
            'description' => $this->faker->paragraphs(2, true),
            'salary' => $this->faker->numberBetween(40000, 120000),
            'tags' => implode(',', $this->faker->words(3)),
            'job_type' => $this->faker->randomElement(['Full-Time', 'Part-Time', 'Contract']),
            'remote' => $this->faker->boolean(),
            'requirements' => $this->faker->sentences(3, true),
            'benefits' => $this->faker->sentences(2, true),
            'address' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'state' => $this->faker->state(),
            'zip_code' => $this->faker->postcode(),
            'contact_email' => $this->faker->safeEmail(),
            'contact_phone' => $this->faker->phoneNumber(),
            'company_name' => $this->faker->company(),
            'company_description' => $this->faker->paragraphs(2, true),
            'company_logo' => $this->faker->imageUrl(100, 100, 'business', true, "logo"),
            'company_website' => $this->faker->url()
        ];
    }
}
