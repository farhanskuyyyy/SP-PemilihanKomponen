@extends('layouts.app')
@section('breadcrumbs')
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">Component Type Management</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Component Types</li>
                </ol>
            </nav>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addComponentTypeModal">
            <i class="bi bi-person-plus me-2"></i>Add New Component Type
        </button>
    </div>
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Component Type List</h6>
                <button id="refreshComponentTypesBtn" class="btn btn-sm btn-outline-primary ms-2" title="Refresh Component Types">
                    <i class="bi bi-arrow-clockwise"></i>
                </button>
            </div>
            <div class="search-container">
                <input type="text" id="componentTypeSearch" class="form-control" placeholder="Search component types...">
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="componentTypeTable">
                    <thead>
                        <tr>
                            <th width="50">#</th>
                            <th>Name</th>
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

    <!-- Add Component Type Modal -->
    <div class="modal fade" id="addComponentTypeModal" tabindex="-1" aria-labelledby="addComponentTypeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="addComponentTypeForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addComponentTypeModalLabel">Add New Component Type</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label required-field">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="saveComponentTypeBtn">Save Component Type</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Component Type Modal -->
    <div class="modal fade" id="editComponentTypeModal" tabindex="-1" aria-labelledby="editComponentTypeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editComponentTypeForm">
                <input type="hidden" id="editComponentTypeId" name="id">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editComponentTypeModalLabel">Edit Component Type</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editName" class="form-label required-field">Name</label>
                            <input type="text" class="form-control" id="editName" name="name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="updateComponentTypeBtn">Update Component Type</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Component Type Modal -->
    <div class="modal fade" id="deleteComponentTypeModal" tabindex="-1" aria-labelledby="deleteComponentTypeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteComponentTypeModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="deleteComponentTypeId">
                    <p>Are you sure you want to delete the component type <strong id="deleteComponentTypeName"></strong>?</p>
                    <p class="text-danger"><i class="bi bi-exclamation-triangle-fill me-2"></i>This action cannot be
                        undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteComponentTypeBtn">Delete Component Type</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    let componentTypes = [];

    function fetchComponentTypes() {
        document.querySelector("#componentTypeTable tbody").innerHTML = `
            <tr>
                <td colspan="4" class="text-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2">Loading component types data...</p>
                </td>
            </tr>
        `;

        fetch("{{ route('component-type.getDataList') }}")
            .then(res => res.json())
            .then(data => {
                componentTypes = data.data || data;
                initializeComponentTypeTable();
            });
    }

    function initializeComponentTypeTable() {
        const tbody = document.querySelector("#componentTypeTable tbody");
        tbody.innerHTML = "";

        componentTypes.forEach((componentType, idx) => {
            const tr = document.createElement("tr");
            tr.innerHTML = `
                <td>${idx + 1}</td>
                <td>${componentType.name}</td>
                <td>${new Date(componentType.created_at).toLocaleString('id-ID', { dateStyle: 'medium', timeStyle: 'short' })}</td>
                <td>
                    <button class="btn btn-sm btn-primary edit-component-type" data-id="${componentType.id}"><i class="bi bi-pencil"></i></button>
                    <button class="btn btn-sm btn-danger delete-component-type" data-id="${componentType.id}"><i class="bi bi-trash"></i></button>
                </td>
            `;
            tbody.appendChild(tr);
        });

        addComponentTypeActionButtonListeners();
    }

    function addComponentTypeActionButtonListeners() {
        document.querySelectorAll(".edit-component-type").forEach(btn => {
            btn.onclick = function() {
                const componentTypeId = this.getAttribute("data-id");
                const componentType = componentTypes.find(u => u.id == componentTypeId);
                if (componentType) {
                    document.getElementById("editComponentTypeId").value = componentType.id;
                    document.getElementById("editName").value = componentType.name;
                    new bootstrap.Modal(document.getElementById("editComponentTypeModal")).show();
                }
            };
        });

        document.querySelectorAll(".delete-component-type").forEach(btn => {
            btn.onclick = function() {
                const componentTypeId = this.getAttribute("data-id");
                const componentType = componentTypes.find(u => u.id == componentTypeId);
                if (componentType) {
                    document.getElementById("deleteComponentTypeId").value = componentType.id;
                    document.getElementById("deleteComponentTypeName").textContent = componentType.name;
                    new bootstrap.Modal(document.getElementById("deleteComponentTypeModal")).show();
                }
            };
        });
    }

    // Add Component Type
    document.getElementById("addComponentTypeForm").onsubmit = function(e) {
        e.preventDefault();
        const form = this;
        const formData = new FormData(form);
        fetch("{{ route('component-type.store') }}", {
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
            bootstrap.Modal.getInstance(document.getElementById("addComponentTypeModal")).hide();
            form.reset();
            fetchComponentTypes();
        })
        .catch(async err => {
            let msg = "Failed to add component type";
            if (err.json) {
                const data = await err.json();
                msg = data?.message || msg;
            }
            alert(msg);
        });
    };

    // Edit Component Type
    document.getElementById("editComponentTypeForm").onsubmit = function(e) {
        e.preventDefault();
        const componentTypeId = document.getElementById("editComponentTypeId").value;
        const formData = new FormData(this);
        formData.append("_method", "PUT");
        fetch(`/component-type/${componentTypeId}`, {
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
            bootstrap.Modal.getInstance(document.getElementById("editComponentTypeModal")).hide();
            fetchComponentTypes();
        })
        .catch(async err => {
            let msg = "Failed to update component type";
            if (err.json) {
                const data = await err.json();
                msg = data?.message || msg;
            }
            alert(msg);
        });
    };

    // Delete Component Type
    document.getElementById("confirmDeleteComponentTypeBtn").onclick = function() {
        const componentTypeId = document.getElementById("deleteComponentTypeId").value;
        const formData = new FormData();
        formData.append("_token", "{{ csrf_token() }}");
        formData.append("_method", "DELETE");
        fetch(`/component-type/${componentTypeId}`, {
            method: "POST",
            body: formData
        })
        .then(res => {
            if (!res.ok) throw res;
            return res.json();
        })
        .then(() => {
            bootstrap.Modal.getInstance(document.getElementById("deleteComponentTypeModal")).hide();
            fetchComponentTypes();
        })
        .catch(async err => {
            let msg = "Failed to delete component type";
            if (err.json) {
                const data = await err.json();
                msg = data?.message || msg;
            }
            alert(msg);
        });
    };

    document.getElementById("refreshComponentTypesBtn").onclick = fetchComponentTypes;

    // Search
    document.getElementById("componentTypeSearch").onkeyup = function() {
        const val = this.value.toLowerCase();
        const filtered = componentTypes.filter(u =>
            u.name.toLowerCase().includes(val)
        );
        const tbody = document.querySelector("#componentTypeTable tbody");
        tbody.innerHTML = "";
        filtered.forEach((componentType, idx) => {
            const tr = document.createElement("tr");
            tr.innerHTML = `
                <td>${idx + 1}</td>
                <td>${componentType.name}</td>
                <td>${new Date(componentType.created_at).toLocaleString('id-ID', { dateStyle: 'medium', timeStyle: 'short' })}</td>
                <td>
                    <button class="btn btn-sm btn-primary edit-component-type" data-id="${componentType.id}"><i class="bi bi-pencil"></i></button>
                    <button class="btn btn-sm btn-danger delete-component-type" data-id="${componentType.id}"><i class="bi bi-trash"></i></button>
                </td>
            `;
            tbody.appendChild(tr);
        });
        addComponentTypeActionButtonListeners();
    };

    document.addEventListener("DOMContentLoaded", fetchComponentTypes);
</script>
@endsection
