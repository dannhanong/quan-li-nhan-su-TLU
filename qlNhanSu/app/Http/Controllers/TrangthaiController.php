<?php

namespace App\Http\Controllers;

use App\Models\Trangthai;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use function Laravel\Prompts\error;

class TrangthaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("trangthai.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("trangthai.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Trangthai::create($request->all());

        return response()->json([

        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id = $request->id;
        $trangthai = Trangthai::find($id);
        return response()->json($trangthai);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $trangthai = Trangthai::find($id);
        return response()->json($trangthai);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $trangthai = Trangthai::find($id);
        $trangthai->update($request->all());
        return response()->json([
            'status' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $trangthai = Trangthai::find($id);
        $trangthai->delete();
        return response()->json([

        ]);
    }
    public function fetchTrangThai()
    {
        $trangthais = Trangthai::orderByDesc('id')->get();
        $i = $trangthais->count() - $trangthais->count();
        $output = '';
        if($trangthais->count() > 0){
            $output .= '<table class="table table-bordered" id="trangthaiTable" style="width: 100%">
            <thead>
                <tr>
                    <th class="text-center align-middle">STT</th>
                    <th class="text-center align-middle">Mã trạng thái</th>
                    <th class="text-center align-middle">Tên trạng thái</th>
                    <th class="text-center align-middle">Thao tác</th>
                </tr>
            </thead>

            <tbody>';

            foreach ($trangthais as $trangthai){
                $i++;
                $output .= '<tr id="row_{{ $trangthai->id }}">
                    <td class="text-center align-middle">'.$i.'</td>
                    <td class="text-center align-middle">'.$trangthai->maTrangThai.'</td>
                    <td class="text-center align-middle">'.$trangthai->tenTrangThai.'</td>
                    <td class="text-center align-middle">
                        <a id="aShowTrangthai" data-id_show="'.$trangthai->id.'" href="#" data-toggle="modal" data-target="#showTrangthaiModal"><i class="fa-solid fa-eye"></i></a> ';
                        if (auth()->check() && auth()->user()->role == 0) {
                            $output .= '<a id="aEditTrangthai" data-id_edit="'.$trangthai->id.'" href="#" data-toggle="modal" data-target="#editTrangthaiModal"><i class="fa-solid fa-pen-to-square"></i></a>

                                        <a id="aDeleteTrangthai" data-id_xoa="'.$trangthai->id.'" href="#" data-toggle="modal" data-target="#deleteTrangthaiModal"><i class="fa-solid fa-solid fa-trash"></i></a>';
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
    public function check_maTrangThai_unique(Request $request){
        if (Trangthai::where('maTrangThai', $request->maTrangThai)->exists()) {
            echo "true";
        } else {
            echo "false";
        }
    }

    public function check_tenTrangThai_unique(Request $request){
        if (Trangthai::where('tenTrangThai', $request->tenTrangThai)->exists()) {
            echo "true";
        } else {
            echo "false";
        }
    }


    public function getTenTrangthai(Request $request){
        $trangthai = Trangthai::find($request->id);
        return response()->json($trangthai);
    }
}
