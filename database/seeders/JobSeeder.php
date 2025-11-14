<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Apps\Models\Job;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // load job listings from the files 
        $job_listings = include database_path('seeders/data/job_listings.php');

        // get test user id 
        $testUserId = User::where('email', 'test@test.com')->value('id');
        // get all other user ids from user model
        $user_Ids = User::where("email", '!=', "test@test.com")->pluck('id', )->toArray();
        foreach ($job_listings as $index => &$listing) {
            if ($index < 2) {
                //assign the first 2 listings to test user
                $listing['user_id'] = $testUserId;
            } else {
                // Assign user id to listing
                $listing['user_id'] = $user_Ids[array_rand($user_Ids)];
            }

            // Add Timestamps
            $listing['created_at'] = now();
            $listing['updated_at'] = now();
        }

        // Insert job listings
        DB::table('job_listings')->insert($job_listings);

        echo 'Job created successfully';
    }
}
