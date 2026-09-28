@php
    $car = $car ?? null;
@endphp

<div class="grid lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-2xl border border-neutral-100 p-6">
            <h2 class="font-semibold text-neutral-900 mb-4">Informasi Mobil</h2>
            <div class="grid sm:grid-cols-2 gap-4">
                <div class="sm:col-span-2">
                    <label class="label">Nama Mobil</label>
                    <input type="text" name="name" value="{{ old('name', $car->name ?? '') }}" class="input" placeholder="cth. Toyota Avanza Veloz" required>
                </div>
                <div>
                    <label class="label">Merk</label>
                    <input type="text" name="brand" value="{{ old('brand', $car->brand ?? '') }}" class="input" placeholder="Toyota" required>
                </div>
                <div>
                    <label class="label">Model</label>
                    <input type="text" name="model" value="{{ old('model', $car->model ?? '') }}" class="input" placeholder="Avanza" required>
                </div>
                <div>
                    <label class="label">Tahun</label>
                    <input type="number" name="year" value="{{ old('year', $car->year ?? date('Y')) }}" class="input" min="2000" max="{{ date('Y') + 1 }}" required>
                </div>
                <div>
                    <label class="label">Plat Nomor</label>
                    <input type="text" name="plate_number" value="{{ old('plate_number', $car->plate_number ?? '') }}" class="input" placeholder="B 1234 ABC" required>
                </div>
                <div class="sm:col-span-2">
                    <label class="label">Kategori</label>
                    <select name="category_id" class="input" required>
                        <option value="">Pilih kategori</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ (string) old('category_id', $car->category_id ?? '') === (string) $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="sm:col-span-2">
                    <label class="label">Deskripsi</label>
                    <textarea name="description" rows="4" class="input" placeholder="Deskripsi singkat tentang mobil ini...">{{ old('description', $car->description ?? '') }}</textarea>
                </div>
                <div class="sm:col-span-2">
                    <label class="label">URL Gambar</label>
                    <input type="url" name="image" value="{{ old('image', $car->image ?? '') }}" class="input" placeholder="https://...">
                    <p class="text-xs text-neutral-400 mt-1">Tempel link gambar mobil (contoh: dari Unsplash).</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-neutral-100 p-6">
            <h2 class="font-semibold text-neutral-900 mb-4">Spesifikasi</h2>
            <div class="grid sm:grid-cols-3 gap-4">
                <div>
                    <label class="label">Jumlah Kursi</label>
                    <input type="number" name="seats" value="{{ old('seats', $car->seats ?? 4) }}" class="input" min="1" max="15" required>
                </div>
                <div>
                    <label class="label">Transmisi</label>
                    <select name="transmission" class="input" required>
                        <option value="manual" {{ old('transmission', $car->transmission ?? '') === 'manual' ? 'selected' : '' }}>Manual</option>
                        <option value="automatic" {{ old('transmission', $car->transmission ?? '') === 'automatic' ? 'selected' : '' }}>Automatic</option>
                    </select>
                </div>
                <div>
                    <label class="label">Bahan Bakar</label>
                    <select name="fuel_type" class="input" required>
                        <option value="bensin" {{ old('fuel_type', $car->fuel_type ?? '') === 'bensin' ? 'selected' : '' }}>Bensin</option>
                        <option value="diesel" {{ old('fuel_type', $car->fuel_type ?? '') === 'diesel' ? 'selected' : '' }}>Diesel</option>
                        <option value="electric" {{ old('fuel_type', $car->fuel_type ?? '') === 'electric' ? 'selected' : '' }}>Electric</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="space-y-6">
        <div class="bg-white rounded-2xl border border-neutral-100 p-6">
            <h2 class="font-semibold text-neutral-900 mb-4">Harga &amp; Ketersediaan</h2>
            <div class="space-y-4">
                <div>
                    <label class="label">Harga per Hari (Rp)</label>
                    <input type="number" name="price_per_day" value="{{ old('price_per_day', $car->price_per_day ?? '') }}" class="input" min="0" step="1000" placeholder="350000" required>
                </div>
                <div>
                    <label class="label">Stok Unit</label>
                    <input type="number" name="stock" value="{{ old('stock', $car->stock ?? 1) }}" class="input" min="1" required>
                </div>
                <div>
                    <label class="label">Status</label>
                    <select name="status" class="input" required>
                        <option value="available" {{ old('status', $car->status ?? 'available') === 'available' ? 'selected' : '' }}>Available</option>
                        <option value="rented" {{ old('status', $car->status ?? '') === 'rented' ? 'selected' : '' }}>Rented</option>
                        <option value="maintenance" {{ old('status', $car->status ?? '') === 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                    </select>
                </div>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_available" value="1" class="w-4 h-4 rounded border-neutral-300" {{ old('is_available', $car->is_available ?? true) ? 'checked' : '' }}>
                    <span class="text-sm text-neutral-700">Tampilkan di website (tersedia disewa)</span>
                </label>
            </div>
        </div>

        <div class="flex flex-col gap-3">
            <button type="submit" class="btn-primary w-full justify-center">
                {{ isset($car) ? 'Simpan Perubahan' : 'Tambah Mobil' }}
            </button>
            <a href="{{ route('admin.cars.index') }}" class="btn-outline w-full justify-center">Batal</a>
        </div>
    </div>
</div>
