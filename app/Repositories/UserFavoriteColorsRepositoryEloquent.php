<?php
declare(strict_types=1);

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Entities\UserFavoriteColors;
use App\Validators\UserFavoriteColorsValidator;
use Prettus\Repository\Exceptions\RepositoryException;

/**
 * Class UserFavoriteColorsRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserFavoriteColorsRepositoryEloquent extends BaseRepository implements UserFavoriteColorsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UserFavoriteColors::class;
    }
    
    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {
        
        return UserFavoriteColorsValidator::class;
    }
    
    /**
     * Boot up the repository, pushing criteria
     * @throws RepositoryException
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
