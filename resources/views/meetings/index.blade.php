<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">การประชุมทั้งหมด</h2>
    </x-slot>

    <div class="py-6 max-w-6xl mx-auto sm:px-6 lg:px-8">
        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif

        <a href="{{ route('meetings.create') }}" class="inline-block mb-4 px-4 py-2 bg-blue-600 text-white rounded">
            + จองห้อง / สร้างการประชุม
        </a>

        <div class="bg-white shadow rounded overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left">หัวข้อ</th>
                        <th class="px-4 py-2 text-left">ห้อง</th>
                        <th class="px-4 py-2 text-left">ผู้จัด</th>
                        <th class="px-4 py-2 text-left">เวลาเริ่ม</th>
                        <th class="px-4 py-2 text-left">เวลาสิ้นสุด</th>
                        <th class="px-4 py-2 text-left">สถานะ</th>
                        <th class="px-4 py-2 text-left">วาระ / เอกสาร</th>
                        <th class="px-4 py-2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($meetings as $meeting)
                        <tr class="border-t">
                            <td class="px-4 py-2 font-medium">{{ $meeting->title }}</td>
                            <td class="px-4 py-2">{{ $meeting->room->name }}</td>
                            <td class="px-4 py-2">{{ $meeting->organizer->name }}</td>
                            <td class="px-4 py-2">{{ $meeting->start_time->format('d/m/Y H:i') }}</td>
                            <td class="px-4 py-2">{{ $meeting->end_time->format('d/m/Y H:i') }}</td>
                            <td class="px-4 py-2">{{ $meeting->status }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('meetings.show', $meeting) }}"
                                   class="inline-block px-3 py-1.5 bg-emerald-600 text-white rounded text-xs font-semibold hover:bg-emerald-700">
                                    📋 ดูวาระ / เอกสาร
                                </a>
                            </td>
                            <td class="px-4 py-2 text-right space-x-2 whitespace-nowrap">
                                <a href="{{ route('meetings.edit', $meeting) }}" class="text-blue-600">แก้ไข</a>
                                <form action="{{ route('meetings.destroy', $meeting) }}" method="POST" class="inline"
                                      onsubmit="return confirm('ยืนยันลบการประชุมนี้?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600">ลบ</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $meetings->links() }}</div>
    </div>
</x-app-layout>