<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Brian2694\Toastr\Facades\Toastr;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function edit(Request $request): View
    {
        return view('profile.change-pass', [
            'user' => $request->user(),
            'user' => Auth::user()
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        Toastr::success('Cập nhật mật khẩu mới thành công', 'Thông báo');

        return back();//->with('status', 'password-updated');
    }
}
