@extends('layouts.app')
@section('breadcrumbs')
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">Component Management</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Components</li>
                </ol>
            </nav>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addComponentModal">
            <i class="bi bi-person-plus me-2"></i>Add New Component
        </button>
    </div>
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Component List</h6>
                <button id="refreshComponentsBtn" class="btn btn-sm btn-outline-primary ms-2" title="Refresh Components">
                    <i class="bi bi-arrow-clockwise"></i>
                </button>
            </div>
            <div class="search-container">
                <input type="text" id="componentSearch" class="form-control" placeholder="Search components...">
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="componentTable">
                    <thead>
                        <tr>
                            <th width="50">#</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Type</th>
                            <th>Price</th>
                            <th>Status</th>
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

    <!-- Add Component Modal -->
    <div class="modal fade" id="addComponentModal" tabindex="-1" aria-labelledby="addComponentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form id="addComponentForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addComponentModalLabel">Add New Component</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label required-field">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="code" class="form-label required-field">Code</label>
                            <input type="text" class="form-control" id="code" name="code" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="2"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="component_type_id" class="form-label required-field">Component Type</label>
                            <select class="form-select" id="component_type_id" name="component_type_id" required>
                                <option value="">-- Select Type --</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label required-field">Price</label>
                            <input type="number" class="form-control" id="price" name="price" min="0"
                                step="any" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1"
                                checked>
                            <label class="form-check-label" for="is_active">Active</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="saveComponentBtn">Save Component</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Component Modal -->
    <div class="modal fade" id="editComponentModal" tabindex="-1" aria-labelledby="editComponentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form id="editComponentForm">
                <input type="hidden" id="editComponentId" name="id">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editComponentModalLabel">Edit Component</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editName" class="form-label required-field">Name</label>
                            <input type="text" class="form-control" id="editName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="editCode" class="form-label required-field">Code</label>
                            <input type="text" class="form-control" id="editCode" name="code" required>
                        </div>
                        <div class="mb-3">
                            <label for="editDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="editDescription" name="description" rows="2"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="editComponentTypeId" class="form-label required-field">Component Type</label>
                            <select class="form-select" id="editComponentTypeId" name="component_type_id" required>
                                <option value="">-- Select Type --</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editPrice" class="form-label required-field">Price</label>
                            <input type="number" class="form-control" id="editPrice" name="price" min="0"
                                step="any" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="editIsActive" name="is_active"
                                value="1">
                            <label class="form-check-label" for="editIsActive">Active</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="updateComponentBtn">Update Component</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Component Modal -->
    <div class="modal fade" id="deleteComponentModal" tabindex="-1" aria-labelledby="deleteComponentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteComponentModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="deleteComponentId">
                    <p>Are you sure you want to delete the component <strong id="deleteComponentName"></strong>?</p>
                    <p class="text-danger"><i class="bi bi-exclamation-triangle-fill me-2"></i>This action cannot be
                        undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteComponentBtn">Delete
                        Component</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        let components = [];

        function fetchComponents() {
            document.querySelector("#componentTable tbody").innerHTML = `
            <tr>
                <td colspan="8" class="text-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2">Loading components data...</p>
                </td>
            </tr>
        `;

            fetch("{{ route('component.getDataList') }}")
                .then(res => res.json())
                .then(data => {
                    components = data.data || data;
                    initializeComponentTable();
                });
        }

        function initializeComponentTable() {
            const tbody = document.querySelector("#componentTable tbody");
            tbody.innerHTML = "";

            components.forEach((component, idx) => {
                const tr = document.createElement("tr");
                tr.innerHTML = `
                <td>${idx + 1}</td>
                <td>${component.name}</td>
                <td>${component.code}</td>
                <td>${component.type.name || ''}</td>
                <td>${component.price}</td>
                <td>
                    ${component.is_active ?
                        '<span class="badge bg-success">Active</span>' :
                        '<span class="badge bg-secondary">Inactive</span>'}
                </td>
                <td>${new Date(component.created_at).toLocaleString('id-ID', { dateStyle: 'medium', timeStyle: 'short' })}</td>
                <td>
                    <button class="btn btn-sm btn-primary edit-component" data-id="${component.id}"><i class="bi bi-pencil"></i></button>
                    <button class="btn btn-sm btn-danger delete-component" data-id="${component.id}"><i class="bi bi-trash"></i></button>
                </td>
            `;
                tbody.appendChild(tr);
            });

            addComponentActionButtonListeners();
        }

        function addComponentActionButtonListeners() {
            document.querySelectorAll(".edit-component").forEach(btn => {
                btn.onclick = function() {
                    const componentId = this.getAttribute("data-id");
                    const component = components.find(u => u.id == componentId);
                    if (component) {
                        document.getElementById("editComponentId").value = component.id;
                        document.getElementById("editName").value = component.name;
                        document.getElementById("editCode").value = component.code;
                        document.getElementById("editDescription").value = component.description || "";
                        document.getElementById("editComponentTypeId").value = component.component_type_id;
                        document.getElementById("editPrice").value = component.price;
                        document.getElementById("editIsActive").checked = !!component.is_active;
                        new bootstrap.Modal(document.getElementById("editComponentModal")).show();
                    }
                };
            });

            document.querySelectorAll(".delete-component").forEach(btn => {
                btn.onclick = function() {
                    const componentId = this.getAttribute("data-id");
                    const component = components.find(u => u.id == componentId);
                    if (component) {
                        document.getElementById("deleteComponentId").value = component.id;
                        document.getElementById("deleteComponentName").textContent = component.name;
                        new bootstrap.Modal(document.getElementById("deleteComponentModal")).show();
                    }
                };
            });
        }

        // Add Component
        document.getElementById("addComponentForm").onsubmit = function(e) {
            e.preventDefault();
            const form = this;
            const formData = new FormData(form);
            fetch("{{ route('component.store') }}", {
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
                    bootstrap.Modal.getInstance(document.getElementById("addComponentModal")).hide();
                    form.reset();
                    fetchComponents();
                })
                .catch(async err => {
                    let msg = "Failed to add component";
                    if (err.json) {
                        const data = await err.json();
                        msg = data?.message || msg;
                    }
                    alert(msg);
                });
        };

        // Edit Component
        document.getElementById("editComponentForm").onsubmit = function(e) {
            e.preventDefault();
            const componentId = document.getElementById("editComponentId").value;
            const formData = new FormData(this);
            formData.append("_method", "PUT");
            fetch(`/component/${componentId}`, {
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
                    bootstrap.Modal.getInstance(document.getElementById("editComponentModal")).hide();
                    fetchComponents();
                })
                .catch(async err => {
                    let msg = "Failed to update component";
                    if (err.json) {
                        const data = await err.json();
                        msg = data?.message || msg;
                    }
                    alert(msg);
                });
        };

        // Delete Component
        document.getElementById("confirmDeleteComponentBtn").onclick = function() {
            const componentId = document.getElementById("deleteComponentId").value;
            const formData = new FormData();
            formData.append("_token", "{{ csrf_token() }}");
            formData.append("_method", "DELETE");
            fetch(`/component/${componentId}`, {
                    method: "POST",
                    body: formData
                })
                .then(res => {
                    if (!res.ok) throw res;
                    return res.json();
                })
                .then(() => {
                    bootstrap.Modal.getInstance(document.getElementById("deleteComponentModal")).hide();
                    fetchComponents();
                })
                .catch(async err => {
                    let msg = "Failed to delete component";
                    if (err.json) {
                        const data = await err.json();
                        msg = data?.message || msg;
                    }
                    alert(msg);
                });
        };

        document.getElementById("refreshComponentsBtn").onclick = fetchComponents;

        // Search
        document.getElementById("componentSearch").onkeyup = function() {
            const val = this.value.toLowerCase();
            const filtered = components.filter(u =>
                u.name.toLowerCase().includes(val)
            );
            const tbody = document.querySelector("#componentTable tbody");
            tbody.innerHTML = "";
            filtered.forEach((component, idx) => {
                const tr = document.createElement("tr");
                tr.innerHTML = `
                 <td>${idx + 1}</td>
                <td>${component.name}</td>
                <td>${component.code}</td>
                <td>${component.type.name || ''}</td>
                <td>${component.price}</td>
                <td>
                    ${component.is_active ?
                        '<span class="badge bg-success">Active</span>' :
                        '<span class="badge bg-secondary">Inactive</span>'}
                </td>
                <td>${new Date(component.created_at).toLocaleString('id-ID', { dateStyle: 'medium', timeStyle: 'short' })}</td>
                <td>
                    <button class="btn btn-sm btn-primary edit-component" data-id="${component.id}"><i class="bi bi-pencil"></i></button>
                    <button class="btn btn-sm btn-danger delete-component" data-id="${component.id}"><i class="bi bi-trash"></i></button>
                </td>
            `;
                tbody.appendChild(tr);
            });
            addComponentActionButtonListeners();
        };

        document.addEventListener("DOMContentLoaded", fetchComponents);
    </script>
@endsection
