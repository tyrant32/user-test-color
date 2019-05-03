<?php
declare(strict_types=1);

use App\Entities\FavoriteColor;
use Illuminate\Database\Seeder;

/**
 * Class FavoriteColorsTableSeeder
 */
class FavoriteColorsTableSeeder extends Seeder
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
            FavoriteColor::create([
                'name' => $color,
            ]);
        }
    }
}
