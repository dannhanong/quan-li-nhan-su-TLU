<?php

namespace App\Http\Controllers;

use App\Models\Khenthuong;
use App\Models\Nhansu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KhenthuongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('khenthuong.index');
    }

    public function fetchKhenthuong()
    {
        $khenthuongs = DB::table('khenthuongs')
        ->join('nhansus', 'khenthuongs.Manhansu', '=', 'nhansus.Manhansu')
        ->select('khenthuongs.*', 'nhansus.Hoten')
        ->orderBy('khenthuongs.id', 'desc')
        ->get();

        $i = $khenthuongs->count() - $khenthuongs->count();
        $output = '';
        if($khenthuongs->count() > 0){
            $output .= '<table class="table table-bordered" id="khenthuongTable" style="width: 100%">
            <thead>
                <tr>
                    <th class="text-center align-middle">STT</th>
                    <th class="text-center align-middle">Mã nhân sự</th>
                    <th class="text-center align-middle">Tên nhân sự</th>
                    <th class="text-center align-middle">Ngày khen thưởng</th>
                    <th class="text-center align-middle">Lý do</th>
                    <th class="text-center align-middle">Chi tiết khen thưởng</th>
                    <th class="text-center align-middle">Thao tác</th>
                </tr>
            </thead>

            <tbody>';

            foreach ($khenthuongs as $khenthuong){
                $i++;
                $output .= '<tr id="row_{{ $khenthuong->id }}">
                    <td class="text-center align-middle">'.$i.'</td>
                    <td class="text-center align-middle">'.$khenthuong->Manhansu.'</td>
                    <td class="text-center align-middle">'.$khenthuong->Hoten.'</td>
                    <td class="text-center align-middle">'.$khenthuong->ngayKhenThuong.'</td>
                    <td class="text-center align-middle">'.$khenthuong->lyDo.'</td>
                    <td class="text-center align-middle">'.$khenthuong->chiTietKhenThuong.'</td>
                    <td class="text-center align-middle">
                        <a id="aShowKhenthuong" data-id_show="'.$khenthuong->id.'" href="#" data-toggle="modal" data-target="#showKhenthuongModal"><i class="fa-solid fa-eye"></i></a> ';
                        if (auth()->check() && auth()->user()->role == 0) {
                            $output .= '<a id="aEditKhenthuong" data-id_edit="'.$khenthuong->id.'" href="#" data-toggle="modal" data-target="#editKhenthuongModal"><i class="fa-solid fa-pen-to-square"></i></a>

                                        <a id="aDeleteKhenthuong" data-id_xoa="'.$khenthuong->id.'" href="#" data-toggle="modal" data-target="#deleteKhenthuongModal"><i class="fa-solid fa-solid fa-trash"></i></a>';
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
        $nhansus = Nhansu::select('id','Manhansu', 'Hoten')->get();
        return view('khenthuong.create', compact('nhansus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Khenthuong::create($request->all());
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
        $khenthuong = Khenthuong::select('khenthuongs.*', 'nhansus.Hoten')
        ->join('nhansus', 'khenthuongs.Manhansu', '=', 'nhansus.Manhansu')
        ->find($id);
        return response()->json($khenthuong);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $khenthuong = Khenthuong::find($id);
        return response()->json($khenthuong);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $khenthuong = Khenthuong::find($id);
        $khenthuong->update($request->all());
        return response()->json([
            'status' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $khenthuong = Khenthuong::find($id);
        $khenthuong->delete();
        return response()->json([
        ]);
    }

    public function getManhansuList(Request $request)
    {
        $query = $request->get('query');
        $suggestions = Nhansu::where('Manhansu', 'like', '%' . $query . '%')
        ->orWhere('Hoten', 'like', '%' . $query . '%')->limit(10)->get(['Manhansu', 'Hoten']);
        $formattedSuggestions = $suggestions->map(function ($item) {
            return $item['Manhansu'] . ' (' . $item['Hoten'] . ')';
        });
        return response()->json($formattedSuggestions);
    }

    public function getManhansuExists(Request $request){
        if(Nhansu::where('Manhansu', $request->Manhansu)->first()){
            echo 'true';
        }else{
            echo 'flase';
        }
    }
}
