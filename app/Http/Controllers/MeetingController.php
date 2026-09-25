<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\Room;
use App\Models\User;
use App\Notifications\MeetingInvitationNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class MeetingController extends Controller
{
    public function index(): View
    {
        $meetings = Meeting::with(['room', 'organizer'])
            ->latest('start_time')
            ->paginate(10);

        return view('meetings.index', compact('meetings'));
    }

    public function create(): View
    {
        $rooms = Room::where('is_active', true)->get();
        $users = User::all();

        return view('meetings.create', compact('rooms', 'users'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateMeeting($request);

        $meeting = Meeting::create([
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'room_id' => $data['room_id'],
            'organizer_id' => auth()->id(),
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'status' => 'scheduled',
        ]);

        // ผูกผู้เข้าร่วม + ส่งอีเมลแจ้งเตือนจริง
        if (!empty($data['participants'])) {
            $syncData = [];
            foreach ($data['participants'] as $userId) {
                $syncData[$userId] = ['notified_at' => now(), 'response' => 'pending'];
            }
            $meeting->participants()->sync($syncData);

            $participantUsers = User::whereIn('id', $data['participants'])->get();
            Notification::send($participantUsers, new MeetingInvitationNotification($meeting));
        }

        return redirect()->route('meetings.index')->with('success', 'สร้างการประชุมและส่งอีเมลแจ้งเตือนผู้เข้าร่วมเรียบร้อยแล้ว');
    }

    public function show(Meeting $meeting): View
    {
        $meeting->load(['room', 'organizer', 'participants', 'agendas', 'documents']);
        return view('meetings.show', compact('meeting'));
    }

    public function edit(Meeting $meeting): View
    {
        $rooms = Room::where('is_active', true)->get();
        $users = User::all();
        $meeting->load('participants');

        return view('meetings.edit', compact('meeting', 'rooms', 'users'));
    }

    public function update(Request $request, Meeting $meeting): RedirectResponse
    {
        $data = $this->validateMeeting($request, $meeting->id);

        $meeting->update([
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'room_id' => $data['room_id'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'status' => $data['status'] ?? $meeting->status,
        ]);

        if (isset($data['participants'])) {
            $syncData = [];
            foreach ($data['participants'] as $userId) {
                $syncData[$userId] = ['notified_at' => now(), 'response' => 'pending'];
            }
            $meeting->participants()->sync($syncData);

            $participantUsers = User::whereIn('id', $data['participants'])->get();
            Notification::send($participantUsers, new MeetingInvitationNotification($meeting));
        }

        return redirect()->route('meetings.index')->with('success', 'แก้ไขการประชุมและแจ้งเตือนผู้เข้าร่วมเรียบร้อยแล้ว');
    }

    public function destroy(Meeting $meeting): RedirectResponse
    {
        $meeting->delete();

        return redirect()->route('meetings.index')->with('success', 'ยกเลิก/ลบการประชุมเรียบร้อยแล้ว');
    }

    /**
     * Validate request และเช็คว่าห้องประชุมไม่ถูกจองซ้ำในช่วงเวลาเดียวกัน
     */
    private function validateMeeting(Request $request, ?int $ignoreMeetingId = null): array
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'room_id' => 'required|exists:rooms,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'status' => ['nullable', Rule::in(['scheduled', 'ongoing', 'completed', 'cancelled'])],
            'participants' => 'nullable|array',
            'participants.*' => 'exists:users,id',
        ]);

        $conflict = Meeting::where('room_id', $data['room_id'])
            ->when($ignoreMeetingId, fn ($q) => $q->where('id', '!=', $ignoreMeetingId))
            ->where('status', '!=', 'cancelled')
            ->where(function ($q) use ($data) {
                $q->whereBetween('start_time', [$data['start_time'], $data['end_time']])
                  ->orWhereBetween('end_time', [$data['start_time'], $data['end_time']])
                  ->orWhere(function ($q2) use ($data) {
                      $q2->where('start_time', '<=', $data['start_time'])
                         ->where('end_time', '>=', $data['end_time']);
                  });
            })
            ->exists();

        if ($conflict) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'room_id' => 'ห้องนี้ถูกจองในช่วงเวลาที่เลือกไว้แล้ว กรุณาเลือกเวลาหรือห้องอื่น',
            ]);
        }

        return $data;
    }
}