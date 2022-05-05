<?php

namespace App\Http\Controllers;

use App\Models\PhongBan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PhongBanController extends Controller
{
    private $phongBan;
    public function __construct(PhongBan $phongBan)
    {
        $this->phongBan = $phongBan;
    }

    public function index()
    {
        return view('phongbans.index');
    }
    public function allData()
    {
        $data = $this->phongBan->orderBy('id', 'DESC')->get();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'maPhongBan' => 'required',
            'tenPhongBan' => 'required|unique:phong_bans,ten_phong_ban'
        ], [
            'maPhongBan.required' => 'Mã phòng ban không được để trống!',
            'tenPhongBan.required' => 'Tên phòng ban không được để trống!',
            'tenPhongBan.unique' => 'Tên phòng ban đã tồn tại!'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $this->phongBan->create([
                'ma_phong_ban' => $request->maPhongBan,
                'ten_phong_ban' => $request->tenPhongBan
            ]);
            return response()->json([
                'status' => 1,
                'msg' => 'Thêm mới phòng ban thành công'
            ]);
        }
    }

    public function edit(Request $request)
    {
        $data = $this->phongBan->find($request->id);
        return response()->json($data);
    }

    public function update(Request $request)
    {
        $request->validate([
            'maPhongBan' => 'required',
            'tenPhongBan' => 'required'
        ], [
            'tenPhongBan.required' => 'Tên phòng ban không được để trống!'
        ]);
        $data = $this->phongBan->find($request->id)->update([
            'ma_phong_ban' => $request->maPhongBan,
            'ten_phong_ban' => $request->tenPhongBan
        ]);
        return response()->json($data);
    }

    public function delete(Request $request)
    {
        $data = $this->phongBan->find($request->id)->delete();
        return response()->json($data);
    }
}
