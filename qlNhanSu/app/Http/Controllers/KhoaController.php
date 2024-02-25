<?php

namespace App\Http\Controllers;

use App\Models\Khoa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KhoaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $khoas = Khoa::orderBy('id', 'desc')->paginate(5);
        $startNumber = ($khoas->currentPage() - 1) * $khoas->perPage() + 1;

        return view('khoa.index', compact('khoas', 'startNumber'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    public function search(Request $request)
    {
        $i = 1;
        $output = "";

        $khoas = DB::table('khoas')
            ->where('tenKhoa', 'like', '%'.$request->search.'%')
            ->orderBy('id', 'desc')
            ->get();

        foreach($khoas as $khoa){

            $output .= '<tr>
                <td class="text-center align-middle">'.$i++.'</td>
                <td class="text-center align-middle">'.$khoa->tenKhoa.'</td>
                <td class="text-center align-middle">
                    <a href="' . route('khoas.show', $khoa->id) . '"><i class="fa-solid fa-eye"></i></a>';

                    if (auth()->check() && auth()->user()->role == 0) {
                        $output .= '
                            <a href="' . route('khoas.edit', $khoa->id) . '"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="#" data-toggle="modal" data-target="#B'.$khoa->id.'"><i class="fa-solid fa-solid fa-trash"></i></a>

                            <!-- Modal -->
                            <div class="modal fade" id="B'.$khoa->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Xác nhận xóa</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Bạn chắc chắn muốn xóa khoa: '.$khoa->tenKhoa.' ?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                            <form action="' . route('khoas.destroy', $khoa->id) . '" method="POST">
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
}
