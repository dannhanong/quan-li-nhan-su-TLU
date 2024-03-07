<?php

namespace App\Http\Controllers;

use App\Models\Bikiluat;
use App\Models\Nhansu;
use Illuminate\Http\Request;

class BikiluatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('bikiluat.index');
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
    public function show(Request $request)
    {
        $id = $request->id;
        $nhansu = Nhansu::where('Manhansu', $id)->first();
        return response()->json($nhansu);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $bikiluat = Bikiluat::find($id);
        return response()->json($bikiluat);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bikiluat $bikiluat)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $bikiluat = Bikiluat::find($id);
        $bikiluat->delete();
        return response()->json([

        ]);
    }
    public function fetchBiKiLuat()
    {
        $bikiluats = Bikiluat::orderByDesc('id')->get();
        $i = $bikiluats->count() - $bikiluats->count();
        $output = '';
        if($bikiluats->count() > 0){
            $output .= '<table class="table table-bordered" id="bikiluatTable" style="width: 100%">
            <thead>
                <tr>
                    <th class="text-center align-middle">STT</th>
                    <th class="text-center align-middle">Mã kỉ luật</th>
                    <th class="text-center align-middle">Mã nhân viên</th>
                    <th class="text-center align-middle">Lí do</th>
                    <th class="text-center align-middle">Mức độ</th>
                    <th class="text-center align-middle">Thao tác</th>
                </tr>
            </thead>

            <tbody>';

            foreach ($bikiluats as $bikiluat){
                $i++;
                $output .= '<tr id="row_{{ $kiluat->id }}">
                    <td class="text-center align-middle">'.$i.'</td>
                    <td class="text-center align-middle">'.$bikiluat->maKiLuat.'</td>
                    <td class="text-center align-middle">'.$bikiluat->Manhansu.'</td>
                    <td class="text-center align-middle">'.$bikiluat->Lido.'</td>
                    <td class="text-center align-middle">'.$bikiluat->MucDo.'</td>
                    <td class="text-center align-middle">
                        <a id="aShowkiluat" data-id_show="'.$bikiluat->Manhansu.'" href="#" data-toggle="modal" data-target="#showNhansuModal"><i class="fa-solid fa-eye"></i></a> ';
                        if (auth()->check() && auth()->user()->role == 0) {
                            $output .= '<a id="aEditkiluat" data-id_edit="'.$bikiluat->id.'" href="#" data-toggle="modal" data-target="#editKiLuatModal"><i class="fa-solid fa-pen-to-square"></i></a>

                                        <a id="aDeletekiluat" data-id_xoa="'.$bikiluat->id.'" href="#" data-toggle="modal" data-target="#deletekiluatModal"><i class="fa-solid fa-solid fa-trash"></i></a>';
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
}
