<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
// use Nette\Utils\Image;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */

    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(5);
        return view('profile.index', compact('users'));
    }

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
            'user' => Auth::user()
        ]);
    }

    public function create()
    {
        return view('profile.create');
    }

    public function store(Request $request)
    {
        User::create($request->all());
        return redirect()->route('profile.index')->with('success', 'Thêm tài khoản thành công');
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request)//: RedirectResponse
    {
        $request->user()->fill($request->validated());

        // if ($request->user()->isDirty('email')) {
        //     $request->user()->email_verified_at = null;
        // }

        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save( public_path('uploads/avatars/' . $filename) );

            $user = Auth::user();
            // dd($user);
            $user->avatar = $filename;
            $newAvatarUrl = asset('uploads/avatars/' . $filename);
            $request->user()->save();
        }else{
            $request->user()->save();
        }
        if($request->hasFile('avatar')){
            return response()->json([
                'status' => true,
                'newName' => $request->name,
                'newAvatarUrl' => $newAvatarUrl
            ]);
        }else{
            return response()->json([
                'status' => true,
                'newName' => $request->name
            ]);
        }


        // Toastr::success("Cập nhật thành công", "Thông báo");

        // return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
