@extends('layouts.app')
@section('breadcrumbs')
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">Simulasi</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Simulasi</li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('konsultasi.index') }}" class="btn btn-primary">
            <i class="bi bi-person-plus me-2"></i>Konsultasi
        </a>
    </div>
@endsection

@section('content')
    <!-- Button to trigger Rekomendasi Modal -->
    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#rekomendasiModal">
        <i class="bi bi-lightbulb me-1"></i> Lihat Rekomendasi Rakitan
    </button>

    <!-- Button to trigger modal -->
    <button type="button" class="btn btn-info mb-3" data-bs-toggle="modal" data-bs-target="#rakitanListModal">
        <i class="bi bi-list-ul me-1"></i>List Rakitan Saya
    </button>

    <!-- Modal for Rekomendasi Rakitan -->
    <div class="modal fade" id="rekomendasiModal" tabindex="-1" aria-labelledby="rekomendasiModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rekomendasiModalLabel">Rekomendasi Rakitan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if (count($rekomendasi) > 0)
                        <div class="row">
                            @foreach ($rekomendasi as $rek)
                                <div class="col-md-6 mb-2">
                                    <div class="card border-primary">
                                        <div class="card-body">
                                            <h6 class="card-title">{{ $rek->rsolusi->name }}</h6>
                                            <p class="card-text">{{ $rek->description }}</p>
                                            <a href="{{ route('simulasi.index', ['id' => $rek->solusi]) }}"
                                                class="btn btn-outline-primary btn-sm">Lihat
                                                Rekomendasi</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-info mb-0">Belum ada rekomendasi rakitan.</div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for List Rakitan -->
    <div class="modal fade" id="rakitanListModal" tabindex="-1" aria-labelledby="rakitanListModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rakitanListModalLabel">List Rakitan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if (count($rakitanLists) > 0)
                        <div class="row">
                            @foreach ($rakitanLists as $list)
                                <div class="col-md-6 mb-2">
                                    <div class="card border-primary">
                                        <div class="card-body">
                                            <h6 class="card-title">{{ $list->name }}</h6>
                                            <p class="card-text">{{ $list->description }}</p>
                                            <a href="{{ route('simulasi.index', ['id' => $list->id]) }}"
                                                class="btn btn-outline-primary btn-sm">Load
                                            </a>
                                            <a href="{{ route('rakitan.print', ['code' => $list->code]) }}" target="_blank"
                                                class="btn btn-outline-warning btn-sm">Print
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-info mb-0">Belum ada rakitan yang tersimpan.</div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Simulasi</h6>
                <button type="button" class="btn btn-warning btn-sm ms-2 resetBtn">
                    <i class="bi bi-arrow-counterclockwise me-1"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <form id="addSimulasiForm">
                <div class="modal-body">
                    <input type="hidden" name="id" id="id" value="{{ request()->get('id') }}">
                    <div class="mb-3">
                        <label for="name" class="form-label required-field">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <!-- Tambahkan select untuk setiap komponen -->
                    @foreach (['motherboard', 'processor', 'ram', 'casing', 'storage_primary', 'storage_secondary', 'vga', 'psu', 'monitor'] as $comp)
                        <div class="mb-3">
                            <label for="{{ $comp }}"
                                class="form-label">{{ ucfirst(str_replace('_', ' ', $comp)) }}</label>
                            <select class="form-control" id="{{ $comp }}" name="{{ $comp }}">
                                <!-- Data komponen diisi via JS -->
                            </select>
                        </div>
                    @endforeach

                    <div class="mb-3">
                        <label class="form-label">Total Harga</label>
                        <input type="text" class="form-control" id="totalHarga" name="totalHarga" readonly>
                    </div>
                    <div class="mb-3">
                        <input type="checkbox" id="print" name="print">
                        <label class="form-label" for="print">Save And Print</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning me-2 resetBtn">
                        <i class="bi bi-arrow-counterclockwise me-1"></i>
                    </button>
                    <button type="submit" class="btn btn-primary" id="saveSimulasiBtn">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        let components = [];
        // Add Simulasi
        document.getElementById("addSimulasiForm").addEventListener("submit", function(e) {
            e.preventDefault();
            saveSimulation();
        });

        // Reset form event
        document.querySelectorAll('.resetBtn').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                document.getElementById('addSimulasiForm').reset();
                if (window.location.search) {
                    window.history.replaceState({}, document.title, window.location.pathname);
                }
                populateComponentSelects();
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            fetchComponents().then(() => {
                populateComponentSelects();
            });

            const fields = ['motherboard', 'processor', 'ram', 'casing', 'storage_primary', 'storage_secondary',
                'vga', 'psu', 'monitor'
            ];
            fields.forEach(comp => {
                const select = document.getElementById(comp);
                if (select) {
                    select.addEventListener('change', updateTotalHarga);
                }
            });
            updateTotalHarga();
        });

        function updateTotalHarga() {
            let total = 0;
            const fields = ['motherboard', 'processor', 'ram', 'casing', 'storage_primary', 'storage_secondary', 'vga',
                'psu', 'monitor'
            ];
            fields.forEach(comp => {
                const select = document.getElementById(comp);
                if (select && select.value) {
                    const option = select.options[select.selectedIndex];
                    const match = option.text.match(/Rp\s?([\d.,]+)/);
                    if (match) {
                        total += Number(match[1].replace(/\./g, '').replace(',', '.'));
                    }
                }
            });
            document.getElementById('totalHarga').value = total ? 'Rp ' + total.toLocaleString('id-ID') : '';
        }

        function saveSimulation() {
            const form = document.getElementById('addSimulasiForm');
            const formData = new FormData(form);

            fetch("{{ route('simulasi.store') }}", {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // form.reset();
                        // populateComponentSelects();
                        if (formData.get('print') && data.url) {
                            window.open(data.url, '_blank');
                        }
                        document.getElementById('id').value = data.data.id;
                        alert('Berhasil menyimpan rakitan.');
                    } else {
                        alert('Gagal menyimpan simulasi.');
                    }
                })
                .catch(error => {
                    alert('Terjadi kesalahan saat menyimpan simulasi.');
                    console.error(error);
                });
        }

        function fetchComponents() {
            // Ambil semua komponen, misal endpoint: /components
            return fetch("{{ route('component.getDataList') }}")
                .then(res => res.json())
                .then(data => {
                    components = data.data || data;
                });
        }

        // Populate select options for components
        function populateComponentSelects() {
            const fields = ['motherboard', 'processor', 'ram', 'casing', 'storage_primary', 'storage_secondary', 'vga',
                'psu', 'monitor'
            ];
            fields.forEach(comp => {
                const select = document.getElementById(comp);
                if (select) {
                    select.innerHTML = `<option value="">- Pilih -</option>`;
                    components.forEach(c => {
                        // For storage_primary and storage_secondary, show only components with type 'storage'
                        if (
                            (comp === 'storage_primary' || comp === 'storage_secondary') ?
                            (c.type && c.type.name && c.type.name.toLowerCase() === 'storage') :
                            (c.type && c.type.name && c.type.name.toLowerCase().includes(comp.replace('_',
                                ' ')))
                        ) {
                            select.innerHTML +=
                                `<option value="${c.id}">${c.name} ( Rp ${Number(c.price).toLocaleString('id-ID')} )</option>`;
                        }
                    });
                }
                const editSelect = document.getElementById("edit" + comp.charAt(0).toUpperCase() + comp.slice(1));
                if (editSelect) {
                    editSelect.innerHTML = `<option value="">- Pilih -</option>`;
                    components.forEach(c => {
                        // For storage_primary and storage_secondary, show only components with type 'storage'
                        if (
                            (comp === 'storage_primary' || comp === 'storage_secondary') ?
                            (c.type && c.type.name && c.type.name.toLowerCase() === 'storage') :
                            (c.type && c.type.name && c.type.name.toLowerCase().includes(comp.replace('_',
                                ' ')))
                        ) {
                            editSelect.innerHTML +=
                                `<option value="${c.id}">${c.name} ( Rp ${Number(c.price).toLocaleString('id-ID')} )</option>`;
                        }
                    });
                }
            });
        }
    </script>
    @if (isset($selectedRakitan) && $selectedRakitan)
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Isi field nama
                document.getElementById('name').value = @json($selectedRakitan->name);

                // Isi select komponen
                const rakitan = @json($selectedRakitan);
                const fields = ['motherboard', 'processor', 'ram', 'casing', 'storage_primary', 'storage_secondary',
                    'vga', 'psu',
                    'monitor'
                ];
                fetchComponents().then(() => {
                    populateComponentSelects();
                    fields.forEach(function(comp) {
                        if (rakitan[comp]) {
                            const select = document.getElementById(comp);
                            if (select) {
                                select.value = rakitan[comp];
                            }
                        }
                    });
                    updateTotalHarga();
                });

            });
        </script>
    @endif
@endsection
