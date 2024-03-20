<?php

namespace App\Http\Controllers;

use App\Models\Tangluong;
use App\Models\Nhansu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TangluongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tangluong.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $nhansus=Nhansu::all();
        return view("tangluong.create", compact('nhansus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Tangluong::create($request->all());

        return response()->json([

        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id = $request->id;
        $tangluong = Tangluong::find($id);
        return response()->json($tangluong);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $tangluong = Tangluong::find($id);
        return response()->json($tangluong);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tangluong = Tangluong::find($id);
        $tangluong->update($request->all());
        return response()->json([
            'status' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $tangluong = Tangluong::find($id);
        $tangluong->delete();
        return response()->json([

        ]);
    }
    public function fetchTangLuong()
    {
        $tangluongs = Tangluong::orderByDesc('id')->get();
        $i = $tangluongs->count() - $tangluongs->count();
        $output = '';
        if($tangluongs->count() > 0){
            $output .= '<table class="table table-bordered" id="tangluongTable" style="width: 100%">
            <thead>
                <tr>
                    <th class="text-center align-middle">STT</th>
                    <th class="text-center align-middle">Mã tăng lương</th>
                    <th class="text-center align-middle">Mã nhân sự</th>
                    <th class="text-center align-middle">Lí do tăng lương</th>
                    <th class="text-center align-middle">Ngày tăng lương</th>
                    <th class="text-center align-middle">Thao tác</th>
                </tr>
            </thead>

            <tbody>';

            foreach ($tangluongs as $tangluong){
                $i++;
                $output .= '<tr id="row_{{ $kiluat->id }}">
                    <td class="text-center align-middle">'.$i.'</td>
                    <td class="text-center align-middle">'.$tangluong->maTangLuong.'</td>
                    <td class="text-center align-middle">'.$tangluong->mans.'</td>
                    <td class="text-center align-middle">'.$tangluong->lidotangluong.'</td>
                    <td class="text-center align-middle">'.$tangluong->ngaytangluong.'</td>
                    <td class="text-center align-middle">
                        <a id="aShowkiluat" data-id_show="'.$tangluong->id.'" href="#" data-toggle="modal" data-target="#showkiluatModal"><i class="fa-solid fa-eye"></i></a> ';
                        if (auth()->check() && auth()->user()->role == 0) {
                            $output .= '<a id="aEditkiluat" data-id_edit="'.$tangluong->id.'" href="#" data-toggle="modal" data-target="#editKiLuatModal"><i class="fa-solid fa-pen-to-square"></i></a>

                                        <a id="aDeletekiluat" data-id_xoa="'.$tangluong->id.'" href="#" data-toggle="modal" data-target="#deletekiluatModal"><i class="fa-solid fa-solid fa-trash"></i></a>';
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
    public function check_maTangLuong_unique(Request $request){
        if($request->maTangLuong!=""){
            if (Tangluong::where('maTangLuong', $request->maTangLuong)->exists()) {
                return "b";
            }else if(Str::contains($request->maTangLuong, ['!','@', '#', '$', '%', '^', '&', '*', '(', ')', '-', '_', '=', '+', '[', ']', '{', '}', ';', ':', '"', '\'', '<', '>', ',', '.', '/', '?', '\\', '|'])){
                return "c";
            }
        }
    }
    public function check_ngaytangluong(Request $request){
        $nhansu = Nhansu::where("Manhansu", $request->mans)->first();
        if($request->ngaytangluong!="" && $nhansu->Ngaybatdau>=$request->ngaytangluong){
            //return response()->json([$request->ngaytangluong,$nhansu->Ngaybatdau,"ko hop le"]);
            return "ko hop le";
        }
    }
}
