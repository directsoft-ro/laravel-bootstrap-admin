<?php

namespace DirectsoftRo\LaravelBootstrapAdmin\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class PasswordController extends Controller
{
    public function request(): View
    {
        return view('admin.auth.password.email');
    }

    /**
     * @throws ValidationException
     */
    public function email(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'email' => ['required', 'email'],
        ]);

        $email = $request->get('email');
        $user = User::where('email', '=', $email)->active()->first();
        if (!$user) {
            throw ValidationException::withMessages([
                'email' => __('Invalid account.'),
            ]);
        }

        $credentials = $request->only(['email']);

        $status = Password::sendResetLink($credentials, function ($user, $token) {
            $user->sendAdminPasswordResetNotification($token);
        });
        if ($status === Password::RESET_LINK_SENT) {
            return redirect()->route('admin.auth.password.email')->with([
                'status' => __($status),
            ])->withInput();
        } else {
            return redirect()->route('admin.auth.password.email')->withErrors([
                'email' => __($status),
            ])->withInput();
        }
    }

    public function reset(Request $request, string $token): View
    {
        $email = $request->get('email');

        return view('admin.auth.password.update', compact('token', 'email'));
    }

    /**
     * @throws ValidationException
     */
    public function update(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        $credentials = $request->only(['email', 'password', 'password_confirmation', 'token']);

        $status = Password::reset($credentials, function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        });

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('admin.auth.login')
                ->with('status', __($status));
        } else {
            return redirect()->back()->withErrors([
                'email' => [__($status)]
            ]);
        }
    }
}
