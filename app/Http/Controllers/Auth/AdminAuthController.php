<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    //

    public function showLoginForm()
{
    return view('admin.auth.login');
}

public function login(Request $request)
{
    $credentials = $request->validate([
    'email' => 'required|email',
    'password' => 'required',
]);

if (Auth::attempt($credentials)) {
    $request->session()->regenerate();
    $user = Auth::user();
        $user->tokens()->delete(); // Hapus token lama jika ada
        $token = $user->createToken('auth_token')->plainTextToken; // Buat token baru
        session(['api_token' => $token]); // Simpan token di session

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Login berhasil.',
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'address' => $user->address,
                    'role' => $user->role,
                ],
            ]);
        }

    return redirect()->intended(route('admin.dashboard'));
}

return back()->withErrors([
    'email' => 'Email atau password salah.',
])->onlyInput('email');
}

public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('admin.login');
}

public function register(Request $request)
{
    $validatedData = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|confirmed',
    ]);

    if ($validatedData->fails()) {
        return response()->json(['errors' => $validatedData->errors()], 422);
    }

    try {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(
            [
                'success' => true,
                'message' => 'User registrasi berhasil',
                'data' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer',
            ], 201);
 } catch (\Exception $e) {
        return response()->json(
            [
                'success' => false,
                'message' => 'registrasi gagal',
                'error' => $e->getMessage(),
            ], 500
        );
    }
}

// login api           
public function loginApi(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json(
            [
                'success' => false,
                'message' => 'Email atau password salah.',
            ], 401);
    }

    $token = $user->createToken('auth_token')->plainTextToken;

  return response()->json(
            [
                'message' => 'Login berhasil.',
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'address' => $user->address,
                    'role' => $user->role,
                ],
            ]);
    }

    public function logoutApi(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(
            [
                'message' => 'Logout berhasil.',
            ]);
    }
  
}
