<?php

namespace DirectsoftRo\LaravelBootstrapAdmin\Http\Controllers\Auth;

use Artesaos\SEOTools\Facades\SEOMeta;
use DirectsoftRo\LaravelBootstrapAdmin\Admin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Pipeline;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
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
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator->errors());
        }

        $user = (new Pipeline())->send($request)->through(array_filter(
            call_user_func(Admin::$authenticateUsingCallback, $request),
        ));

        Auth::login($user, $request->boolean('remember'));

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
