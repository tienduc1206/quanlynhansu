<?php

namespace App\Http\Controllers;

use App\Models\Degree;
use Illuminate\Http\Request;

class DegreeController extends Controller
{
    private $degree;
    public function __construct(Degree $degree)
    {
        $this->degree = $degree;
    }
    public function index()
    {
        return view('degrees.index');
    }

    public function allData()
    {
        $data = $this->degree->orderBy('id', 'DESC')->get();
        return response()->json($data);
    }
    public function store(Request $request)
    {
        $validate = $request->validate([
            'degreeCode' => 'required',
            'degreeName' => 'required|unique:degrees,degree_name'
        ], [
            'degreeName.required' => "Tên bằng cấp không được để trống!",
            'degreeName.unique' => "Tên bằng cấp đã tồn tại!"
        ]);

        $data = $this->degree->create([
            'degree_code' => $request->degreeCode,
            'degree_name' => $request->degreeName
        ]);
        return response()->json($data);
    }

    public function edit(Request $request)
    {
        $data = $this->degree->find($request->id);
        return response()->json($data);
    }

    public function update(Request $request)
    {
        $request->validate([
            'degreeCode' => 'required',
            'degreeName' => 'required'
        ]);
        $data = $this->degree->find($request->id)->update([
            'degree_code' => $request->degreeCode,
            'degree_name' => $request->degreeName
        ]);
        return response()->json($data);
    }

    public function delete(Request $request)
    {
        $data = $this->degree->find($request->id)->delete();
        return response()->json($data);
    }
}
