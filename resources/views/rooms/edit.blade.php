<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">แก้ไขห้องประชุม</h2>
    </x-slot>

    <div class="py-6 max-w-xl mx-auto sm:px-6 lg:px-8">
        <form action="{{ route('rooms.update', $room) }}" method="POST" class="bg-white shadow rounded p-6 space-y-4">
            @csrf @method('PUT')

            <div>
                <label class="block text-sm font-medium">ชื่อห้อง</label>
                <input type="text" name="name" value="{{ old('name', $room->name) }}" class="w-full border rounded p-2">
                @error('name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium">สถานที่</label>
                <input type="text" name="location" value="{{ old('location', $room->location) }}" class="w-full border rounded p-2">
            </div>

            <div>
                <label class="block text-sm font-medium">ความจุ (คน)</label>
                <input type="number" name="capacity" value="{{ old('capacity', $room->capacity) }}" class="w-full border rounded p-2">
                @error('capacity') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center">
                <input type="checkbox" name="is_active" value="1" {{ $room->is_active ? 'checked' : '' }} class="mr-2">
                <label class="text-sm">เปิดใช้งานห้องนี้</label>
            </div>

            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">บันทึกการแก้ไข</button>
        </form>
    </div>
</x-app-layout>
