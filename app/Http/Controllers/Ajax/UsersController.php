<?php
declare(strict_types=1);

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\FavoriteColorRepository;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use Faker\Factory;
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
    
    protected $faker;
    
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
        UserValidator $validator,
        Factory $faker
    ) {
        $this->middleware('auth');
        $this->repository = $repository;
        $this->favoriteColorsRepository = $favoriteColorsRepository;
        $this->validator = $validator;
        $this->faker = $faker::create();
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
    
    /**
     * Update the specified resource in storage.
     *
     * @param UserUpdateRequest $request
     * @param string $id
     *
     * @return Response
     *
     */
    public function update($id)
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
}
