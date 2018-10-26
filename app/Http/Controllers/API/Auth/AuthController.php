<?php

namespace App\Http\Controllers\API\Auth;

use App\Helpers\httpStatus;
use App\Http\Repositories\AuthRepository;
use App\Http\Repositories\User\UserRepository;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\UserRegisterRequest;
use App\Http\Requests\User\VerifyUserRequest;
use App\Http\Resources\API\User\UserResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    use httpStatus;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var AuthRepository
     */
    private $authRepository;

    /**
     * AuthController constructor.
     * @param UserRepository $userRepository
     * @param AuthRepository $authRepository
     */
    public function __construct(UserRepository $userRepository, AuthRepository $authRepository)
    {
        $this->userRepository = $userRepository;
        $this->authRepository = $authRepository;
    }

    /**
     * @param UserRegisterRequest $request
     * @return UserResource|\Illuminate\Http\JsonResponse
     */
    public function register(UserRegisterRequest $request)
    {
        $userInfo = $this->authRepository->register($request->only(['name', 'email', 'password', 'nrc_address', 'role_id']));
        $userInfo->message = config('general.register_message');
        $userInfo->status = 201;
        return $userInfo ? (new UserResource($userInfo))->response()->setStatusCode(201) : $this->userExistResponse();
    }

    /**
     * @param VerifyUserRequest $request
     * @return UserResource
     */
    public function verifyUser(VerifyUserRequest $request)
    {
        $userInfo = $this->authRepository->verifyUser($request->only(['id', 'token']));
        $userInfo->message = config('general.verify_message');
        return $userInfo ? new UserResource($userInfo) : $this->tokenInvalidResponse();
    }


    /**
     * @param LoginRequest $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response|null
     */
    public function login(LoginRequest $request)
    {
        $userExist = $this->authRepository->query()->where('email', $request->input('email'))->first();
        //check user exist
        if ($userExist) {
            //check user verify
            if ($userExist->email_verified_at === null) {
                return $this->invalidVerifyResponse();
            }
            $credentials = $request->only('email', 'password');
            $loginData = $this->authRepository->login($credentials);
        }
        return $loginData ?? response([
                'status' => 400,
                'message' => 'Invalid login or password',
            ], 400);
    }

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function logout()
    {
        return $this->authRepository->logout();
    }


    /**
     * @param Request $request
     * @return UserResource
     */
    public function user(Request $request)
    {
        $user = $this->authRepository->find(auth()->user()->id)->with('role')->first();
        $user->message = 'success';
        return new UserResource($user);
    }

}
