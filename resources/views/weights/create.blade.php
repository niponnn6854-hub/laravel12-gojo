<x-weight title="เพิ่มข้อมูลน้ำหนัก">

    <h2 class="mb-4">เพิ่มข้อมูลน้ำหนัก</h2>

    <div class="card" style="max-width: 600px;">
        <div class="card-body">
            <form action="{{ route('weights.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="weight" class="form-label">น้ำหนัก (กก.)</label>
                    <input type="number" step="0.01" name="weight" id="weight"
                           class="form-control" value="{{ old('weight') }}">
                </div>

                <div class="mb-3">
                    <label for="recorded_at" class="form-label">วันที่ชั่ง</label>
                    <input type="date" name="recorded_at" id="recorded_at"
                           class="form-control" value="{{ old('recorded_at', date('Y-m-d')) }}">
                </div>

                <div class="mb-3">
                    <label for="note" class="form-label">บันทึกเพิ่มเติม (ถ้ามี)</label>
                    <textarea name="note" id="note" class="form-control" rows="3">{{ old('note') }}</textarea>
                </div>

                <button type="submit" class="btn btn-success">บันทึก</button>
                <a href="{{ route('weights.index') }}" class="btn btn-secondary">ย้อนกลับ</a>
            </form>
        </div>
    </div>

</x-weight>