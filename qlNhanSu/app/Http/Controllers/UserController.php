<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\alert;

use Brian2694\Toastr\Facades\Toastr;
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

        // elseif($validator->fails()){
        //     return response()->json([
        //         'status' => false,
        //         'error'=>$validator->errors()->all()
        //     ]);
        // }

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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        Toastr::success('Xóa tài khoản thành công','Thông báo');
        return redirect()->route('users.index');
    }

    public function search(Request $request)
    {
        $i = 1;
        $output = "";

        $users = DB::table('users')
            ->where('name', 'like', '%'.$request->search.'%')
            ->orWhere('account', 'like', '%'.$request->search.'%')
            ->orWhere('email', 'like', '%'.$request->search.'%')
            ->orderBy('id', 'desc')
            ->get();

        foreach($users as $user){
            if ($user->role == 1) {
                $quyen = "Người dùng thường";
            } elseif ($user->role == 0) {
                $quyen = "Admin";
            }

            $output .= '<tr>
                <td class="text-center align-middle">'.$i++.'</td>
                <td class="text-center align-middle">'.$user->name.'</td>
                <td class="text-center align-middle">'.$user->account.'</td>
                <td class="text-center align-middle">
                    <img src="/uploads/avatars/'.$user->avatar.'" style="width: 70px; height: 70px; margin-left: 20%; border-radius: 50%" alt="Img">
                </td>
                <td class="text-center align-middle">'.$user->email.'</td>
                <td class="text-center align-middle">'.$quyen.'</td>
                <td class="text-center align-middle">
                    <a href="' . route('users.show', $user->id) . '"><i class="fa-solid fa-eye"></i></a>';

                    if (auth()->check() && auth()->user()->role == 0) {
                        $output .= '
                            <a href="' . route('users.edit', $user->id) . '"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="#" data-toggle="modal" data-target="#B'.$user->id.'"><i class="fa-solid fa-solid fa-trash"></i></a>

                            <!-- Modal -->
                            <div class="modal fade" id="B'.$user->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Xác nhận xóa</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Bạn chắc chắn muốn xóa người dùng: '.$user->name.' ?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                            <form action="' . route('users.destroy', $user->id) . '" method="POST">
                                                ' . csrf_field() . '
                                                ' . method_field("DELETE") . '
                                                <button type="submit" class="btn btn-primary">Xác nhận</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                    }
            $output .= '</td>
                </tr>';
        }
        return response($output);
    }

    public function filter(Request $request)
    {
        $i = 1;
        $output = "";

        $users = DB::table('users')
            ->where('role', '=', $request->filter)
            ->orderBy('id', 'desc')
            ->get();

        foreach($users as $user){
            if ($user->role == 1) {
                $quyen = "Người dùng thường";
            } elseif ($user->role == 0) {
                $quyen = "Admin";
            }

            $output .= '<tr>
                <td class="text-center align-middle">'. $i++ .'</td>
                <td class="text-center align-middle">'.$user->name.'</td>
                <td class="text-center align-middle">'.$user->account.'</td>
                <td class="text-center align-middle">
                    <img src="/uploads/avatars/'.$user->avatar.'" style="width: 70px; height: 70px; margin-left: 20%; border-radius: 50%" alt="Img">
                </td>
                <td class="text-center align-middle">'.$user->email.'</td>
                <td class="text-center align-middle">'.$quyen.'</td>
                <td class="text-center align-middle">
                    <a href="' . route('users.show', $user->id) . '"><i class="fa-solid fa-eye"></i></a>';

                    if (auth()->check() && auth()->user()->role == 0) {
                        $output .= '
                            <a href="' . route('users.edit', $user->id) . '"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="#" data-toggle="modal" data-target="#B'.$user->id.'"><i class="fa-solid fa-solid fa-trash"></i></a>

                            <!-- Modal -->
                            <div class="modal fade" id="B'.$user->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Xác nhận xóa</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Bạn chắc chắn muốn xóa người dùng: '.$user->name.' ?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                            <form action="' . route('users.destroy', $user->id) . '" method="POST">
                                                ' . csrf_field() . '
                                                ' . method_field("DELETE") . '
                                                <button type="submit" class="btn btn-primary">Xác nhận</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                    }
            $output .= '</td>
                </tr>';
        }
        return response($output);
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

}
