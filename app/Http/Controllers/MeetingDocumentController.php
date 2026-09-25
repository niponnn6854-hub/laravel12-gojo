<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\MeetingDocument;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MeetingDocumentController extends Controller
{
    public function store(Request $request, Meeting $meeting): RedirectResponse
    {
        $request->validate([
            'file' => 'required|file|max:10240', // สูงสุด 10MB
        ]);

        $uploaded = $request->file('file');
        $path = $uploaded->store('meeting-documents', 'public');

        $meeting->documents()->create([
            'uploaded_by' => auth()->id(),
            'file_name' => $uploaded->getClientOriginalName(),
            'file_path' => $path,
        ]);

        return redirect()->route('meetings.show', $meeting)->with('success', 'อัปโหลดเอกสารเรียบร้อยแล้ว');
    }

    public function destroy(MeetingDocument $document): RedirectResponse
    {
        $meeting = $document->meeting;

        \Illuminate\Support\Facades\Storage::disk('public')->delete($document->file_path);
        $document->delete();

        return redirect()->route('meetings.show', $meeting)->with('success', 'ลบเอกสารเรียบร้อยแล้ว');
    }
}
