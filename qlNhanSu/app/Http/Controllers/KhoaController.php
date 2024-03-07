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
        return view('khoa.index');
    }

    public function fetchKhoa()
    {
        $khoas = Khoa::orderByDesc('id')->get();

        $i = $khoas->count() - $khoas->count();
        $output = '';
        if($khoas->count() > 0){
            $output .= '<table class="table table-bordered" id="khoaTable" style="width: 100%">
            <thead>
                <tr>
                    <th class="text-center align-middle">STT</th>
                    <th class="text-center align-middle">Mã khoa</th>
                    <th class="text-center align-middle">Tên khoa</th>
                    <th class="text-center align-middle">Thao tác</th>
                </tr>
            </thead>

            <tbody>';

            foreach ($khoas as $khoa){
                $i++;
                $output .= '<tr id="row_{{ $khoa->id }}">
                    <td class="text-center align-middle">'.$i.'</td>
                    <td class="text-center align-middle">'.$khoa->maKhoa.'</td>
                    <td class="text-center align-middle">'.$khoa->tenKhoa.'</td>
                    <td class="text-center align-middle">
                        <a id="aShowKhoa" data-id_show="'.$khoa->id.'" href="#" data-toggle="modal" data-target="#showKhoaModal"><i class="fa-solid fa-eye"></i></a> ';
                        if (auth()->check() && auth()->user()->role == 0) {
                            $output .= '<a id="aEditKhoa" data-id_edit="'.$khoa->id.'" href="#" data-toggle="modal" data-target="#editKhoaModal"><i class="fa-solid fa-pen-to-square"></i></a>

                                        <a id="aDeleteKhoa" data-id_xoa="'.$khoa->id.'" href="#" data-toggle="modal" data-target="#deleteKhoaModal"><i class="fa-solid fa-solid fa-trash"></i></a>';
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
        return view('khoa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Khoa::create($request->all());
        return response()->json([
            'status' => true
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id = $request->id;
        $khoa = Khoa::find($id);
        return response()->json($khoa);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $khoa = Khoa::find($id);
        return response()->json($khoa);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $khoa = Khoa::find($id);
        $khoa->update($request->all());
        return response()->json([
            'status' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $khoa = Khoa::find($id);
        $khoa->delete();
        return response()->json([
        ]);
    }

    public function check_makhoa_unique(Request $request){
        if($request->maKhoaF == $request->maKhoa){
            echo 'true';
        }else{
            $khoa = Khoa::where('maKhoa', $request->maKhoa)->first();
            if($khoa){
                echo 'false';
            }else{
                echo 'true';
            }
        }
    }

    public function getTenKhoa(Request $request){
        $khoa = Khoa::find($request->id);
        return response()->json($khoa);
    }
}
