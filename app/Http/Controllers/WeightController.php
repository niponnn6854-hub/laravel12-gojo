<?php

namespace App\Http\Controllers;

use App\Models\Weight;
use Illuminate\Http\Request;

class WeightController extends Controller
{
    // แสดงรายการน้ำหนักทั้งหมด (เรียงล่าสุดก่อน)
    public function index()
    {
        $weights = Weight::orderBy('recorded_at', 'desc')->get();

        return view('weights.index', compact('weights'));
    }

    // แสดงฟอร์มเพิ่มข้อมูล
    public function create()
    {
        return view('weights.create');
    }

    // บันทึกข้อมูลใหม่ลงฐานข้อมูล
    public function store(Request $request)
    {
        $data = $request->validate([
            'weight'      => 'required|numeric|min:1|max:500',
            'recorded_at' => 'required|date',
            'note'        => 'nullable|string|max:255',
        ], [
            'weight.required'      => 'กรุณากรอกน้ำหนัก',
            'weight.numeric'       => 'น้ำหนักต้องเป็นตัวเลข',
            'recorded_at.required' => 'กรุณาเลือกวันที่',
            'recorded_at.date'     => 'รูปแบบวันที่ไม่ถูกต้อง',
        ]);

        Weight::create($data);

        return redirect()->route('weights.index')->with('success', 'บันทึกข้อมูลน้ำหนักเรียบร้อยแล้ว!');
    }

    // แสดงฟอร์มแก้ไขข้อมูล
    public function edit(Weight $weight)
    {
        return view('weights.edit', compact('weight'));
    }

    // อัปเดตข้อมูลที่แก้ไข
    public function update(Request $request, Weight $weight)
    {
        $data = $request->validate([
            'weight'      => 'required|numeric|min:1|max:500',
            'recorded_at' => 'required|date',
            'note'        => 'nullable|string|max:255',
        ], [
            'weight.required'      => 'กรุณากรอกน้ำหนัก',
            'weight.numeric'       => 'น้ำหนักต้องเป็นตัวเลข',
            'recorded_at.required' => 'กรุณาเลือกวันที่',
            'recorded_at.date'     => 'รูปแบบวันที่ไม่ถูกต้อง',
        ]);

        $weight->update($data);

        return redirect()->route('weights.index')->with('success', 'แก้ไขข้อมูลเรียบร้อยแล้ว!');
    }

    // ลบข้อมูล
    public function destroy(Weight $weight)
    {
        $weight->delete();

        return redirect()->route('weights.index')->with('success', 'ลบข้อมูลเรียบร้อยแล้ว!');
    }
}