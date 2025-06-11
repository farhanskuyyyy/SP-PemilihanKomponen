@extends('layouts.app')
@section('breadcrumbs')
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">Rakitan Management</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Rakitan</li>
                </ol>
            </nav>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRakitanModal">
            <i class="bi bi-person-plus me-2"></i>Add New Rakitan
        </button>
    </div>
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Rakitan List</h6>
                <button id="refreshRakitanBtn" class="btn btn-sm btn-outline-primary ms-2" title="Refresh Rakitan">
                    <i class="bi bi-arrow-clockwise"></i>
                </button>
            </div>
            <div class="search-container">
                <input type="text" id="rakitanSearch" class="form-control" placeholder="Search rakitan...">
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="rakitanTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Motherboard</th>
                            <th>Processor</th>
                            <th>RAM</th>
                            <th>Casing</th>
                            <th>Storage Primary</th>
                            <th>Storage Secondary</th>
                            <th>VGA</th>
                            <th>PSU</th>
                            <th>Monitor</th>
                            <th>Created By</th>
                            <th>Created At</th>
                            <th width="120">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data loaded by JS -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Rakitan Modal -->
    <div class="modal fade" id="addRakitanModal" tabindex="-1" aria-labelledby="addRakitanModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="addRakitanForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addRakitanModalLabel">Add New Rakitan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="code" class="form-label required-field">Kode</label>
                            <input type="text" class="form-control" id="code" name="code" required>
                        </div>
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="saveRakitanBtn">Save Rakitan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Rakitan Modal -->
    <div class="modal fade" id="editRakitanModal" tabindex="-1" aria-labelledby="editRakitanModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editRakitanForm">
                <input type="hidden" id="editRakitanId" name="id">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editRakitanModalLabel">Edit Rakitan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editKode" class="form-label required-field">Kode</label>
                            <input type="text" class="form-control" id="editKode" name="code" required>
                        </div>
                        <div class="mb-3">
                            <label for="editNama" class="form-label required-field">Nama</label>
                            <input type="text" class="form-control" id="editNama" name="name" required>
                        </div>
                        @foreach (['motherboard', 'processor', 'ram', 'casing', 'storage_primary', 'storage_secondary', 'vga', 'psu', 'monitor'] as $comp)
                            <div class="mb-3">
                                <label for="edit{{ ucfirst($comp) }}"
                                    class="form-label">{{ ucfirst(str_replace('_', ' ', $comp)) }}</label>
                                <select class="form-control" id="edit{{ ucfirst($comp) }}" name="{{ $comp }}">
                                    <!-- Data komponen diisi via JS -->
                                </select>
                            </div>
                        @endforeach

                        <div class="mb-3">
                            <label class="form-label">Total Harga</label>
                            <input type="text" class="form-control" id="editTotalHarga" name="editTotalHarga"
                                readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="updateRakitanBtn">Update Rakitan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Rakitan Modal -->
    <div class="modal fade" id="deleteRakitanModal" tabindex="-1" aria-labelledby="deleteRakitanModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteRakitanModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="deleteRakitanId">
                    <p>Are you sure you want to delete the rakitan <strong id="deleteRakitanNama"></strong>?</p>
                    <p class="text-danger"><i class="bi bi-exclamation-triangle-fill me-2"></i>This action cannot be
                        undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteRakitanBtn">Delete Rakitan</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        let rakitans = [];
        let components = [];

        function fetchComponents() {
            // Ambil semua komponen, misal endpoint: /components
            return fetch("{{ route('component.getDataList') }}")
                .then(res => res.json())
                .then(data => {
                    components = data.data || data;
                });
        }

        function fetchRakitan() {
            document.querySelector("#rakitanTable tbody").innerHTML = `
            <tr>
                <td colspan="15" class="text-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2">Loading rakitan data...</p>
                </td>
            </tr>
        `;

            fetch("{{ route('rakitan.getDataList') }}")
                .then(res => res.json())
                .then(data => {
                    rakitans = data.data || data;
                    initializeRakitanTable();
                });
        }

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

        function updateTotalHargaEdit() {
            let total = 0;
            const fields = ['motherboard', 'processor', 'ram', 'casing', 'storage_primary', 'storage_secondary', 'vga',
                'psu', 'monitor'
            ];
            fields.forEach(comp => {
                const select = document.getElementById("edit" + comp.charAt(0).toUpperCase() + comp.slice(1));
                if (select && select.value) {
                    const option = select.options[select.selectedIndex];
                    const match = option.text.match(/Rp\s?([\d.,]+)/);
                    if (match) {
                        total += Number(match[1].replace(/\./g, '').replace(',', '.'));
                    }
                }
            });
            document.getElementById('editTotalHarga').value = total ? 'Rp ' + total.toLocaleString('id-ID') : '';
        }


        function initializeRakitanTable() {
            const tbody = document.querySelector("#rakitanTable tbody");
            tbody.innerHTML = "";

            rakitans.forEach((rakitan, idx) => {
                const tr = document.createElement("tr");
                tr.innerHTML = `
                <td>${idx + 1}</td>
                <td>${rakitan.code}</td>
                <td>${rakitan.name}</td>
                <td>${rakitan.motherboard.name ?? '-'}</td>
                <td>${rakitan.processor.name ?? '-'}</td>
                <td>${rakitan.ram.name ?? '-'}</td>
                <td>${rakitan.casing.name ?? '-'}</td>
                <td>${rakitan.storage_primary.name ?? '-'}</td>
                <td>${rakitan.storage_secondary.name ?? '-'}</td>
                <td>${rakitan.vga.name ?? '-'}</td>
                <td>${rakitan.psu.name ?? '-'}</td>
                <td>${rakitan.monitor.name ?? '-'}</td>
                <td>${rakitan.creator.name ?? "-"}</td>
                <td>${new Date(rakitan.created_at).toLocaleString('id-ID', { dateStyle: 'medium', timeStyle: 'short' })}</td>
                <td>
                    <button class="btn btn-sm btn-primary edit-rakitan" data-id="${rakitan.id}"><i class="bi bi-pencil"></i></button>
                    <button class="btn btn-sm btn-danger delete-rakitan" data-id="${rakitan.id}"><i class="bi bi-trash"></i></button>
                </td>
            `;
                tbody.appendChild(tr);
            });

            addRakitanActionButtonListeners();
        }

        function addRakitanActionButtonListeners() {
            document.querySelectorAll(".edit-rakitan").forEach(btn => {
                btn.onclick = function() {
                    const rakitanId = this.getAttribute("data-id");
                    const rakitan = rakitans.find(u => u.id == rakitanId);
                    if (rakitan) {
                        document.getElementById("editRakitanId").value = rakitan.id;
                        document.getElementById("editKode").value = rakitan.code;
                        document.getElementById("editNama").value = rakitan.name;
                        ['motherboard', 'processor', 'ram', 'casing', 'storage_primary', 'storage_secondary',
                            'vga', 'psu', 'monitor'
                        ].forEach(comp => {
                            const select = document.getElementById("edit" + comp.charAt(0)
                                .toUpperCase() + comp.slice(1));
                            if (select) {
                                select.value = rakitan[comp]?.id || "";
                            }
                        });
                        updateTotalHargaEdit();
                        new bootstrap.Modal(document.getElementById("editRakitanModal")).show();
                    }
                };
            });

            document.querySelectorAll(".delete-rakitan").forEach(btn => {
                btn.onclick = function() {
                    const rakitanId = this.getAttribute("data-id");
                    const rakitan = rakitans.find(u => u.id == rakitanId);
                    if (rakitan) {
                        document.getElementById("deleteRakitanId").value = rakitan.id;
                        document.getElementById("deleteRakitanNama").textContent = rakitan.name;
                        new bootstrap.Modal(document.getElementById("deleteRakitanModal")).show();
                    }
                };
            });
        }

        // Add Rakitan
        document.getElementById("addRakitanForm").onsubmit = function(e) {
            e.preventDefault();
            const form = this;
            const formData = new FormData(form);
            fetch("{{ route('rakitan.store') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: formData
                })
                .then(res => {
                    if (!res.ok) throw res;
                    return res.json();
                })
                .then(() => {
                    bootstrap.Modal.getInstance(document.getElementById("addRakitanModal")).hide();
                    form.reset();
                    fetchRakitan();
                })
                .catch(async err => {
                    let msg = "Failed to add rakitan";
                    if (err.json) {
                        const data = await err.json();
                        msg = data?.message || msg;
                    }
                    alert(msg);
                });
        };

        // Edit Rakitan
        document.getElementById("editRakitanForm").onsubmit = function(e) {
            e.preventDefault();
            const rakitanId = document.getElementById("editRakitanId").value;
            const formData = new FormData(this);
            formData.append("_method", "PUT");
            fetch(`/rakitan/${rakitanId}`, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: formData
                })
                .then(res => {
                    if (!res.ok) throw res;
                    return res.json();
                })
                .then(() => {
                    bootstrap.Modal.getInstance(document.getElementById("editRakitanModal")).hide();
                    fetchRakitan();
                })
                .catch(async err => {
                    let msg = "Failed to update rakitan";
                    if (err.json) {
                        const data = await err.json();
                        msg = data?.message || msg;
                    }
                    alert(msg);
                });
        };

        // Delete Rakitan
        document.getElementById("confirmDeleteRakitanBtn").onclick = function() {
            const rakitanId = document.getElementById("deleteRakitanId").value;
            const formData = new FormData();
            formData.append("_token", "{{ csrf_token() }}");
            formData.append("_method", "DELETE");
            fetch(`/rakitan/${rakitanId}`, {
                    method: "POST",
                    body: formData
                })
                .then(res => {
                    if (!res.ok) throw res;
                    return res.json();
                })
                .then(() => {
                    bootstrap.Modal.getInstance(document.getElementById("deleteRakitanModal")).hide();
                    fetchRakitan();
                })
                .catch(async err => {
                    let msg = "Failed to delete rakitan";
                    if (err.json) {
                        const data = await err.json();
                        msg = data?.message || msg;
                    }
                    alert(msg);
                });
        };

        document.getElementById("refreshRakitanBtn").onclick = fetchRakitan;

        // Search
        document.getElementById("rakitanSearch").onkeyup = function() {
            const val = this.value.toLowerCase();
            const filtered = rakitans.filter(u =>
                u.name.toLowerCase().includes(val) ||
                u.code.toLowerCase().includes(val) ||
                (u.motherboard && u.motherboard.name && u.motherboard.name.toLowerCase().includes(val)) ||
                (u.processor && u.processor.name && u.processor.name.toLowerCase().includes(val)) ||
                (u.ram && u.ram.name && u.ram.name.toLowerCase().includes(val)) ||
                (u.casing && u.casing.name && u.casing.name.toLowerCase().includes(val)) ||
                (u.storage_primary && u.storage_primary.name && u.storage_primary.name.toLowerCase().includes(
                    val)) ||
                (u.storage_secondary && u.storage_secondary.name && u.storage_secondary.name.toLowerCase().includes(
                    val)) ||
                (u.vga && u.vga.name && u.vga.name.toLowerCase().includes(val)) ||
                (u.psu && u.psu.name && u.psu.name.toLowerCase().includes(val)) ||
                (u.monitor && u.monitor.name && u.monitor.name.toLowerCase().includes(val)) ||
                (u.creator && u.creator.name && u.creator.name.toLowerCase().includes(val))
            );
            const tbody = document.querySelector("#rakitanTable tbody");
            tbody.innerHTML = "";
            filtered.forEach((rakitan, idx) => {
                const tr = document.createElement("tr");
                tr.innerHTML = `
                <td>${idx + 1}</td>
                <td>${rakitan.code}</td>
                <td>${rakitan.name}</td>
                <td>${rakitan.motherboard.name ?? '-'}</td>
                <td>${rakitan.processor.name ?? '-'}</td>
                <td>${rakitan.ram.name ?? '-'}</td>
                <td>${rakitan.casing.name ?? '-'}</td>
                <td>${rakitan.storage_primary.name ?? '-'}</td>
                <td>${rakitan.storage_secondary.name ?? '-'}</td>
                <td>${rakitan.vga.name ?? '-'}</td>
                <td>${rakitan.psu.name ?? '-'}</td>
                <td>${rakitan.monitor.name ?? '-'}</td>
                <td>${rakitan.creator.name ?? "-"}</td>
                <td>${new Date(rakitan.created_at).toLocaleString('id-ID', { dateStyle: 'medium', timeStyle: 'short' })}</td>
                <td>
                    <button class="btn btn-sm btn-primary edit-rakitan" data-id="${rakitan.id}"><i class="bi bi-pencil"></i></button>
                    <button class="btn btn-sm btn-danger delete-rakitan" data-id="${rakitan.id}"><i class="bi bi-trash"></i></button>
                </td>
            `;
                tbody.appendChild(tr);
            });
            addRakitanActionButtonListeners();
        };

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

        document.addEventListener("DOMContentLoaded", function() {
            fetchComponents().then(() => {
                populateComponentSelects();
                fetchRakitan();
                const fields = ['motherboard', 'processor', 'ram', 'casing', 'storage_primary',
                    'storage_secondary',
                    'vga', 'psu', 'monitor'
                ];
                fields.forEach(comp => {
                    const select = document.getElementById(comp);
                    if (select) {
                        select.addEventListener('change', updateTotalHarga);
                    }
                });
                fields.forEach(comp => {
                    const select = document.getElementById("edit" + comp.charAt(0)
                        .toUpperCase() + comp.slice(1));
                    if (select) {
                        select.addEventListener('change', updateTotalHargaEdit);
                    }
                });
                updateTotalHarga();
            });
        });
    </script>
@endsection
