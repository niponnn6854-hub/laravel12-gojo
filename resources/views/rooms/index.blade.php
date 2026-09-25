<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">ห้องประชุมทั้งหมด</h2>
    </x-slot>

    <div class="py-6 max-w-5xl mx-auto sm:px-6 lg:px-8">
        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif

        <a href="{{ route('rooms.create') }}" class="inline-block mb-4 px-4 py-2 bg-blue-600 text-white rounded">
            + เพิ่มห้องประชุม
        </a>

        <div class="bg-white shadow rounded overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left">ชื่อห้อง</th>
                        <th class="px-4 py-2 text-left">สถานที่</th>
                        <th class="px-4 py-2 text-left">ความจุ</th>
                        <th class="px-4 py-2 text-left">สถานะ</th>
                        <th class="px-4 py-2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rooms as $room)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $room->name }}</td>
                            <td class="px-4 py-2">{{ $room->location }}</td>
                            <td class="px-4 py-2">{{ $room->capacity }}</td>
                            <td class="px-4 py-2">{{ $room->is_active ? 'ใช้งานได้' : 'ปิดใช้งาน' }}</td>
                            <td class="px-4 py-2 text-right space-x-2">
                                <a href="{{ route('rooms.edit', $room) }}" class="text-blue-600">แก้ไข</a>
                                <form action="{{ route('rooms.destroy', $room) }}" method="POST" class="inline"
                                      onsubmit="return confirm('ยืนยันลบห้องนี้?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600">ลบ</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $rooms->links() }}</div>
    </div>
</x-app-layout>
