<?php

namespace App\Http\Controllers;

use App\Models\Kiluat;
use App\Models\Nhansu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;

class KiluatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('kiluat.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $nhansus=Nhansu::all();
        return view("kiluat.create", compact('nhansus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Kiluat::create($request->all());

        return response()->json([

        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id = $request->id;
        $kiluat = Kiluat::find($id);
        return response()->json($kiluat);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $kiluat = Kiluat::find($id);
        return response()->json($kiluat);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kiluat = Kiluat::find($id);
        $kiluat->update($request->all());
        return response()->json([
            'status' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $kiluat = Kiluat::find($id);
        $kiluat->delete();
        return response()->json([

        ]);
    }
    public function fetchKiLuat()
    {
        $kiluats = Kiluat::orderByDesc('id')->get();
        $i = $kiluats->count() - $kiluats->count();
        $output = '';
        if($kiluats->count() > 0){
            $output .= '<table class="table table-bordered" id="kiluatTable" style="width: 100%">
            <thead>
                <tr>
                    <th class="text-center align-middle">STT</th>
                    <th class="text-center align-middle">Mã kỉ luật</th>
                    <th class="text-center align-middle">Mã nhân sự</th>
                    <th class="text-center align-middle">Lí do</th>
                    <th class="text-center align-middle">Ngày kỉ luật</th>
                    <th class="text-center align-middle">Thao tác</th>
                </tr>
            </thead>

            <tbody>';

            foreach ($kiluats as $kiluat){
                $i++;
                $output .= '<tr id="row_{{ $kiluat->id }}">
                    <td class="text-center align-middle">'.$i.'</td>
                    <td class="text-center align-middle">'.$kiluat->maKiLuat.'</td>
                    <td class="text-center align-middle">'.$kiluat->mans.'</td>
                    <td class="text-center align-middle">'.$kiluat->lidokiluat.'</td>
                    <td class="text-center align-middle">'.$kiluat->ngaykiluat.'</td>
                    <td class="text-center align-middle">
                        <a id="aShowkiluat" data-id_show="'.$kiluat->id.'" href="#" data-toggle="modal" data-target="#showkiluatModal"><i class="fa-solid fa-eye"></i></a> ';
                        if (auth()->check() && auth()->user()->role == 0) {
                            $output .= '<a id="aEditkiluat" data-id_edit="'.$kiluat->id.'" href="#" data-toggle="modal" data-target="#editKiLuatModal"><i class="fa-solid fa-pen-to-square"></i></a>

                                        <a id="aDeletekiluat" data-id_xoa="'.$kiluat->id.'" href="#" data-toggle="modal" data-target="#deletekiluatModal"><i class="fa-solid fa-solid fa-trash"></i></a>';
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

    public function check_maKiLuat_unique(Request $request){
        if($request->maKiLuat!=""){
            if (Kiluat::where('maKiLuat', $request->maKiLuat)->exists()) {
                return "b";
            }else if(Str::contains($request->maKiLuat, ['!','@', '#', '$', '%', '^', '&', '*', '(', ')', '-', '_', '=', '+', '[', ']', '{', '}', ';', ':', '"', '\'', '<', '>', ',', '.', '/', '?', '\\', '|'])){
                return "c";
            }
        }
    }

    public function check_ngaykiluat(Request $request){
        $nhansu = Nhansu::where("Manhansu", $request->mans)->first();
        if($request->ngaykiluat!="" && $nhansu->Ngaybatdau>=$request->ngaykiluat){
            return "ko hop le";
        }
    }
}
