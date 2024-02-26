<?php

namespace App\Http\Controllers;

use App\Models\Chucvu;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChucvuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chucvus = Chucvu::orderBy('id', 'desc')->paginate(5);
        $startNumber = ($chucvus->currentPage() - 1) * $chucvus->perPage() + 1;

        return view('chucvu.index', compact('chucvus', 'startNumber'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('chucvu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Chucvu::create($request->all());
        Toastr::success('Thêm chức vụ thành công','Thông báo');
        return redirect()->route('chucvus.index');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $chucvu = Chucvu::find($id);
        $chucvu->delete();
        Toastr::success('Xóa chức vụ thành công','Thông báo');
        return redirect()->route('chucvus.index');
    }

    public function searchc(Request $request)
    {
        $i = 1;
        $output = "";

        $chucvus = DB::table('chucvus')
            ->where('tenChucVu', 'like', '%'.$request->search.'%')
            ->orderBy('id', 'desc')
            ->get();

        foreach($chucvus as $chucvu){

            $output .= '<tr>
                <td class="text-center align-middle">'.$i++.'</td>
                <td class="text-center align-middle">'.$chucvu->tenChucVu.'</td>
                <td class="text-center align-middle">
                    <a href="' . route('chucvus.show', $chucvu->id) . '"><i class="fa-solid fa-eye"></i></a>';

                    if (auth()->check() && auth()->user()->role == 0) {
                        $output .= '
                            <a href="' . route('chucvus.edit', $chucvu->id) . '"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="#" data-toggle="modal" data-target="#B'.$chucvu->id.'"><i class="fa-solid fa-solid fa-trash"></i></a>

                            <!-- Modal -->
                            <div class="modal fade" id="B'.$chucvu->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Xác nhận xóa</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Bạn chắc chắn muốn xóa chức vụ: '.$chucvu->tenChucVu.' ?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                            <form action="' . route('chucvus.destroy', $chucvu->id) . '" method="POST">
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
        $chucvus = Chucvu::orderBy('id', 'desc')->paginate(5);
        $startNumber = ($chucvus->currentPage() - 1) * $chucvus->perPage() + 1;
        return view('chucvu.pagination_chucvus', compact('chucvus', 'startNumber'))->render();
    }
}
