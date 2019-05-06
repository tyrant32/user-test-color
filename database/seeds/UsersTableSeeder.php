<?php
declare(strict_types=1);

use App\Entities\FavoriteColor;
use App\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

/**
 * Class UsersTableSeeder
 */
class UsersTableSeeder extends Seeder
{
    private $maxUsers = 80;
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
            'first_name'        => 'Demo',
            'last_name'         => 'User',
            'email'             => 'demo@demo.com',
            'password'          => bcrypt('demo')
        ]);
    
        if (is_int($this->maxUsers) && $this->maxUsers && app()->environment() !== 'production')
        {
            for ($i = 0; $i < $this->maxUsers; $i++)
            {
                User::create([
                    'first_name'        => $this->faker->firstName,
                    'last_name'         => $this->faker->lastName,
                    'email'             => $this->faker->email,
                    'password'          => bcrypt($this->faker->password(6, 10))
                ]);
            }
        }
    }
}
