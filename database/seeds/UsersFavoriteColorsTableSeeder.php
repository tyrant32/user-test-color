<?php
declare(strict_types=1);

use App\Entities\UserFavoriteColors;
use Illuminate\Database\Seeder;

/**
 * Class UsersFavoriteColorsTableSeeder
 */
class UsersFavoriteColorsTableSeeder extends Seeder
{
    private $colors = [
        'blue',
        'green',
        'red',
        'yellow',
        'black',
        'white',
    ];
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->colors as $color)
        {
            UserFavoriteColors::create([
                'name' => $color,
            ]);
        }
    }
}
