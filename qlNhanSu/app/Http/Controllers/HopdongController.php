<?php

namespace App\Http\Controllers;

use App\Models\Hopdong;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Nhansu;

class HopdongController extends Controller
{
    public function fetchHopdong()
    {
        $hopdongs = Hopdong::orderByDesc('id')->get();
        // $hopdongs = DB::table('hopdongs')
        // ->join('nhansus', 'hopdongs.Manhansu', '=', 'nhansus.Manhansu')
        // ->select('hopdongs.id', 'maHopdong','nhansus.HoTen','Ngaybatdau','Ngayketthuc','Ngayky','Lanky')
        // ->orderBy("hopdongs.id", "desc")
        // ->get();

        $i = $hopdongs->count() - $hopdongs->count();
        $output = '';
        if($hopdongs->count() > 0){
            $output .= '<table class="table table-bordered" id="hopdongTable" style="width: 100%">
            <thead>
                <tr>
                    <th class="text-center align-middle">STT</th>
                    <th class="text-center align-middle">Mã nhân sự</th>
                    <th class="text-center align-middle">Mã Hợp đồng</th>
                    <th class="text-center align-middle">Ngày bắt đầu</th>
                    <th class="text-center align-middle">Ngày kết thúc</th>
                    <th class="text-center align-middle">Ngày ký</th>
                    <th class="text-center align-middle">Lần ký</th>
                    <th class="text-center align-middle">Thao tác</th>
                </tr>
            </thead>

            <tbody>';

            foreach ($hopdongs as $hopdong){
                $i++;
                $output .= '<tr id="row_{{ $hopdong->id }}">
                    <td class="text-center align-middle">'.$i.'</td>
                    <td class="text-center align-middle">'.$hopdong->Manhansu.'</td>
                    <td class="text-center align-middle">'.$hopdong->maHopdong.'</td>
                    <td class="text-center align-middle">'.$hopdong->Ngaybatdau.'</td>
                    <td class="text-center align-middle">'.$hopdong->Ngayketthuc.'</td>
                    <td class="text-center align-middle">'.$hopdong->Ngayky.'</td>
                    <td class="text-center align-middle">'.$hopdong->Lanky.'</td>
                    <td class="text-center align-middle">
                        <a id="aShowHopdong" data-id_show="'.$hopdong->id.'" href="#" data-toggle="modal" data-target="#showHopDongModal"><i class="fa-solid fa-eye"></i></a> ';
                        if (auth()->check() && auth()->user()->role == 0) {
                            $output .= '<a id="aEditHopDong" data-id_edit="'.$hopdong->id.'" href="#" data-toggle="modal" data-target="#editHopDongModal"><i class="fa-solid fa-pen-to-square"></i></a>

                                        <a id="aDeleteHopDong" data-id_xoa="'.$hopdong->id.'" href="#" data-toggle="modal" data-target="#deleteHopDongModal"><i class="fa-solid fa-solid fa-trash"></i></a>';
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
     * Display a listing of the resource.
     */
    public function index()
    {

        $nhansus = Nhansu::select('id', 'Manhansu')->get();
        return view('hopdong.index', compact('nhansus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('hopdong.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Hopdong::create($request->all());
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
        $hopdong = Hopdong::find($id);
        return response()->json($hopdong);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $hopdong = Hopdong::find($id);
        return response()->json($hopdong);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $hopdong = Hopdong::find($id);

        // $chucvuData = ['maChucVu' => $request->maChucVu, 'tenChucVu' => $request->tenChucVu];
        // $chucvu->update($chucvuData);
        $hopdong->update($request->all());
        return response()->json([
            'status' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hopdong = Hopdong::find($id);
        $hopdong->delete();
        return response()->json([

        ]);
    }

public function pagination(Request $request)
    {
        $hopdongs = Hopdong::orderBy('id', 'desc')->paginate(5);
        $startNumber = ($hopdongs->currentPage() - 1) * $hopdongs->perPage() + 1;
        return view('hopdong.pagination_hopdongs', compact('hopdongs', 'startNumber'))->render();
    }

    public function getTenHopdong(Request $request){
        $hopdong = Hopdong::find($request->id);
        return response()->json($hopdong);
    }
}
