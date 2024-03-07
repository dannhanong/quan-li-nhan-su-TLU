<?php

namespace App\Http\Controllers;

use App\Models\Chucvu;
use App\Models\Khoa;
use Illuminate\Http\Request;
use App\Models\Nhansu;
use App\Models\Phongban;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class NhansuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('nhansu.index');
    }

    public function fetchNhansu()
    {
        // $nhansus = Nhansu::orderByDesc('id')->get();
        $nhansus = DB::table('nhansus')
        ->join('phongbans', 'phongbans.id', '=', 'nhansus.Maphongban')
        ->join('chucvus', 'chucvus.id', '=', 'nhansus.Machucvu')
        ->join('khoas', 'khoas.id', '=', 'nhansus.Makhoa')
        ->select('nhansus.id', 'Manhansu', 'Hoten', 'Ngaysinh', 'Gioitinh', 'CCCD',
        'Ngaybatdau', 'Diachi', 'SDT', 'Quequan', 'phongbans.tenPhongBan',
        'chucvus.tenChucVu', 'khoas.tenKhoa', 'Anhdaidien', 'nhansus.email',
        'Hesoluong', 'Bacluong')
        ->orderBy("nhansus.id", "desc")
        ->get();
        $i =  $nhansus->count() - $nhansus->count();
        $output = '';
        if($nhansus->count() > 0){
            $output .= '<table class="table table-bordered" id="nhansuTable" style="width: 100%">
            <thead>
                <tr>
                    <th class="text-center align-middle">STT</th>
                    <th class="text-center align-middle">Mã nhân sự</th>
                    <th class="text-center align-middle">Ảnh đại diện</th>
                    <th class="text-center align-middle">Họ tên</th>
                    <th class="text-center align-middle">Giới tính</th>
                    <th class="text-center align-middle">CCCD</th>
                    <th class="text-center align-middle">Ngày bắt đầu</th>
                    <th class="text-center align-middle">Phòng ban</th>
                    <th class="text-center align-middle">Chức vụ</th>
                    <th class="text-center align-middle">Khoa</th>
                    <th class="text-center align-middle">Thao tác</th>
                </tr>
            </thead>

            <tbody>';

            foreach ($nhansus as $nhansu){
                // if($nhansu->account != Auth::nhansu()->account){
                    if($nhansu->Gioitinh == true){
                        $gioitinh = "Nam";
                    }else{
                        $gioitinh = "Nữ";
                    }
                    $i++;
                    $output .= '<tr id="row_{{ $nhansu->id }}">
                        <td class="text-center align-middle">'.$i.'</td>
                        <td class="text-center align-middle">'.$nhansu->Manhansu.'</td>
                        <td class="text-center align-middle">
                            <div style="display: inline-block; text-align: center;">
                                <img src="/uploads/avatars/'.$nhansu->Anhdaidien.'" style="width: 100px; height: 100px;" alt="Img">
                            </div>
                        </td>
                        <td class="text-center align-middle">'.$nhansu->Hoten.'</td>
                        <td class="text-center align-middle">'.$gioitinh.'</td>
                        <td class="text-center align-middle">'.$nhansu->CCCD.'</td>
                        <td class="text-center align-middle">'.$nhansu->Ngaybatdau.'</td>
                        <td class="text-center align-middle">'.$nhansu->tenPhongBan.'</td>
                        <td class="text-center align-middle">'.$nhansu->tenChucVu.'</td>
                        <td class="text-center align-middle">'.$nhansu->tenKhoa.'</td>
                        <td class="text-center align-middle">
                            <a id="aShowNhansu" data-id_show="'.$nhansu->id.'" href="#" data-toggle="modal" data-target="#showNhansuModal"><i class="fa-solid fa-eye"></i></a> ';
                            if (auth()->check() && auth()->user()->role == 0) {
                                $output .= '<a id="aEditNhansu" data-id_edit="'.$nhansu->id.'" href="#" data-toggle="modal" data-target="#editNhansuModal"><i class="fa-solid fa-pen-to-square"></i></a>

                                            <a id="aDeleteNhansu" data-id_xoa="'.$nhansu->id.'" href="#" data-toggle="modal" data-target="#deleteNhansuModal"><i class="anhansu fa-solid fa-solid fa-trash"></i></a>';
                            }
                        $output .= '</td>
                    </tr>';
                // }
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
        $khoas = Khoa::select('id', 'tenKhoa')->get();
        $phongbans = Phongban::select('id', 'tenPhongBan')->get();
        $chucvus = Chucvu::select('id', 'tenChucVu')->get();
        return view('nhansu.create', compact('khoas', 'phongbans', 'chucvus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->hasFile('Anhdaidien')){
            $Anhdaidien = $request->file('Anhdaidien');
            $filename = time() . '.' . $Anhdaidien->getClientOriginalExtension();
            Image::make($Anhdaidien)->resize(300, 300)->save( public_path('uploads/avatars/' . $filename) );
            // $Anhdaidien->storeAs('public/uploads/Anhdaidiens', $filename);

            $nhansuData = ['Manhansu' => $request->Manhansu, 'Hoten' => $request->Hoten,
            'Ngaysinh' => $request->Ngaysinh, 'Gioitinh' => $request->Gioitinh,'CCCD' => $request->CCCD,
            'Ngaybatdau' => $request->Ngaybatdau, 'Diachi' => $request->Diachi, 'SDT' => $request->SDT,
            'Quequan' => $request->Quequan, 'Maphongban' => $request->Maphongban, 'MaChucVu' => $request->MaChucVu,
            'Makhoa' => $request->Makhoa, 'Bacluong' => $request->Bacluong, 'Anhdaidien' => $filename, 'email' => $request->email
            ];
            Nhansu::create($nhansuData);
            return response()->json([
                'status' => true
            ]);
        }else{
            Nhansu::create($request->all());
            return response()->json([
                'status' => true
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id = $request->id;
        $nhansu = Nhansu::find($id);
        return response()->json($nhansu);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

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
}
