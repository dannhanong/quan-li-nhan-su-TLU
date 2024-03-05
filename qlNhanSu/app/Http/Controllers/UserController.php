<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use function Laravel\Prompts\alert;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $users = User::orderBy('id', 'desc')->paginate(5);

        $roles = User::distinct()->pluck('role');
        // $users = User::orderBy('id', 'desc')->get();

        // $startNumber = ($users->currentPage() - 1) * $users->perPage() + 1;

        // return view('user.index', compact('users', 'startNumber', 'roles'));
        // return view('user.index', compact('users'));
        return view('user.index', compact('roles'));
    }

    public function fetchUser()
    {
        $users = User::all();
        $i =  $users->count() - $users->count();
        $output = '';
        if($users->count() > 0){
            $output .= '<table class="table table-bordered" id="userTable" style="width: 100%">
            <thead>
                <tr>
                    <th class="text-center align-middle">STT</th>
                    <th class="text-center align-middle">Tên hiển thị</th>
                    <th class="text-center align-middle">Tài khoản</th>
                    <th class="text-center align-middle">Ảnh đại diện</th>
                    <th class="text-center align-middle">Email</th>
                    <th class="text-center align-middle">Loại tài khoản</th>
                    <th class="text-center align-middle">Thao tác</th>
                </tr>
            </thead>

            <tbody>';

            foreach ($users as $user){
                if($user->account != Auth::user()->account){
                    $i++;
                    $quyen = ($user->role == 1) ? "Người dùng thường" : "Admin";
                    $output .= '<tr id="row_{{ $user->id }}">
                        <td class="text-center align-middle">'.$i.'</td>
                        <td class="text-center align-middle">'.$user->name.'</td>
                        <td class="text-center align-middle">'.$user->account.'</td>
                        <td class="text-center align-middle">
                            <div style="display: inline-block; text-align: center;">
                                <img src="/uploads/avatars/'.$user->avatar.'" style="width: 70px; height: 70px; border-radius: 50%;" alt="Img">
                            </div>
                        </td>
                        <td class="text-center align-middle">'.$user->email.'</td>
                        <td class="text-center align-middle">'.$quyen.'</td>
                        <td class="text-center align-middle">
                            <a id="aShowUser" data-id_show="'.$user->id.'" href="#" data-toggle="modal" data-target="#showUserModal"><i class="fa-solid fa-eye"></i></a> ';
                            if (auth()->check() && auth()->user()->role == 0) {
                                $output .= '<a id="aEditUser" data-id_edit="'.$user->id.'" href="#" data-toggle="modal" data-target="#editUserModal"><i class="fa-solid fa-pen-to-square"></i></a>

                                            <a id="aDeleteUser" data-id_xoa="'.$user->id.'" href="#" data-toggle="modal" data-target="#deleteUserModal"><i class="aUser fa-solid fa-solid fa-trash"></i></a>';
                            }
                        $output .= '</td>
                    </tr>';
                }
            }

            $output .= '</tbody> </table>';

            echo $output;
        }else{
            echo '<h1 class = "text-center text-secondary my-5">Chưa có dữ liệu</h1>';
        }
    }

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
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save( public_path('uploads/avatars/' . $filename) );
            // $avatar->storeAs('public/uploads/avatars', $filename);

            $userData = ['name' => $request->name, 'account' => $request->account, 'password' => $request->password, 'email' => $request->email, 'avatar' => $filename, 'role' => $request->role];
            User::create($userData);
            return response()->json([
                'status' => true
            ]);
        }else{
            User::create($request->all());
            return response()->json([
                'status' => true
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $id  = $request->id;
        $user = User::find($id);
        // $roles = User::distinct()->pluck('role');
        return response()->json($user);
        // return view('user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        if($request->hasFile('avatar')){
            // $file = $request->file('avatar');
            // $fileName = time() . '.' . $file->getClientOriginalExtension();
            // $file->storeAs('public/uploads/avatars', $fileName);
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save( public_path('uploads/avatars/' . $filename) );
            $user->avatar = $filename;
        }else{
            $filename = $request->u_avatar;
        }

        $userData = ['name' => $request->name, 'account' => $request->account, 'email' => $request->email, 'avatar' => $filename, 'role' => $request->role];
        $user->update($userData);
        return response()->json([
            'status' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json([
            'status' => true
        ]);
        // Toastr::success('Xóa tài khoản thành công','Thông báo');
        // return redirect()->route('users.index');
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
        }else{
            $user = User::where('email', $request->email)->first();
                if($user){
                    echo 'false';
                }else{
                    echo 'true';
            }
        }
    }

    public function check_email_edit(Request $request){
        if($request->emailF == $request->email){
            return response()->json([
                'status' => true
            ]);
        }else{
            $user = User::where('email', $request->email)->first();
            if($user){
                return response()->json([
                    'status' => false
                ]);
            }else{
                return response()->json([
                    'status' => true
                ]);
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

    public function check_account_edit(Request $request){
        if($request->accountF == $request->account){
            return response()->json([
                'status' => true
            ]);
        }else{
            $user = User::where('account', $request->account)->first();
            if($user){
                return response()->json([
                    'status' => false
                ]);
            }else{
                return response()->json([
                    'status' => true
                ]);
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
