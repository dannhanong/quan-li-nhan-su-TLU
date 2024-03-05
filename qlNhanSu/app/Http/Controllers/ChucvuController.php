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
        return view('chucvu.index');
    }

    public function fetchChucvu()
    {
        $chucvus = Chucvu::orderByDesc('id')->get();
        $i = $chucvus->count() - $chucvus->count();
        $output = '';
        if($chucvus->count() > 0){
            $output .= '<table class="table table-bordered" id="chucvuTable" style="width: 100%">
            <thead>
                <tr>
                    <th class="text-center align-middle">STT</th>
                    <th class="text-center align-middle">Mã chức vụ</th>
                    <th class="text-center align-middle">Tên chức vụ</th>
                    <th class="text-center align-middle">Thao tác</th>
                </tr>
            </thead>

            <tbody>';

            foreach ($chucvus as $chucvu){
                $i++;
                $output .= '<tr id="row_{{ $chucvu->id }}">
                    <td class="text-center align-middle">'.$i.'</td>
                    <td class="text-center align-middle">'.$chucvu->maChucVu.'</td>
                    <td class="text-center align-middle">'.$chucvu->tenChucVu.'</td>
                    <td class="text-center align-middle">
                        <a id="aShowChucvu" data-id_show="'.$chucvu->id.'" href="#" data-toggle="modal" data-target="#showChucvuModal"><i class="fa-solid fa-eye"></i></a> ';
                        if (auth()->check() && auth()->user()->role == 0) {
                            $output .= '<a id="aEditChucvu" data-id_edit="'.$chucvu->id.'" href="#" data-toggle="modal" data-target="#editChucvuModal"><i class="fa-solid fa-pen-to-square"></i></a>

                                        <a id="aDeleteChucvu" data-id_xoa="'.$chucvu->id.'" href="#" data-toggle="modal" data-target="#deleteChucvuModal"><i class="fa-solid fa-solid fa-trash"></i></a>';
                        }
                    $output .= '</td>
                </tr>';
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
        return view('chucvu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Chucvu::create($request->all());

        return response()->json([

        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id = $request->id;
        $chucvu = Chucvu::find($id);
        return response()->json($chucvu);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $chucvu = Chucvu::find($id);
        return response()->json($chucvu);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $chucvu = Chucvu::find($id);

        // $chucvuData = ['maChucVu' => $request->maChucVu, 'tenChucVu' => $request->tenChucVu];
        // $chucvu->update($chucvuData);
        $chucvu->update($request->all());
        return response()->json([
            'status' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $chucvu = Chucvu::find($id);
        $chucvu->delete();
        return response()->json([

        ]);
    }

    public function check_maChucVu_unique(Request $request){
        if($request->maChucVuF == $request->maChucVu){
            echo 'true';
        }else{
            $chucvu = Chucvu::where('maChucVu', $request->maChucVu)->first();
            if($chucvu){
                echo 'false';
            }else{
                echo 'true';
            }
        }
    }

    public function pagination(Request $request)
    {
        $chucvus = Chucvu::orderBy('id', 'desc')->paginate(5);
        $startNumber = ($chucvus->currentPage() - 1) * $chucvus->perPage() + 1;
        return view('chucvu.pagination_chucvus', compact('chucvus', 'startNumber'))->render();
    }
}
