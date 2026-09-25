<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $meeting->title }}</h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
        @if (session('success'))
            <div class="p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif

        <div class="bg-white shadow rounded p-6">
            <p><strong>ห้อง:</strong> {{ $meeting->room->name }}</p>
            <p><strong>ผู้จัด:</strong> {{ $meeting->organizer->name }}</p>
            <p><strong>เวลา:</strong> {{ $meeting->start_time->format('d/m/Y H:i') }} - {{ $meeting->end_time->format('d/m/Y H:i') }}</p>
            <p><strong>สถานะ:</strong> {{ $meeting->status }}</p>
            <p class="mt-2">{{ $meeting->description }}</p>
        </div>

        <div class="bg-white shadow rounded p-6">
            <h3 class="font-semibold mb-2">ผู้เข้าร่วม</h3>
            <ul class="list-disc list-inside text-sm">
                @forelse ($meeting->participants as $p)
                    <li>{{ $p->name }} — สถานะตอบรับ: {{ $p->pivot->response }}</li>
                @empty
                    <li class="text-gray-500">ยังไม่มีผู้เข้าร่วม</li>
                @endforelse
            </ul>
        </div>

        <div class="bg-white shadow rounded p-6">
            <h3 class="font-semibold mb-2">วาระการประชุม</h3>
            <ol class="list-decimal list-inside text-sm mb-4">
                @forelse ($meeting->agendas as $agenda)
                    <li class="flex justify-between items-start gap-2">
                        <span>{{ $agenda->topic }} — {{ $agenda->detail }}</span>
                        <form action="{{ route('agendas.destroy', $agenda) }}" method="POST"
                              onsubmit="return confirm('ลบวาระนี้?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 text-xs">ลบ</button>
                        </form>
                    </li>
                @empty
                    <li class="text-gray-500">ยังไม่มีวาระ</li>
                @endforelse
            </ol>

            <form action="{{ route('agendas.store', $meeting) }}" method="POST" class="space-y-2 border-t pt-3">
                @csrf
                <input type="text" name="topic" placeholder="หัวข้อวาระ" class="w-full border rounded p-2 text-sm">
                @error('topic') <p class="text-red-600 text-xs">{{ $message }}</p> @enderror
                <textarea name="detail" placeholder="รายละเอียด (ถ้ามี)" rows="2" class="w-full border rounded p-2 text-sm"></textarea>
                <button type="submit" class="px-3 py-1.5 bg-blue-600 text-white rounded text-sm">+ เพิ่มวาระ</button>
            </form>
        </div>

        <div class="bg-white shadow rounded p-6">
            <h3 class="font-semibold mb-2">เอกสารแนบ</h3>
            <ul class="list-disc list-inside text-sm mb-4">
                @forelse ($meeting->documents as $doc)
                    <li class="flex justify-between items-start gap-2">
                        <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" class="text-blue-600">{{ $doc->file_name }}</a>
                        <form action="{{ route('documents.destroy', $doc) }}" method="POST"
                              onsubmit="return confirm('ลบเอกสารนี้?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 text-xs">ลบ</button>
                        </form>
                    </li>
                @empty
                    <li class="text-gray-500">ยังไม่มีเอกสารแนบ</li>
                @endforelse
            </ul>

            <form action="{{ route('documents.store', $meeting) }}" method="POST" enctype="multipart/form-data" class="space-y-2 border-t pt-3">
                @csrf
                <input type="file" name="file" class="w-full border rounded p-2 text-sm">
                @error('file') <p class="text-red-600 text-xs">{{ $message }}</p> @enderror
                <button type="submit" class="px-3 py-1.5 bg-blue-600 text-white rounded text-sm">อัปโหลดเอกสาร</button>
            </form>
        </div>

        <a href="{{ route('meetings.index') }}" class="text-blue-600">&larr; กลับไปหน้ารายการ</a>
    </div>
</x-app-layout>
