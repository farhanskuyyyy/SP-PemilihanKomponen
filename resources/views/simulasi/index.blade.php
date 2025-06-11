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
    <div class="card shadow mb-4">
        <div class="card-body">

            <div class="mb-4">
                <h5>Rekomendasi Simulasi</h5>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <div class="card border-primary">
                            <div class="card-body">
                                <h6 class="card-title">Rekomendasi 1</h6>
                                <p class="card-text">Simulasi untuk kebutuhan standar kantor/rumah.</p>
                                <a href="{{ route('simulasi.index', ['id' => $rekomendasi->id]) }}"
                                    class="btn btn-outline-primary btn-sm">Lihat
                                    Rekomendasi</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="card border-success">
                            <div class="card-body">
                                <h6 class="card-title">Rekomendasi 2</h6>
                                <p class="card-text">Simulasi untuk kebutuhan gaming/berat.</p>
                                <a href="{{ route('simulasi.index', ['id' => $rekomendasi2->id]) }}"
                                    class="btn btn-outline-success btn-sm">Lihat
                                    Rekomendasi</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Simulasi</h6>
            </div>
        </div>
        <div class="card-body">
            <form id="addSimulasiForm">
                <div class="modal-body">
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning me-2" id="resetBtn">
                        <i class="bi bi-arrow-counterclockwise me-1"></i>
                    </button>
                    <button type="button" class="btn btn-secondary me-2" id="printBtn">Print</button>
                    <button type="submit" class="btn btn-primary" id="saveSimulasiBtn">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        let components = [];
        document.getElementById('printBtn').addEventListener('click', function(e) {
            e.preventDefault();
            printSimulasiForm();
        });

        // Add Simulasi
        document.getElementById("addSimulasiForm").addEventListener("submit", function(e) {
            e.preventDefault();
            saveSimulation();
        });

        // Reset form event
        document.getElementById('resetBtn').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('addSimulasiForm').reset();
            if (window.location.search) {
                window.history.replaceState({}, document.title, window.location.pathname);
            }
            populateComponentSelects();
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
                        alert('Simulasi berhasil disimpan!');
                        form.reset();
                        populateComponentSelects();
                    } else {
                        alert('Gagal menyimpan simulasi.');
                    }
                })
                .catch(error => {
                    alert('Terjadi kesalahan saat menyimpan simulasi.');
                    console.error(error);
                });
        }

        function printSimulasiForm() {
            const form = document.getElementById('addSimulasiForm');
            const printWindow = window.open('', '', 'height=600,width=800');
            let html = '<html><head><title>Print Simulasi</title>';
            html +=
                '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">';
            html += '</head><body>';
            html += '<h2>Data Simulasi</h2><table class="table table-bordered">';
            let totalHarga = 0;

            Array.from(form.elements).forEach(el => {
                if (el.tagName === 'INPUT' && el.type === 'text') {
                    html +=
                        `<tr><th>${el.previousElementSibling ? el.previousElementSibling.innerText : el.name}</th><td colspan="2">${el.value}</td></tr>`;
                }
                if (el.tagName === 'SELECT') {
                    const label = el.previousElementSibling ? el.previousElementSibling.innerText : el.name;
                    const selectedOption = el.options[el.selectedIndex];
                    const selectedText = selectedOption ? selectedOption.text : '';
                    let harga = 0;
                    // Ambil harga dari text option, format: "Nama Komponen ( Rp 1.000.000 )"
                    const match = selectedText.match(/Rp\s?([\d.,]+)/);
                    if (match) {
                        harga = Number(match[1].replace(/\./g, '').replace(',', '.'));
                        totalHarga += harga;
                    }
                    html += `<tr>
                <th>${label}</th>
                <td>${selectedText}</td>
                <td>${harga ? 'Rp ' + harga.toLocaleString('id-ID') : '-'}</td>
                </tr>`;
                }
            });

            html += `<tr>
            <th colspan="2" class="text-end">Total Harga</th>
            <th>Rp ${totalHarga.toLocaleString('id-ID')}</th>
            </tr>`;
            html += '</table></body></html>';
            printWindow.document.write(html);
            printWindow.document.close();
            printWindow.focus();
            printWindow.print();
            printWindow.close();
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
