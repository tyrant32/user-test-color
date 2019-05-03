<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Criteria\Ajax\UsersListCriteria;
use App\Repositories\FavoriteColorRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;

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
        $this->middleware('auth');
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
    
    /**
     * Store a newly created resource in storage.
     *
     * @param UserCreateRequest $request
     *
     * @return Response
     *
     */
    public function store(UserCreateRequest $request)
    {
        try
        {
            
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
            
            $user = $this->repository->create($request->all());
            
            $response = [
                'message' => 'User created.',
                'data'    => $user->toArray(),
            ];
            
            if ($request->wantsJson())
            {
                
                return response()->json($response);
            }
            
            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e)
        {
            if ($request->wantsJson())
            {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }
            
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }
    
    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = $this->repository->find($id);
        
        if (request()->wantsJson())
        {
            
            return response()->json([
                'data' => $user,
            ]);
        }
        
        return view('users.show', compact('user'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->repository->find($id);
        
        return view('users.edit', compact('user'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param UserUpdateRequest $request
     * @param string $id
     *
     * @return Response
     *
     */
    public function update(UserUpdateRequest $request, $id)
    {
        try
        {
            
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);
            
            $user = $this->repository->update($request->all(), $id);
            
            $response = [
                'message' => 'User updated.',
                'data'    => $user->toArray(),
            ];
            
            if ($request->wantsJson())
            {
                
                return response()->json($response);
            }
            
            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e)
        {
            
            if ($request->wantsJson())
            {
                
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }
            
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);
        
        if (request()->wantsJson())
        {
            
            return response()->json([
                'message' => 'User deleted.',
                'deleted' => $deleted,
            ]);
        }
        
        return redirect()->back()->with('message', 'User deleted.');
    }
    
    /**
     * @return JsonResponse
     */
    public function ajaxUsersList()
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
}
