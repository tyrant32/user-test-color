<?php
declare(strict_types=1);

use App\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use App\Entities\UserFavoriteColors;

/**
 * Class UsersTableSeeder
 */
class UsersTableSeeder extends Seeder
{
    private $maxUsers = 100;
    private $faker;
    
    /**
     * UsersTableSeeder constructor.
     */
    public function __construct()
    {
        $this->faker = Factory::create();
    }
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'favorite_color_id' => UserFavoriteColors::inRandomOrder()->first()->id,
            'first_name'        => 'Demo',
            'last_name'         => 'User',
            'email'             => 'demo@demo.com',
            'password'          => bcrypt('demo')
        ]);
        
        if (is_int($this->maxUsers) && $this->maxUsers)
        {
            for ($i = 0; $i < $this->maxUsers; $i++)
            {
                User::create([
                    'favorite_color_id' => UserFavoriteColors::inRandomOrder()->first()->id,
                    'first_name'        => $this->faker->firstName,
                    'last_name'         => $this->faker->lastName,
                    'email'             => $this->faker->email,
                    'password'          => bcrypt($this->faker->password(6, 10))
                ]);
            }
        }
    }
}
