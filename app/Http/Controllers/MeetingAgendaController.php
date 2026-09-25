<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\MeetingAgenda;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MeetingAgendaController extends Controller
{
    public function store(Request $request, Meeting $meeting): RedirectResponse
    {
        $data = $request->validate([
            'topic' => 'required|string|max:255',
            'detail' => 'nullable|string',
        ]);

        $nextOrder = $meeting->agendas()->max('order') + 1;

        $meeting->agendas()->create([
            'order' => $nextOrder,
            'topic' => $data['topic'],
            'detail' => $data['detail'] ?? null,
        ]);

        return redirect()->route('meetings.show', $meeting)->with('success', 'เพิ่มวาระการประชุมเรียบร้อยแล้ว');
    }

    public function destroy(MeetingAgenda $agenda): RedirectResponse
    {
        $meeting = $agenda->meeting;
        $agenda->delete();

        return redirect()->route('meetings.show', $meeting)->with('success', 'ลบวาระการประชุมเรียบร้อยแล้ว');
    }
}
