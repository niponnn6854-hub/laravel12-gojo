<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">จองห้อง / สร้างการประชุมใหม่</h2>
    </x-slot>

    <div class="py-6 max-w-2xl mx-auto sm:px-6 lg:px-8">
        <form action="{{ route('meetings.store') }}" method="POST" class="bg-white shadow rounded p-6 space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium">หัวข้อการประชุม</label>
                <input type="text" name="title" value="{{ old('title') }}" class="w-full border rounded p-2">
                @error('title') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium">รายละเอียด</label>
                <textarea name="description" rows="3" class="w-full border rounded p-2">{{ old('description') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium">ห้องประชุม</label>
                <select name="room_id" class="w-full border rounded p-2">
                    <option value="">-- เลือกห้อง --</option>
                    @foreach ($rooms as $room)
                        <option value="{{ $room->id }}" {{ old('room_id') == $room->id ? 'selected' : '' }}>
                            {{ $room->name }} (จุ {{ $room->capacity }} คน)
                        </option>
                    @endforeach
                </select>
                @error('room_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium">เวลาเริ่ม</label>
                    <input type="datetime-local" name="start_time" value="{{ old('start_time') }}" class="w-full border rounded p-2">
                    @error('start_time') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium">เวลาสิ้นสุด</label>
                    <input type="datetime-local" name="end_time" value="{{ old('end_time') }}" class="w-full border rounded p-2">
                    @error('end_time') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium">ผู้เข้าร่วมประชุม (จะได้รับการแจ้งเตือน)</label>
                <select name="participants[]" multiple class="w-full border rounded p-2 h-32">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-500 mt-1">กด Ctrl (หรือ Cmd บน Mac) ค้างไว้เพื่อเลือกหลายคน</p>
            </div>

            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">บันทึกและแจ้งเตือน</button>
        </form>
    </div>
</x-app-layout>
