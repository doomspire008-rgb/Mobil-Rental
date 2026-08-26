@extends('layouts.admin')

@section('title', 'Kelola Armada Mobil')
@section('header', 'Manajemen Armada Mobil')

@section('content')
<div class="space-y-6">
    <!-- Top Filter & Action Bar -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs flex flex-col md:flex-row items-center justify-between gap-4">
        <form method="GET" action="{{ route('admin.cars.index') }}" class="flex flex-wrap items-center gap-3 w-full md:w-auto">
            <div class="relative min-w-[220px]">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, merk, plat..." class="input pr-8 text-sm">
                <svg class="w-4 h-4 text-slate-400 absolute right-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>

            <select name="category" class="input w-auto text-sm" onchange="this.form.submit()">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>

            <select name="status" class="input w-auto text-sm" onchange="this.form.submit()">
                <option value="">Semua Status</option>
                <option value="available" {{ request('status') === 'available' ? 'selected' : '' }}>Tersedia</option>
                <option value="rented" {{ request('status') === 'rented' ? 'selected' : '' }}>Disewa</option>
            </select>

            <button type="submit" class="btn btn-secondary btn-sm rounded-xl">Filter</button>
            @if(request()->hasAny(['search', 'category', 'status']))
                <a href="{{ route('admin.cars.index') }}" class="text-xs text-slate-500 hover:text-slate-800">Reset</a>
            @endif
        </form>

        <button onclick="openAddModal()" class="btn btn-primary btn-sm rounded-xl w-full md:w-auto flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Mobil Baru
        </button>
    </div>

    <!-- Cars Table -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 border-b border-slate-100 text-xs font-bold text-slate-500 uppercase tracking-wider">
                    <tr>
                        <th class="py-3.5 px-6">Mobil</th>
                        <th class="py-3.5 px-6">Kategori & Spesifikasi</th>
                        <th class="py-3.5 px-6">Harga Sewa</th>
                        <th class="py-3.5 px-6">Stok & Status</th>
                        <th class="py-3.5 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($cars as $car)
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-3">
                                <img src="{{ $car->image }}" alt="{{ $car->name }}" class="w-16 h-12 rounded-xl object-cover border border-slate-200 flex-shrink-0">
                                <div>
                                    <h3 class="font-bold text-slate-900 leading-tight">{{ $car->name }}</h3>
                                    <p class="text-xs text-slate-400 font-mono mt-0.5">{{ $car->plate_number }} &middot; Thn {{ $car->year }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="badge-primary mb-1 inline-block">{{ $car->category->name ?? 'General' }}</span>
                            <p class="text-xs text-slate-500">
                                {{ $car->seats }} Kursi &middot; {{ ucfirst($car->transmission) }} &middot; {{ ucfirst($car->fuel_type) }}
                            </p>
                        </td>
                        <td class="py-4 px-6">
                            <span class="font-bold text-slate-900">Rp {{ number_format($car->price_per_day, 0, ',', '.') }}</span>
                            <span class="text-xs text-slate-400">/hari</span>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-2">
                                <form method="POST" action="{{ route('admin.cars.toggle', $car->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" title="Klik untuk ubah status" class="cursor-pointer">
                                        @if($car->is_available)
                                            <span class="badge-success">Tersedia</span>
                                        @else
                                            <span class="badge-danger">Disewa / Nonaktif</span>
                                        @endif
                                    </button>
                                </form>
                                <span class="text-xs text-slate-400">({{ $car->stock }} Unit)</span>
                            </div>
                        </td>
                        <td class="py-4 px-6 text-right">
                            <div class="inline-flex items-center gap-2">
                                <button onclick="openEditModal({{ json_encode($car) }})" class="p-2 text-slate-500 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition-colors" title="Edit Mobil">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </button>

                                <form method="POST" action="{{ route('admin.cars.delete', $car->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus mobil {{ $car->name }}?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-slate-500 hover:text-red-600 hover:bg-red-50 rounded-xl transition-colors" title="Hapus Mobil">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-12 text-center text-slate-400">
                            Tidak ada data mobil yang sesuai.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-slate-100">
            {{ $cars->links() }}
        </div>
    </div>
</div>

<!-- Modal Tambah/Edit Mobil -->
<div id="carModal" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4 hidden">
    <div class="bg-white rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto shadow-2xl">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between sticky top-0 bg-white z-10">
            <h2 id="modalTitle" class="text-lg font-bold text-slate-900">Tambah Mobil Baru</h2>
            <button onclick="closeModal()" class="text-slate-400 hover:text-slate-700 text-xl font-bold">&times;</button>
        </div>

        <form id="carForm" method="POST" action="{{ route('admin.cars.store') }}" enctype="multipart/form-data" class="p-6 space-y-4">
            @csrf
            <div id="methodField"></div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="label">Nama Mobil</label>
                    <input type="text" name="name" id="carName" required class="input" placeholder="Contoh: Toyota Avanza 1.5 G">
                </div>
                <div>
                    <label class="label">Kategori</label>
                    <select name="category_id" id="carCategory" required class="input">
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="label">Brand/Merk</label>
                    <input type="text" name="brand" id="carBrand" required class="input" placeholder="Toyota">
                </div>
                <div>
                    <label class="label">Model/Varian</label>
                    <input type="text" name="model" id="carModelInput" required class="input" placeholder="Avanza Facelift">
                </div>
                <div>
                    <label class="label">Tahun</label>
                    <input type="number" name="year" id="carYear" value="2024" required class="input">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="label">Nomor Plat Polisi</label>
                    <input type="text" name="plate_number" id="carPlate" required class="input" placeholder="B 1234 ABC">
                </div>
                <div>
                    <label class="label">Harga Sewa / Hari (Rp)</label>
                    <input type="number" name="price_per_day" id="carPrice" required class="input" placeholder="500000">
                </div>
                <div>
                    <label class="label">Jumlah Unit (Stok)</label>
                    <input type="number" name="stock" id="carStock" value="1" min="1" required class="input">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="label">Jumlah Kursi</label>
                    <input type="number" name="seats" id="carSeats" value="7" min="2" max="20" required class="input">
                </div>
                <div>
                    <label class="label">Transmisi</label>
                    <select name="transmission" id="carTransmission" required class="input">
                        <option value="automatic">Automatic</option>
                        <option value="manual">Manual</option>
                    </select>
                </div>
                <div>
                    <label class="label">Bahan Bakar</label>
                    <select name="fuel_type" id="carFuel" required class="input">
                        <option value="bensin">Bensin</option>
                        <option value="diesel">Diesel</option>
                        <option value="electric">Electric (EV)</option>
                        <option value="hybrid">Hybrid</option>
                    </select>
                </div>
            </div>

            <!-- Upload File & Image Selection Section -->
            <div class="space-y-2">
                <label class="label">Foto Mobil</label>
                
                <!-- Drag and drop zone -->
                <div id="dropzoneContainer" onclick="document.getElementById('carImageFile').click()" class="border-2 border-dashed border-slate-300 hover:border-blue-500 bg-slate-50 hover:bg-blue-50/50 rounded-2xl p-4 sm:p-6 text-center cursor-pointer transition-all">
                    <input type="file" name="image_file" id="carImageFile" accept="image/*" class="hidden" onchange="previewSelectedImage(this)">
                    
                    <div id="uploadPrompt" class="space-y-1.5">
                        <div class="w-12 h-12 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center mx-auto mb-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <p class="text-sm font-bold text-slate-800">Klik untuk upload foto mobil dari komputer / HP</p>
                        <p class="text-xs text-slate-400">Mendukung format JPG, PNG, WEBP, SVG (Maks. 5 MB)</p>
                    </div>

                    <!-- Image Preview Container -->
                    <div id="imagePreviewContainer" class="hidden items-center justify-center gap-4 flex-col sm:flex-row">
                        <img id="imagePreview" src="" alt="Preview Foto" class="w-40 h-24 sm:w-48 sm:h-28 object-cover rounded-xl border-2 border-blue-500 shadow-md">
                        <div class="text-left space-y-1">
                            <span class="badge-success text-xs font-semibold">Foto Siap Digunakan</span>
                            <p id="previewFileName" class="text-xs text-slate-500 truncate max-w-xs"></p>
                            <button type="button" onclick="event.stopPropagation(); resetImageUpload()" class="text-xs text-red-500 hover:text-red-700 font-semibold underline block">
                                Ganti Foto Lain
                            </button>
                        </div>
                    </div>
                </div>

                <!-- External URL option toggle -->
                <div class="pt-1">
                    <button type="button" onclick="toggleUrlInput()" class="text-xs font-semibold text-blue-600 hover:text-blue-700 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                        <span>Atau masukkan link URL foto eksternal</span>
                    </button>
                    <div id="urlInputContainer" class="hidden mt-2">
                        <input type="url" name="image" id="carImage" class="input text-xs" placeholder="https://images.unsplash.com/..." oninput="previewUrlImage(this.value)">
                    </div>
                </div>
            </div>

            <div>
                <label class="label">Deskripsi Mobil</label>
                <textarea name="description" id="carDesc" rows="3" required class="input" placeholder="Kelebihan dan spesifikasi mobil..."></textarea>
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                <button type="button" onclick="closeModal()" class="btn btn-secondary rounded-xl px-5 py-2.5">Batal</button>
                <button type="submit" class="btn btn-primary rounded-xl px-6 py-2.5">Simpan Mobil</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function openAddModal() {
    document.getElementById('modalTitle').innerText = 'Tambah Mobil Baru';
    document.getElementById('carForm').action = "{{ route('admin.cars.store') }}";
    document.getElementById('methodField').innerHTML = '';
    document.getElementById('carForm').reset();
    resetImageUpload();
    document.getElementById('carModal').classList.remove('hidden');
}

function openEditModal(car) {
    document.getElementById('modalTitle').innerText = 'Edit Mobil: ' + car.name;
    document.getElementById('carForm').action = "/admin/cars/" + car.id;
    document.getElementById('methodField').innerHTML = '<input type="hidden" name="_method" value="PUT">';
    
    document.getElementById('carName').value = car.name;
    document.getElementById('carCategory').value = car.category_id;
    document.getElementById('carBrand').value = car.brand;
    document.getElementById('carModelInput').value = car.model;
    document.getElementById('carYear').value = car.year;
    document.getElementById('carPlate').value = car.plate_number;
    document.getElementById('carPrice').value = car.price_per_day;
    document.getElementById('carStock').value = car.stock;
    document.getElementById('carSeats').value = car.seats;
    document.getElementById('carTransmission').value = car.transmission;
    document.getElementById('carFuel').value = car.fuel_type;
    document.getElementById('carImage').value = car.image || '';
    document.getElementById('carDesc').value = car.description;
    
    // Set preview to existing image
    if (car.image) {
        showPreview(car.image, 'Foto saat ini: ' + car.name);
    } else {
        resetImageUpload();
    }

    document.getElementById('carModal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('carModal').classList.add('hidden');
}

function previewSelectedImage(input) {
    if (input.files && input.files[0]) {
        const file = input.files[0];
        const reader = new FileReader();
        reader.onload = function(e) {
            showPreview(e.target.result, file.name);
        };
        reader.readAsDataURL(file);
    }
}

function previewUrlImage(url) {
    if (url && url.startsWith('http')) {
        showPreview(url, 'Link Eksternal');
    }
}

function showPreview(src, label) {
    const preview = document.getElementById('imagePreview');
    const container = document.getElementById('imagePreviewContainer');
    const prompt = document.getElementById('uploadPrompt');
    const labelElem = document.getElementById('previewFileName');
    
    preview.src = src;
    labelElem.innerText = label;
    container.classList.remove('hidden');
    container.classList.add('flex');
    prompt.classList.add('hidden');
}

function resetImageUpload() {
    document.getElementById('carImageFile').value = '';
    document.getElementById('imagePreview').src = '';
    document.getElementById('imagePreviewContainer').classList.add('hidden');
    document.getElementById('imagePreviewContainer').classList.remove('flex');
    document.getElementById('uploadPrompt').classList.remove('hidden');
}

function toggleUrlInput() {
    const container = document.getElementById('urlInputContainer');
    container.classList.toggle('hidden');
}
</script>
@endpush
