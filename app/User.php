<?php
declare(strict_types=1);

namespace App;

use App\Entities\FavoriteColor;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package App
 */
class User extends Authenticatable
{
    use Notifiable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'favorite_color_id',
        'first_name',
        'last_name',
        'email',
        'password',
    ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    /**
     * @return BelongsToMany
     */
    public function favoriteColors()
    {
        return $this->belongsToMany(FavoriteColor::class);
    }
}
