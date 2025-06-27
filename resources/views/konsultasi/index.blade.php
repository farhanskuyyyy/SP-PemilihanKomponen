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
                        <select name="categories[]" id="" class="form-control">
                            <option value="">Pilih {{ $class->name }}</option>
                            @foreach ($class->categories as $cat)
                                <option value="{{ $cat->code }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                @endforeach
                <div class="d-flex justify-content-end">
                    <button type="reset" class="btn btn-secondary me-2">Reset</button>
                    <button type="submit" class="btn btn-primary" id="saveKonsultasiBtn">Konsultasi</button>
                </div>
            </form>

            <div class="mt-5" id="hasil">

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
            const hasilDiv = document.getElementById('hasil');
            hasilDiv.innerHTML = ''; // Kosongkan hasil sebelumnya

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
                    // Jika resp.data adalah array, lakukan foreach untuk setiap solusi
                    let html = '';
                    if (Array.isArray(resp.data)) {
                        resp.data.forEach(function(item) {
                            const solusiUrl = "{{ route('simulasi.index', ['id' => '__ID__']) }}".replace('__ID__', item.solusi);
                            const printUrl = "{{ route('rakitan.print', ['code' => '__CODE__']) }}".replace('__CODE__', item.rsolusi.code);
                            html += `
                                <div class="card border-primary mb-3">
                                    <div class="card-header">
                                        <h5 class="card-title">Hasil Konsultasi</h5>
                                    </div>
                                    <div class="card-body">
                                        <h6 class="card-title">${item.rsolusi.name}</h6>
                                        <p class="card-text">${item.description}</p>
                                        <div class="mb-2">
                                            <span class="badge bg-info text-dark">
                                                Total Harga: Rp ${Number(item.total_price_solusi).toLocaleString('id-ID')}
                                            </span>
                                        </div>
                                        <a href="${solusiUrl}" class="btn btn-outline-primary btn-sm">Lihat Rekomendasi</a>
                                        <a href="${printUrl}" target="_blank" class="btn btn-outline-warning btn-sm">Print</a>
                                    </div>
                                </div>
                            `;

                            // Jika ada solusi rekomendasi tambahan
                            if (item.solusi_rekomendasi) {
                                const solusiRekomendasiUrl = "{{ route('simulasi.index', ['id' => '__ID__']) }}".replace('__ID__', item.solusi_rekomendasi);
                                const printUrlRekomendasi = "{{ route('rakitan.print', ['code' => '__CODE__']) }}".replace('__CODE__', item.rsolusi_rekomendasi.code);

                                html += `
                                    <div class="card border-primary mb-3">
                                        <div class="card-header">
                                            <h5 class="card-title">Rekomendasi Lainnya</h5>
                                        </div>
                                        <div class="card-body">
                                            <h6 class="card-title">${item.rsolusi_rekomendasi.name}</h6>
                                            <p class="card-text">${item.description_rekomendasi}</p>
                                            <div class="mb-2">
                                                <span class="badge bg-info text-dark">
                                                    Total Harga: Rp ${Number(item.total_price_solusi_rekomendasi).toLocaleString('id-ID')}
                                                </span>
                                            </div>
                                            <a href="${solusiRekomendasiUrl}" class="btn btn-outline-primary btn-sm">Lihat Rekomendasi</a>
                                            <a href="${printUrlRekomendasi}" target="_blank" class="btn btn-outline-warning btn-sm">Print</a>
                                        </div>
                                    </div>
                                `;
                            }
                        });
                    } else {
                        // fallback jika resp.data bukan array (tetap support struktur lama)
                        const solusiUrl = "{{ route('simulasi.index', ['id' => '__ID__']) }}".replace('__ID__', resp.data.solusi);
                        const printUrl = "{{ route('rakitan.print', ['code' => '__CODE__']) }}".replace('__CODE__', resp.data.rsolusi.code);
                        html += `
                            <div class="card border-primary">
                                <div class="card-header">
                                    <h5 class="card-title">Hasil Konsultasi</h5>
                                </div>
                                <div class="card-body">
                                    <h6 class="card-title">${resp.data.rsolusi.name}</h6>
                                    <p class="card-text">${resp.data.description}</p>
                                    <div class="mb-2">
                                        <span class="badge bg-info text-dark">
                                            Total Harga: Rp ${Number(resp.data.total_price_solusi).toLocaleString('id-ID')}
                                        </span>
                                    </div>
                                    <a href="${solusiUrl}" class="btn btn-outline-primary btn-sm">Lihat Rekomendasi</a>
                                    <a href="${printUrl}" target="_blank" class="btn btn-outline-warning btn-sm">Print</a>
                                </div>
                            </div>
                        `;

                        if (resp.data.solusi_rekomendasi) {
                            const solusiRekomendasiUrl = "{{ route('simulasi.index', ['id' => '__ID__']) }}".replace('__ID__', resp.data.solusi_rekomendasi);
                            const printUrlRekomendasi = "{{ route('rakitan.print', ['code' => '__CODE__']) }}".replace('__CODE__', resp.data.rsolusi_rekomendasi.code);

                            html += `
                                <br>
                                <div class="card border-primary">
                                    <div class="card-header">
                                        <h5 class="card-title">Rekomendasi Lainnya</h5>
                                    </div>
                                    <div class="card-body">
                                        <h6 class="card-title">${resp.data.rsolusi_rekomendasi.name}</h6>
                                        <p class="card-text">${resp.data.description_rekomendasi}</p>
                                        <div class="mb-2">
                                            <span class="badge bg-info text-dark">
                                                Total Harga: Rp ${Number(resp.data.total_price_solusi_rekomendasi).toLocaleString('id-ID')}
                                            </span>
                                        </div>
                                        <a href="${solusiRekomendasiUrl}" class="btn btn-outline-primary btn-sm">Lihat Rekomendasi</a>
                                        <a href="${printUrlRekomendasi}" target="_blank" class="btn btn-outline-warning btn-sm">Print</a>
                                    </div>
                                </div>`;
                        }
                    }

                    hasilDiv.innerHTML += html;
                })
                .catch(err => {
                    let msg = "Mohon Maaf Data Tidak ditemukan, Berikan Kami masukan untuk perbaikan";
                    hasilDiv.innerHTML += `<div class="alert alert-danger">${msg}</div>`;
                })
                .finally(() => {
                    saveBtn.disabled = false;
                    saveBtn.innerHTML = "Simpan"; // atau ganti dengan text asli tombol
                });
        });
    </script>
@endsection
