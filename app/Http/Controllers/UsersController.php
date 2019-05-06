<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Criteria\UsersListCriteria;
use App\Repositories\FavoriteColorRepository;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use Illuminate\Http\Response;

/**
 * Class UsersController.
 *
 * @package namespace App\Http\Controllers;
 */
class UsersController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $repository;
    
    /**
     * @var FavoriteColorRepository
     */
    protected $favoriteColorsRepository;
    
    /**
     * @var UserValidator
     */
    protected $validator;
    
    /**
     * UsersController constructor.
     *
     * @param UserRepository $repository
     * @param FavoriteColorRepository $favoriteColorsRepository
     * @param UserValidator $validator
     */
    public function __construct(
        UserRepository $repository,
        FavoriteColorRepository $favoriteColorsRepository,
        UserValidator $validator
    ) {
        $this->middleware(['auth','throttle:600']);
        $this->repository = $repository;
        $this->favoriteColorsRepository = $favoriteColorsRepository;
        $this->validator = $validator;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
    
        $users = $this->repository
            ->pushCriteria(new UsersListCriteria(request()->all()))
            ->with('favoriteColors')
            ->paginate();
    
        $favoriteColors = $this->favoriteColorsRepository->pluck('name', 'id');
        
        if (request()->wantsJson())
        {
            return response()->json([
                'data' => $users,
            ]);
        }
        
        return view('users.index', compact('users', 'favoriteColors'));
    }
}
