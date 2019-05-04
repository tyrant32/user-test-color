<?php
declare(strict_types=1);

namespace Tests\Unit;

use App\Criteria\UsersListCriteria;
use App\Repositories\UserRepositoryEloquent;
use Prettus\Repository\Exceptions\RepositoryException;
use Tests\TestCase;

/**
 * Class AjaxCalls
 * @package Tests\Feature
 */
class AjaxCalls extends TestCase
{
    
    /**
     * @var UserRepositoryEloquent
     */
    protected $repository;
    
    /**
     * List Users from Database.
     *
     * @return void
     * @throws RepositoryException
     */
    public function testListUsers()
    {
        $this->repository = new UserRepositoryEloquent($this->app);
        $this->repository
            ->pushCriteria(new UsersListCriteria(request()->all()))
            ->with('favoriteColors')
            ->paginate();
        
        static::assertTrue(true);
    }
    
    /**
     * Get User for Modal.
     *
     * @return void
     */
    public function testUserModal()
    {
        $this->repository = new UserRepositoryEloquent($this->app);
        $this->repository
            ->with('favoriteColors')
            ->first();
        
        static::assertTrue(true);
    }
}
