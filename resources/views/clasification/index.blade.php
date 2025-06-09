@extends('layouts.app')
@section('breadcrumbs')
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">Clasification Management</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Clasifications</li>
                </ol>
            </nav>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addClasificationModal">
            <i class="bi bi-person-plus me-2"></i>Add New Clasification
        </button>
    </div>
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Clasification List</h6>
                <button id="refreshClasificationsBtn" class="btn btn-sm btn-outline-primary ms-2" title="Refresh Clasifications">
                    <i class="bi bi-arrow-clockwise"></i>
                </button>
            </div>
            <div class="search-container">
                <input type="text" id="clasificationSearch" class="form-control" placeholder="Search clasifications...">
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="clasificationTable">
                    <thead>
                        <tr>
                            <th width="50">#</th>
                            <th>Name</th>
                            <th>Pertanyaan</th>
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

    <!-- Add Clasification Modal -->
    <div class="modal fade" id="addClasificationModal" tabindex="-1" aria-labelledby="addClasificationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="addClasificationForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addClasificationModalLabel">Add New Clasification</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label required-field">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="pertanyaan" class="form-label required-field">Pertanyaan</label>
                            <input type="text" class="form-control" id="pertanyaan" name="pertanyaan" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="saveClasificationBtn">Save Clasification</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Clasification Modal -->
    <div class="modal fade" id="editClasificationModal" tabindex="-1" aria-labelledby="editClasificationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editClasificationForm">
                <input type="hidden" id="editClasificationId" name="id">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editClasificationModalLabel">Edit Clasification</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editName" class="form-label required-field">Name</label>
                            <input type="text" class="form-control" id="editName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="editPertanyaan" class="form-label required-field">Pertanyaan</label>
                            <input type="text" class="form-control" id="editPertanyaan" name="pertanyaan" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="updateClasificationBtn">Update Clasification</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Clasification Modal -->
    <div class="modal fade" id="deleteClasificationModal" tabindex="-1" aria-labelledby="deleteClasificationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteClasificationModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="deleteClasificationId">
                    <p>Are you sure you want to delete the clasification <strong id="deleteClasificationName"></strong>?</p>
                    <p class="text-danger"><i class="bi bi-exclamation-triangle-fill me-2"></i>This action cannot be
                        undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteClasificationBtn">Delete Clasification</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    let clasifications = [];

    function fetchClasifications() {
        document.querySelector("#clasificationTable tbody").innerHTML = `
            <tr>
                <td colspan="5" class="text-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2">Loading clasifications data...</p>
                </td>
            </tr>
        `;

        fetch("{{ route('clasification.getDataList') }}")
            .then(res => res.json())
            .then(data => {
                clasifications = data.data || data;
                initializeClasificationTable();
            });
    }

    function initializeClasificationTable() {
        const tbody = document.querySelector("#clasificationTable tbody");
        tbody.innerHTML = "";

        clasifications.forEach((clasification, idx) => {
            const tr = document.createElement("tr");
            tr.innerHTML = `
                <td>${idx + 1}</td>
                <td>${clasification.name || ''}</td>
                <td>${clasification.pertanyaan}</td>
                <td>${new Date(clasification.created_at).toLocaleString('id-ID', { dateStyle: 'medium', timeStyle: 'short' })}</td>
                <td>
                    <button class="btn btn-sm btn-primary edit-clasification" data-id="${clasification.id}"><i class="bi bi-pencil"></i></button>
                    <button class="btn btn-sm btn-danger delete-clasification" data-id="${clasification.id}"><i class="bi bi-trash"></i></button>
                </td>
            `;
            tbody.appendChild(tr);
        });

        addClasificationActionButtonListeners();
    }

    function addClasificationActionButtonListeners() {
        document.querySelectorAll(".edit-clasification").forEach(btn => {
            btn.onclick = function() {
                const clasificationId = this.getAttribute("data-id");
                const clasification = clasifications.find(u => u.id == clasificationId);
                if (clasification) {
                    document.getElementById("editClasificationId").value = clasification.id;
                    document.getElementById("editName").value = clasification.name || '';
                    document.getElementById("editPertanyaan").value = clasification.pertanyaan;
                    new bootstrap.Modal(document.getElementById("editClasificationModal")).show();
                }
            };
        });

        document.querySelectorAll(".delete-clasification").forEach(btn => {
            btn.onclick = function() {
                const clasificationId = this.getAttribute("data-id");
                const clasification = clasifications.find(u => u.id == clasificationId);
                if (clasification) {
                    document.getElementById("deleteClasificationId").value = clasification.id;
                    document.getElementById("deleteClasificationName").textContent = clasification.name || '';
                    new bootstrap.Modal(document.getElementById("deleteClasificationModal")).show();
                }
            };
        });
    }

    // Add Clasification
    document.getElementById("addClasificationForm").onsubmit = function(e) {
        e.preventDefault();
        const form = this;
        const formData = new FormData(form);
        fetch("{{ route('clasification.store') }}", {
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
            bootstrap.Modal.getInstance(document.getElementById("addClasificationModal")).hide();
            form.reset();
            fetchClasifications();
        })
        .catch(async err => {
            let msg = "Failed to add clasification";
            if (err.json) {
                const data = await err.json();
                msg = data?.message || msg;
            }
            alert(msg);
        });
    };

    // Edit Clasification
    document.getElementById("editClasificationForm").onsubmit = function(e) {
        e.preventDefault();
        const clasificationId = document.getElementById("editClasificationId").value;
        const formData = new FormData(this);
        formData.append("_method", "PUT");
        fetch(`/clasification/${clasificationId}`, {
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
            bootstrap.Modal.getInstance(document.getElementById("editClasificationModal")).hide();
            fetchClasifications();
        })
        .catch(async err => {
            let msg = "Failed to update clasification";
            if (err.json) {
                const data = await err.json();
                msg = data?.message || msg;
            }
            alert(msg);
        });
    };

    // Delete Clasification
    document.getElementById("confirmDeleteClasificationBtn").onclick = function() {
        const clasificationId = document.getElementById("deleteClasificationId").value;
        const formData = new FormData();
        formData.append("_token", "{{ csrf_token() }}");
        formData.append("_method", "DELETE");
        fetch(`/clasification/${clasificationId}`, {
            method: "POST",
            body: formData
        })
        .then(res => {
            if (!res.ok) throw res;
            return res.json();
        })
        .then(() => {
            bootstrap.Modal.getInstance(document.getElementById("deleteClasificationModal")).hide();
            fetchClasifications();
        })
        .catch(async err => {
            let msg = "Failed to delete clasification";
            if (err.json) {
                const data = await err.json();
                msg = data?.message || msg;
            }
            alert(msg);
        });
    };

    document.getElementById("refreshClasificationsBtn").onclick = fetchClasifications;

    // Search
    document.getElementById("clasificationSearch").onkeyup = function() {
        const val = this.value.toLowerCase();
        const filtered = clasifications.filter(u =>
            (u.name && u.name.toLowerCase().includes(val)) ||
            (u.pertanyaan && u.pertanyaan.toLowerCase().includes(val))
        );
        const tbody = document.querySelector("#clasificationTable tbody");
        tbody.innerHTML = "";
        filtered.forEach((clasification, idx) => {
            const tr = document.createElement("tr");
            tr.innerHTML = `
                <td>${idx + 1}</td>
                <td>${clasification.name || ''}</td>
                <td>${clasification.pertanyaan}</td>
                <td>${new Date(clasification.created_at).toLocaleString('id-ID', { dateStyle: 'medium', timeStyle: 'short' })}</td>
                <td>
                    <button class="btn btn-sm btn-primary edit-clasification" data-id="${clasification.id}"><i class="bi bi-pencil"></i></button>
                    <button class="btn btn-sm btn-danger delete-clasification" data-id="${clasification.id}"><i class="bi bi-trash"></i></button>
                </td>
            `;
            tbody.appendChild(tr);
        });
        addClasificationActionButtonListeners();
    };

    document.addEventListener("DOMContentLoaded", fetchClasifications);
</script>
@endsection
