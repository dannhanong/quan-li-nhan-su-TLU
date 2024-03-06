<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        // $status = Password::sendResetLink(
        //     $request->only('email')
        // );

        // return $status == Password::RESET_LINK_SENT
        //             ? back()->with('status', __($status))
        //             : back()->withInput($request->only('email'))
        //                     ->withErrors(['email' => __($status)]);
        $status = Password::sendResetLink($request->only('email'));

        $statusMessage = '';

        switch ($status) {
            case Password::RESET_LINK_SENT:
                $statusMessage = __('Chúng tôi đã gửi một đường dẫn yêu cầu đổi mật khẩu tới email.');
                break;
            case Password::INVALID_USER:
                $statusMessage = __('Không tìm thấy địa chỉ email.');
                break;
            case Password::INVALID_TOKEN:
                $statusMessage = __('Đặt lại mật khẩu lần này không hợp lệ.');
                break;
            case Password::RESET_THROTTLED:
                $statusMessage = __('Hãy chờ đợi một thời gian trước khi gửi yêu cầu khác.');
                break;
            default:
                $statusMessage = __('Có lỗi xảy ra. Hãy thử lại sau.');
        }

        return $statusMessage
            ? back()->with('status', $statusMessage)
            : back()->withInput($request->only('email'))
                ->withErrors(['email' => $statusMessage]);

    }
}
