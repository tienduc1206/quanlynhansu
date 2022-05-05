<?php

namespace App\Http\Controllers;

use App\Models\NhanVien;
use App\Models\PhongBan;
use App\Traits\StorageImageTrait;
use App\Http\Requests\EmployeeRequest;
use App\Models\Degree;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\Datatables\Datatables;

class NhanvienController extends Controller
{
    use StorageImageTrait;
    private $nhanVien;
    private $phongBan;
    private $degree;
    private $perPage = 5;
    public function __construct(NhanVien $nhanVien, PhongBan $phongBan, Degree $degree)
    {
        $this->nhanVien = $nhanVien;
        $this->phongBan = $phongBan;
        $this->degree = $degree;
    }
    public function index()
    {
        $listPhongBan = $this->phongBan->all();
        $listDegree = $this->degree->all();
        $totalNhanVien = $this->nhanVien->count();
        $perPage = $this->perPage;
        return view('nhanviens.index', compact('listPhongBan', 'listDegree', 'totalNhanVien', 'perPage'));
    }

    public function allData(Request $request)
    {
        $search = $request->search;
        if ($search != '') {
            $data = $this->nhanVien
                ->orderBy('id', 'DESC')
                ->where('ten_nv', 'LIKE', '%' . $search . '%')
                ->orWhere('noi_sinh', 'LIKE', '%' . $search . '%')
                // ->where('ten_nv', 'LIKE', '%' . $search . '%')
                ->paginate(5);
        } else {
            $data = $this->nhanVien->orderBy('id', 'DESC')->paginate(5);
        }

        foreach ($data as $key => $dataItem) {
            if ($this->phongBan->find($dataItem['phongban_id'])) {
                $dataItem['bangcap_id'] = $dataItem->degree->degree_name;
            } else {
                $dataItem['bangcap_id'] = "";
            }
            if ($this->phongBan->find($dataItem['phongban_id'])) {
                $dataItem['phongban_id'] = $dataItem->phongBan->ten_phong_ban;
            } else {
                $dataItem['phongban_id'] = "";
            }
            if ($dataItem['gioi_tinh'] == 0) {
                $dataItem['gioi_tinh'] = 'Nam';
            } else {
                $dataItem['gioi_tinh'] = 'Nữ';
            }
            $date = Carbon::create($dataItem['ngay_sinh']);
            $dataItem['ngay_sinh'] = $date->format('d/m/Y');
        }
        return response()->json($data);
    }

    public function store(EmployeeRequest $request)
    {
        $dataCreate = [
            'ten_nv' => $request->employeeName,
            'ma_nv' => $request->employeeCode,
            'gioi_tinh' => $request->gender,
            'ngay_sinh' => $request->birthday,
            'noi_sinh' => $request->address,
            'phongban_id' => $request->phongban_id,
            'bangcap_id' => $request->bangcap_id
        ];

        $dataImageUpload = $this->storageTraitUpLoad($request, 'imageEmployee', 'nhanvien');
        if (!empty($dataImageUpload)) {
            $dataCreate['image_path'] = $dataImageUpload['file_path'];
            $dataCreate['image_name'] = $dataImageUpload['file_name'];
        }
        $data = $this->nhanVien->create($dataCreate);

        return response()->json($data);
    }

    public function edit(Request $request)
    {
        $data = $this->nhanVien->find($request->id);
        return response()->json($data);
    }
    public function update(Request $request)
    {
        $dataCreate = [
            'ten_nv' => $request->employeeNameEdit,
            'ma_nv' => $request->employeeCodeEdit,
            'gioi_tinh' => $request->genderEdit,
            'ngay_sinh' => $request->birthdayEdit,
            'noi_sinh' => $request->addressEdit,
            'phongban_id' => $request->phongban_idEdit,
            'bangcap_id' => $request->bangcap_idEdit
        ];
        $dataImageUpload = $this->storageTraitUpLoad($request, 'imageEmployee', 'nhanvien');
        if (!empty($dataImageUpload)) {
            $dataCreate['image_path'] = $dataImageUpload['file_path'];
            $dataCreate['image_name'] = $dataImageUpload['file_name'];
        }
        $data = $this->nhanVien->where('ma_nv', $request->employeeCodeEdit)->update($dataCreate);;
        return response()->json($data);
    }

    public function delete(Request $request)
    {
        $data = $this->nhanVien->find($request->id)->delete();
        return response()->json($data);
    }
}
