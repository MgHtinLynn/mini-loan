<?php
/**
 * Created by PhpStorm.
 * User: htinlynn
 * Date: 10/24/18
 * Time: 11:04 PM
 */

namespace App\Http\Repositories;


use App\Helpers\general;
use App\Mail\User\sendVerifyToken;
use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthRepository extends BaseRepository
{
    use general;

    /**
     * AuthRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function register($data)
    {
        $userExist = parent::query()->where('email', $data['email'])->first();
        if ($userExist === null) {
            //register user
            $data['verify_token'] = $this->randomDigit(8, 1)[0];
            $data['password'] = bcrypt($data['password']);
            $userInfo = parent::create($data)->with('role')->first();
            //if send email to verify token with email
            //
            //if sms service or third party call (fireBase) to send verify token to user
            //
            return $userInfo;

        } else {
            return null;
        }
    }

    /**
     * @param $credentials
     * @return array|null
     */
    public function login($credentials)
    {
        if ($token = $this->guard()->attempt($credentials)) {
            return [
                'status' => 200,
                'message' => 'Login Success',
                'access_token' => $token,
                'token_type' => 'Bearer',
                'expires_in' => $this->guard()->factory()->getTTL() * 60,
                'user' => auth()->user(),
                'roles' => auth()->user()->role,
            ];
        } else {
            return null;
        }
    }

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * @param $data
     * @return mixed|null
     */
    public function verifyUser($data)
    {
        $user = parent::find($data['id']);
        if ($user->verify_token === $data['token']) {
            $user->email_verified_at = now();
            $user->save();
            return $user;
        }
        return null;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }

    /**
     * @return mixed
     */
    public function guard()
    {
        return Auth::guard();
    }
}
