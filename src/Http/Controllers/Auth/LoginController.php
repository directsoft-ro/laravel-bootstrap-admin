<?php

namespace DirectsoftRo\LaravelBootstrapAdmin\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function login(): View
    {
        SEOMeta::setTitle(__('Authentication'));

        return view('admin::auth.login');
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        $email = $request->get('email');
        $password = $request->get('password');

        $user = User::where('email', '=', $email)->where('active', '=', true)->first();
        if (!$user) {
            throw ValidationException::withMessages([
                'email' => __('Invalid credentials.'),
            ]);
        }

        if (!Hash::check($password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => __('Invalid credentials.'),
            ]);
        }

        Auth::login($user, $request->has('remember'));

        return redirect()->intended(route('admin.home'));
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->flush();
        $request->session()->regenerate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.auth.login');
    }
}
