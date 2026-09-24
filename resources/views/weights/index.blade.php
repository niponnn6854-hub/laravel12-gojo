<x-weight title="รายการน้ำหนัก">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>บันทึกน้ำหนักร่างกาย</h2>
        <a href="{{ route('weights.create') }}" class="btn btn-primary">+ เพิ่มข้อมูล</a>
    </div>

    {{-- กราฟแสดงแนวโน้มน้ำหนัก (Google Chart) --}}
    <div class="card mb-4">
        <div class="card-header">แนวโน้มน้ำหนัก (กราฟ)</div>
        <div class="card-body">
            @if ($weights->count() > 0)
                <div id="weight_chart" style="width: 100%; height: 350px;"></div>
            @else
                <p class="text-muted mb-0">ยังไม่มีข้อมูลสำหรับแสดงกราฟ</p>
            @endif
        </div>
    </div>

    {{-- ตารางแสดงข้อมูลทั้งหมด --}}
    <div class="card">
        <div class="card-header">รายการทั้งหมด</div>
        <table class="table table-striped table-bordered align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th>วันที่</th>
                    <th>น้ำหนัก (กก.)</th>
                    <th>บันทึก</th>
                    <th style="width: 160px;">จัดการ</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($weights as $item)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($item->recorded_at)->format('d/m/Y') }}</td>
                        <td>{{ number_format($item->weight, 2) }}</td>
                        <td>{{ $item->note ?? '-' }}</td>
                        <td>
                            <a href="{{ route('weights.edit', $item->id) }}" class="btn btn-sm btn-warning">แก้ไข</a>
                            <form action="{{ route('weights.destroy', $item->id) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('ยืนยันการลบข้อมูลนี้?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">ลบ</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">ยังไม่มีข้อมูลน้ำหนัก</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <x-slot name="scripts">
        @if ($weights->count() > 0)
            <script src="https://www.gstatic.com/charts/loader.js"></script>
            <script>
                google.charts.load('current', { packages: ['corechart'] });
                google.charts.setOnLoadCallback(drawWeightChart);

                function drawWeightChart() {
                    var data = new google.visualization.DataTable();
                    data.addColumn('string', 'วันที่');
                    data.addColumn('number', 'น้ำหนัก (กก.)');

                    data.addRows([
                        @foreach ($weights->sortBy('recorded_at') as $item)
                            ['{{ \Carbon\Carbon::parse($item->recorded_at)->format('d/m/Y') }}', {{ $item->weight }}],
                        @endforeach
                    ]);

                    var options = {
                        curveType: 'function',
                        legend: { position: 'bottom' },
                        vAxis: { title: 'น้ำหนัก (กก.)' },
                        hAxis: { title: 'วันที่' },
                    };

                    var chart = new google.visualization.LineChart(document.getElementById('weight_chart'));
                    chart.draw(data, options);
                }
            </script>
        @endif
    </x-slot>

</x-weight>