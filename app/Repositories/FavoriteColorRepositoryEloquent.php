<?php
declare(strict_types=1);

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Entities\FavoriteColor;
use Prettus\Repository\Exceptions\RepositoryException;

/**
 * Class FavoriteColorRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class FavoriteColorRepositoryEloquent extends BaseRepository implements FavoriteColorRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return FavoriteColor::class;
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
