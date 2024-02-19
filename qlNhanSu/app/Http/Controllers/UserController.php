<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(5);
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'avatar' => ['mimes:png, jpg, jpeg, webp']
        ]);

        // User::create([
        //     'name' => $request->name,
        //     '...' => $request->...,
        // ]);

        // if($request->has('avatar')){
        //     $file = $request->file('avatar');
        //     $extension = $file->getClientOriginalExtension();
        //     $filename = time(). '.' .$extension;
        //     $path = 'uploads/avatars/';
        //     $file->move($path, $filename);
        // }
        User::create($request->all());
        return redirect()->route('users.index')->with('success', 'Thêm tài khoản thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $request->validate([
        //     'name' => ['required'],
        //     'description' => ['required'],
        //     'image_url' => ['required'],
        //     'category_id' => ['required'],
        //     'brand' => ['required'],
        //     'price' => ['required'],
        //     'quantity' => ['required']
        // ]);

        $user = User::find($id);
        $user->update($request->all());
        return redirect()->route('users.index')->with('success', 'Cập nhật tài khoản thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Xóa tài khoản thành công');
    }
}
