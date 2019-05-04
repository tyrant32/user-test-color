<?php
declare(strict_types=1);

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class UsersListCriteria.
 *
 * @package namespace App\Criteria;
 */
class UsersListCriteria implements CriteriaInterface
{
    protected $request;
    
    /**
     * UsersListCriteria constructor.
     * @param $request
     */
    public function __construct($request)
    {
        $this->request = $request;
    }
    
    /**
     * Apply criteria in query repository
     *
     * @param string $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model->select('users.id', 'users.first_name', 'users.last_name', 'users.email');
        
        if (isset($this->request['first_name']))
        {
            $model = $model->where('first_name', 'like', '%'.$this->request['first_name'].'%');
        }
    
        if (isset($this->request['last_name']))
        {
            $model = $model->where('last_name', 'like', '%'.$this->request['last_name'].'%');
        }
    
        if (isset($this->request['email']))
        {
            $model = $model->where('email', 'like', '%'.$this->request['email'].'%');
        }
    
        if (isset($this->request['favorite_colors']) && $this->request['favorite_colors'])
        {
            $model->whereHas('favoriteColors', function ($q) {
                $q->where('favorite_colors.id', '=', $this->request['favorite_colors']);
            });
        }
    
        return $model->orderBy('users.id');
    }
}
