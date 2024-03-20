<?php

namespace App\Http\Controllers;

use App\Models\Phongban;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use function Laravel\Prompts\error;
use Illuminate\Support\Str;

class PhongbanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("phongban.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("phongban.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Phongban::create($request->all());

        return response()->json([

        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id = $request->id;
        $phongban = Phongban::find($id);
        return response()->json($phongban);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $phongban = Phongban::find($id);
        return response()->json($phongban);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $phongban = Phongban::find($id);
        $phongban->update($request->all());
        return response()->json([
            'status' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $phongban = Phongban::find($id);
        $phongban->delete();
        return response()->json([

        ]);
    }
    public function fetchPhongBan()
    {
        $phongbans = Phongban::orderByDesc('id')->get();
        $i = $phongbans->count() - $phongbans->count();
        $output = '';
        if($phongbans->count() > 0){
            $output .= '<table class="table table-bordered" id="phongbanTable" style="width: 100%">
            <thead>
                <tr>
                    <th class="text-center align-middle">STT</th>
                    <th class="text-center align-middle">Mã phòng ban</th>
                    <th class="text-center align-middle">Tên phòng ban</th>
                    <th class="text-center align-middle">Thao tác</th>
                </tr>
            </thead>

            <tbody>';

            foreach ($phongbans as $phongban){
                $i++;
                $output .= '<tr id="row_{{ $phongban->id }}">
                    <td class="text-center align-middle">'.$i.'</td>
                    <td class="text-center align-middle">'.$phongban->maPhongBan.'</td>
                    <td class="text-center align-middle">'.$phongban->tenPhongBan.'</td>
                    <td class="text-center align-middle">
                        <a id="aShowPhongban" data-id_show="'.$phongban->id.'" href="#" data-toggle="modal" data-target="#showPhongbanModal"><i class="fa-solid fa-eye"></i></a> ';
                        if (auth()->check() && auth()->user()->role == 0) {
                            $output .= '<a id="aEditPhongban" data-id_edit="'.$phongban->id.'" href="#" data-toggle="modal" data-target="#editPhongbanModal"><i class="fa-solid fa-pen-to-square"></i></a>

                                        <a id="aDeletePhongban" data-id_xoa="'.$phongban->id.'" href="#" data-toggle="modal" data-target="#deletePhongbanModal"><i class="fa-solid fa-solid fa-trash"></i></a>';
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
    public function check_maPhongBan_unique(Request $request){
        if($request->maPhongBan!=""){
            if (Phongban::where('maPhongBan', $request->maPhongBan)->exists()) {
                return "b";
            }else if(Str::contains($request->maPhongBan, ['!','@', '#', '$', '%', '^', '&', '*', '(', ')', '-', '_', '=', '+', '[', ']', '{', '}', ';', ':', '"', '\'', '<', '>', ',', '.', '/', '?', '\\', '|'])){
                return "c";
            }
        }
    }

    public function check_tenPhongBan_unique(Request $request){
        if($request->tenPhongBan!=""){
            if (Phongban::where('tenPhongBan', $request->tenPhongBan)->exists()) {
                return "b";
            }else if(Str::contains($request->tenPhongBan, ['!','@', '#', '$', '%', '^', '&', '*', '(', ')', '-', '_', '=', '+', '[', ']', '{', '}', ';', ':', '"', '\'', '<', '>', ',', '.', '/', '?', '\\', '|'])){
                return "c";
            }
        }
    }

    public function getTenPhongban(Request $request){
        $phongban = Phongban::find($request->id);
        return response()->json($phongban);
    }
}
