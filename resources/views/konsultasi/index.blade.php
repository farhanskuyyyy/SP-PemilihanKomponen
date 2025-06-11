@extends('layouts.app')

@section('breadcrumbs')
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">Konsultasi</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Konsultasi</li>
                </ol>
            </nav>
        </div>
        <a class="btn btn-primary" href="{{ route('simulasi.index') }}">
            <i class="bi bi-chat-dots me-2"></i>Simulasi
        </a>
    </div>
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Konsultasi</h6>
        </div>
        <div class="card-body">
            <form id="addKonsultasiForm">
                @foreach ($clasifications as $class)
                    <div class="mb-3">
                        <label for="categories" class="form-label">{{ $class->pertanyaan }}</label>
                        <select name="categories_{{ $class->id }}" id="" class="form-control" required>
                            <option value="">Pilih {{ $class->name }}</option>
                            @foreach ($class->categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                @endforeach
                <div class="d-flex justify-content-end">
                    <button type="reset" class="btn btn-secondary me-2">Reset</button>
                    <button type="submit" class="btn btn-primary" id="saveKonsultasiBtn">Konsultasi</button>
                </div>
            </form>

            <div class="mt-5 d-none" id="hasil">

            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.getElementById("addKonsultasiForm").addEventListener("submit", function(e) {
            e.preventDefault();

            const saveBtn = document.getElementById("saveKonsultasiBtn");

            const form = document.getElementById("addKonsultasiForm"); // pastikan ID form kamu benar
            const formData = new FormData(form);

            saveBtn.disabled = true;
            saveBtn.innerHTML =
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...';

            fetch("{{ route('konsultasi.store') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: formData
                })
                .then(res => {
                    if (!res.ok) {
                        return res.json().then(errData => {
                            throw errData;
                        }).catch(() => {
                            throw new Error('Network response was not ok.');
                        });
                    }
                    return res.json();
                })
                .then(resp => {
                    // alert("Konsultasi added successfully!");
                    form.reset();
                    // URL rekomendasi utama
                    const solusiUrl = "{{ route('simulasi.index', ['id' => '__ID__']) }}".replace('__ID__', resp.data
                        .solusi);
                    let html = `
                        <div class="card border-primary">
                            <div class="card-body">
                                <h6 class="card-title">${resp.data.rsolusi.name}</h6>
                                <p class="card-text">${resp.data.description}</p>
                                <a href="${solusiUrl}" class="btn btn-outline-primary btn-sm">Lihat Rekomendasi</a>
                            </div>
                        </div>
                    `;

                    // Jika ada solusi rekomendasi tambahan
                    if (resp.data.solusi_rekomendasi) {
                        const solusiRekomendasiUrl = "{{ route('simulasi.index', ['id' => '__ID__']) }}"
                            .replace('__ID__', resp.data.solusi_rekomendasi);
                        html += `
                                <br>
                                <div class="card border-primary">
                                    <div class="card-body">
                                        <h6 class="card-title">${resp.data.rsolusi_rekomendasi.name}</h6>
                                        <p class="card-text">${resp.data.description_rekomendasi}</p>
                                        <a href="${solusiRekomendasiUrl}" class="btn btn-outline-primary btn-sm">Lihat Rekomendasi</a>
                                    </div>
                                </div>`;
                    }

                    const hasilDiv = document.getElementById('hasil');
                    hasilDiv.innerHTML += html;
                    hasilDiv.classList.remove('d-none');
                })
                .catch(err => {
                    let msg = "Failed to add konsultasi.";
                    if (err.errors) {
                        msg = Object.values(err.errors).flat().join('\n');
                    } else if (err.message) {
                        msg = err.message;
                    }
                    // alert(msg);
                })
                .finally(() => {
                    saveBtn.disabled = false;
                    saveBtn.innerHTML = "Simpan"; // atau ganti dengan text asli tombol
                });
        });
    </script>
@endsection
