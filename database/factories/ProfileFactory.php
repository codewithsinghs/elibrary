<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Profile;
use App\Models\Resource;

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Resource>
 */
class ProfileFactory extends Factory
{
    protected $model = Profile::class;

    public function definition()
    {
        $user = User::factory()->create();

        $fullName =  $user->name;
        $nameParts = explode(' ', $fullName); // Split by space

        // Determine last name
        $lastName = array_pop($nameParts);

        // Determine first name
        $firstName = implode(' ', $nameParts); // Join the remaining parts for the first name


        return [
            'user_id' => $user->id,
            'fname' => $firstName,
            'lname' => $lastName,
            'email' => $user->email,

            'dob' => $this->faker->date,
            'gender' => $this->faker->randomElement(['male', 'female']),

            'father_name' =>$this->faker->words(2, true),
            'mother_name' => $this->faker->words(2, true),
            'local_guardian_name' => $this->faker->words(3, true),
            'emergency_contact_phone' => $this->faker->phoneNumber,
    
            
            'member_id' => $this->faker->unique()->numberBetween(1000, 9000),
            'member_type' => $this->faker->randomElement(['student', 'faculty', 'staff']),
            'joining_date' => $this->faker->date(),
            'membership_status' => $this->faker->randomElement(['active', 'expired', 'suspended', 'cancelled', 'pending', 'locked', 'inactive']),
            'year_of_admission' => $this->faker->numberBetween(2000, 2022),
           
            'category' => $this->faker->randomElement(['General', 'OBC', 'SC', 'ST']),
            'institute' => $this->faker->company,
            'faculty' => $this->faker->randomElement(['Science', 'Arts', 'Commerce']),
            'department' => $this->faker->randomElement(['Computer Science', 'History', 'Mathematics']),
            'course' => $this->faker->randomElement(['Engineering', 'Medical', 'Arts']),
            'designation' => $this->faker->jobTitle,
            'phone' => $this->faker->phoneNumber,
            'alternate_email' => $this->faker->email,
            'present_address' => $this->faker->address,
            'present_city' => $this->faker->city,
            'present_pincode' => $this->faker->postcode,
            'permanent_address' => $this->faker->address,
            'permanent_city' => $this->faker->city,
            'permanent_pincode' => $this->faker->postcode,
            'permanent_phone' => $this->faker->phoneNumber,
            'preferred_genres' => $this->faker->words(3, true),
            'preferred_language' => $this->faker->languageCode,
            'favorite_resources' => $this->faker->words(3, true),
            'communication_preferences' => $this->faker->randomElement(['Email', 'Phone', 'SMS']),
            'research_interests' => $this->faker->sentence,
            'social_integration' => $this->faker->sentence,
            'image' => $this->faker->imageUrl,
        ];
    }
}
