<x-bootstrap-theme title="product form">
    <div class="container">
        <h2>เพิ่มรายการสินค้า</h2>
        <form action="{{ route('product.submit') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">ชื่อสินค้า</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">รายละเอียด</label>
                <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                @error('description')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">ราคา</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price') }}">
                @error('price')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">รูปภาพ</label>
                <input type="file" class="form-control" id="image" name="image">
                @error('image')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">บันทึก</button>
        </form>
    </div>
</x-bootstrap-theme>