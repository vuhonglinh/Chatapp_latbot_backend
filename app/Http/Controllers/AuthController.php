<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Laravel\Passport\TokenRepository;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Passport\Client;

class AuthController extends Controller
{

    private $customerRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->customerRepository = $userRepository;
    }

    public function loginGoogle()
    {
        try {
            return response()->json([
                'data' => Socialite::driver('google')
                    ->stateless()
                    ->redirect()
                    ->getTargetUrl(),
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function callbackGoogle(Request $request)
    {
        try {
            $data = Socialite::driver('google')
                ->stateless()
                ->user();
            $customer = $this->customerRepository->loginOauth($data);
            $response = $this->createToken($customer->email, 18072001);
            $token = $response->json();
            Log::info($token);
            $cookie = cookie('refresh_token', $token['refresh_token'], 43200, '/', null, true);
            return response()->json([
                'data' => [
                    'user' => new UserResource($customer),
                    'token' => $token,
                ]
            ])->cookie($cookie);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function profile(Request $request)
    {
        try {
            $user = $request->user();
            return response()->json([
                'message' => 'Get profile successfully',
                'data' => new UserResource($user)
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function update(Request $request)
    {
        try {
            $user = $request->user();
            $data = $request->only([
                'name',
                'date_of_birth',
                'gender',
                'email',
                'password',
                'phone_number'
            ]);
            foreach (['name', 'date_of_birth', 'gender', 'email', 'password', 'phone_number'] as $field) {
                if (!array_key_exists($field, $data)) {
                    $data[$field] = null;
                }
            }
            $user->update($data);
            return response()->json([
                'message' => 'Save successfully',
                'data' => new UserResource($user)
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function logout(Request $request)
    {
        try {
            $user = $request->user();
            $tokenRepository = App::make(TokenRepository::class);
            $refreshTokenRepository = App::make(\Laravel\Passport\RefreshTokenRepository::class);
            $accessTokenId = $user->token()->id;
            $tokenRepository->revokeAccessToken($accessTokenId);
            $refreshTokenRepository->revokeRefreshTokensByAccessTokenId($accessTokenId);
            return response()->json([
                'message' => 'Logout successfully',
            ], Response::HTTP_OK)->withoutCookie('remember_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');
        } catch (\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }


    public function createToken($email, $password)
    {
        try {
            $client = Client::where('password_client', true)->where('provider', 'users')->first();
            $response = Http::asForm()->post('http://127.0.0.1:8001/oauth/token', [
                'grant_type' => 'password',
                'client_id' => $client->id,
                'client_secret' => $client->secret,
                'username' => $email,
                'password' => $password,
                'scope' => '*',
            ]);
            return $response;
        } catch (\Throwable $e) {
            throw $e;
        }
    }

    public function setCookie($refresh_token)
    {
        return cookie('refresh_token', $refresh_token, 43200, '/', null, true);
    }
}
