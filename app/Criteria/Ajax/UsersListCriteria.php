<?php
declare(strict_types=1);

namespace App\Criteria\Ajax;

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
        if ($this->request['first_name'])
        {
            $model = $model->where('first_name', 'like', '%'.$this->request['first_name'].'%');
        }
        
        if ($this->request['last_name'])
        {
            $model = $model->where('last_name', 'like', '%'.$this->request['last_name'].'%');
        }
        
        if ($this->request['email'])
        {
            $model = $model->where('email', 'like', '%'.$this->request['email'].'%');
        }
        
        return $model;
    }
}
