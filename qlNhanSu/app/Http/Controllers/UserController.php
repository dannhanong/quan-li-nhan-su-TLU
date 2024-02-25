<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\alert;

use Brian2694\Toastr\Facades\Toastr;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::orderBy('id', 'desc')->paginate(5);
        // $users = User::orderBy('id', 'desc')->get();

        $startNumber = ($users->currentPage() - 1) * $users->perPage() + 1;

        return view('user.index', compact('users', 'startNumber'));
        // return view('user.index', compact('users'));

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
        Toastr::success('Thêm tài khoản thành công','Thông báo');
        return redirect()->route('users.index');
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
        $startNumber = ($users->currentPage() - 1) * $users->perPage() + 1;
        return view('user.pagination_users', compact('users', 'startNumber'))->render();
    }

}
