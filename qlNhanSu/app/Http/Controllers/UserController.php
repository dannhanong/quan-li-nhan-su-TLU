<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\alert;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::orderBy('id', 'desc')->paginate(5);

        $roles = User::distinct()->pluck('role');
        // $users = User::orderBy('id', 'desc')->get();

        $startNumber = ($users->currentPage() - 1) * $users->perPage() + 1;

        return view('user.index', compact('users', 'startNumber', 'roles'));
        // return view('user.index', compact('users'));
    }

    // public function fetchUser()
    // {
    //     $users = User::orderBy('id', 'desc')->paginate(5);

    //     $roles = User::distinct()->pluck('role');

    //     $startNumber = ($users->currentPage() - 1) * $users->perPage() + 1;

    //     if (request()->ajax()) {
    //         // Nếu là AJAX, trả về dữ liệu dưới dạng JSON
    //         return response()->json([
    //             'users' => $users,
    //             'startNumber' => $startNumber
    //         ]);
    //     }
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = User::distinct()->pluck('role');
        return view('user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $message = 'Thêm tài khoản thành công';
        User::create($request->all());

        return response()->json([
            'status' => true,
            'msg' => $message
        ]);
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
        $roles = User::distinct()->pluck('role');
        return view('user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $user->update($request->all());
        Toastr::success('Cập nhật tài khoản người dùng thành công', 'Thông báo');
        return redirect()->route('users.index');
        // $acc = $request->account;
        // return response()->json([
        //     'status' => true,
        //     'acc' => $acc
        // ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        // return response()->json([
        //     'status' => true
        // ]);
        Toastr::success('Xóa tài khoản thành công','Thông báo');
        return redirect()->route('users.index');
    }

    public function pagination(Request $request)
    {
        $users = User::orderBy('id', 'desc')->paginate(5);
        $roles = User::distinct()->pluck('role');
        $startNumber = ($users->currentPage() - 1) * $users->perPage() + 1;
        return view('user.pagination_users', compact('users', 'startNumber', 'roles'))->render();
    }

    public function check_email_unique(Request $request){
        if($request->has('emailF')){
            if($request->emailF == $request->email){
                echo 'true';
            }else{
                $user = User::where('email', $request->email)->first();
                if($user){
                    echo 'false';
                }else{
                    echo 'true';
                }
            }
        }else {
            $user = User::where('email', $request->email)->first();
                if($user){
                    echo 'false';
                }else{
                    echo 'true';
            }
        }
    }

    public function check_account_unique(Request $request){
        if($request->has('accountF')){
            if($request->accountF == $request->account){
                echo 'true';
            }else{
                $user = User::where('account', $request->account)->first();
                if($user){
                    echo 'false';
                }else{
                    echo 'true';
                }
            }
        }else{
            $user = User::where('account', $request->account)->first();
                if($user){
                    echo 'false';
                }else{
                    echo 'true';
            }
        }
    }

    public function check_current_password(Request $request){
        $currentPass = $request->current_password;

        if(Hash::check($currentPass, Auth::user()->password)){
            echo 'true';
        }else{
            echo 'false';
        }
    }

    public function searchUser(Request $request){
        $users = User::where('name', 'like', '%'.$request->search.'%')
        ->orWhere('email', 'like', '%'.$request->search.'%')
        ->orWhere('account', 'like', '%'.$request->search.'%')
        ->orWhere('email', 'like', '%'.$request->search.'%')
        ->orderBy('id',  'desc')
        // ->get();
        ->paginate(5);

        if($users->count() >= 1){
            $roles = User::distinct()->pluck('role');
            $startNumber = ($users->currentPage() - 1) * $users->perPage() + 1;
            return view('user.pagination_users', compact('users', 'startNumber', 'roles'))->render();
        }
    }
}
