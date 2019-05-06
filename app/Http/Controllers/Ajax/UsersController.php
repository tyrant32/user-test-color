<?php
declare(strict_types=1);

namespace App\Http\Controllers\Ajax;

use App\Criteria\UsersListCriteria;
use App\Http\Controllers\Controller;
use App\Repositories\FavoriteColorRepository;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

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
     * @var Generator
     */
    protected $faker;
    
    /**
     * UsersController constructor.
     *
     * @param UserRepository $repository
     * @param FavoriteColorRepository $favoriteColorsRepository
     * @param UserValidator $validator
     * @param Factory $faker
     */
    public function __construct(
        UserRepository $repository,
        FavoriteColorRepository $favoriteColorsRepository,
        UserValidator $validator,
        Factory $faker
    ) {
        $this->middleware(['auth','throttle:1000']);
        $this->repository = $repository;
        $this->favoriteColorsRepository = $favoriteColorsRepository;
        $this->validator = $validator;
        $this->faker = $faker::create();
    }
    
    /**
     * @return JsonResponse
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        
        if (request()->wantsJson())
        {
            $users = $this->repository
                ->pushCriteria(new UsersListCriteria(request()->all()))
                ->with('favoriteColors')
                ->paginate();
            
            $users->setPath(route('home', \request()->all()));
            
            try
            {
                return response()->json([
                    'success' => true,
                    'html'    => view('users._partials.table-list', compact('users'))
                        ->render(),
                ]);
            } catch (\Throwable $e)
            {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessage(),
                ]);
            }
        }
        
        return response()->json([]);
    }
    
    /**
     * @return JsonResponse
     */
    public function modal()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        
        if (request()->wantsJson())
        {
            try
            {
                $userID = str_replace('user-', '', \request('user'));
                
                $user = $this->repository
                    ->with('favoriteColors')
                    ->find($userID);
                
                return response()->json([
                    'success' => true,
                    'html'    => view('users._partials.modal', compact('user'))
                        ->render(),
                ]);
            } catch (\Throwable $e)
            {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessage(),
                ]);
            }
        }
        
        return response()->json([]);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     *
     * @throws \Throwable
     */
    public function store()
    {
        try
        {
            $this->validator->with(\request()->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
            
            \request()->merge([
                'password' => bcrypt($this->faker->password)
            ]);
            
            $user = $this->repository->create(\request()->all());
            
            if(\request('favorite_colors'))
            {
                $user->favoriteColors()->sync(\request('favorite_colors'));
            }
            
            $response = [
                'message' => 'User created.',
                'data'    => $user->toArray(),
            ];
            
            if (\request()->wantsJson())
            {
                return response()->json($response);
            }
            
            return redirect()->back()->with('message', $response['message']);
            
        } catch (ValidatorException $e)
        {
            if (\request()->wantsJson())
            {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag(),
                ]);
            }
            
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }
}
