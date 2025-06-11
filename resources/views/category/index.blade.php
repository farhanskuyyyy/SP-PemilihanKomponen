@extends('layouts.app')
@section('breadcrumbs')
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">Category Management</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Categories</li>
                </ol>
            </nav>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
            <i class="bi bi-person-plus me-2"></i>Add New Category
        </button>
    </div>
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Category List</h6>
                <button id="refreshCategoriesBtn" class="btn btn-sm btn-outline-primary ms-2" title="Refresh Categories">
                    <i class="bi bi-arrow-clockwise"></i>
                </button>
            </div>
            <div class="search-container">
                <input type="text" id="categorySearch" class="form-control" placeholder="Search categories...">
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="categoryTable">
                    <thead>
                        <tr>
                            <th width="50">#</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Value</th>
                            <th>Clasification</th>
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

    <!-- Add Category Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="addCategoryForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCategoryModalLabel">Add New Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="code" class="form-label required-field">Code</label>
                            <input type="text" class="form-control" id="code" name="code" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label required-field">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="value" class="form-label required-field">Value</label>
                            <input type="text" class="form-control" id="value" name="value" required>
                        </div>
                        <div class="mb-3">
                            <label for="clasification_id" class="form-label required-field">Clasification</label>
                            <select class="form-select" id="clasification_id" name="clasification_id" required>
                                <option value="">-- Select Clasification --</option>
                                @foreach ($clasifications as $clasification)
                                    <option value="{{ $clasification->id }}">{{ $clasification->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="saveCategoryBtn">Save Category</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form id="editCategoryForm">
                <input type="hidden" id="editCategoryId" name="id">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editCode" class="form-label required-field">Code</label>
                            <input type="text" class="form-control" id="editCode" name="code" required>
                        </div>
                        <div class="mb-3">
                            <label for="editName" class="form-label required-field">Name</label>
                            <input type="text" class="form-control" id="editName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="editValue" class="form-label required-field">Value</label>
                            <input type="text" class="form-control" id="editValue" name="value" required>
                        </div>
                        <div class="mb-3">
                            <label for="editClasificationId" class="form-label required-field">Clasification</label>
                            <select class="form-select" id="editClasificationId" name="clasification_id" required>
                                <option value="">-- Select Clasification --</option>
                                @foreach ($clasifications as $clasification)
                                    <option value="{{ $clasification->id }}">{{ $clasification->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="updateCategoryBtn">Update Category</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Category Modal -->
    <div class="modal fade" id="deleteCategoryModal" tabindex="-1" aria-labelledby="deleteCategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteCategoryModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="deleteCategoryId">
                    <p>Are you sure you want to delete the category <strong id="deleteCategoryName"></strong>?</p>
                    <p class="text-danger"><i class="bi bi-exclamation-triangle-fill me-2"></i>This action cannot be
                        undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteCategoryBtn">Delete
                        Category</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        let categories = [];

        function fetchCategories() {
            document.querySelector("#categoryTable tbody").innerHTML = `
            <tr>
                <td colspan="6" class="text-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2">Loading categories data...</p>
                </td>
            </tr>
        `;

            fetch("{{ route('category.getDataList') }}")
                .then(res => res.json())
                .then(data => {
                    categories = data.data || data;
                    initializeCategoryTable();
                });
        }

        function initializeCategoryTable() {
            const tbody = document.querySelector("#categoryTable tbody");
            tbody.innerHTML = "";

            categories.forEach((category, idx) => {
                const tr = document.createElement("tr");
                tr.innerHTML = `
                <td>${idx + 1}</td>
                <td>${category.code}</td>
                <td>${category.name}</td>
                <td>${category.value}</td>
                <td>${category.clasification?.name || ''}</td>
                <td>
                    <button class="btn btn-sm btn-primary edit-category" data-id="${category.id}"><i class="bi bi-pencil"></i></button>
                    <button class="btn btn-sm btn-danger delete-category" data-id="${category.id}"><i class="bi bi-trash"></i></button>
                </td>
            `;
                tbody.appendChild(tr);
            });

            addCategoryActionButtonListeners();
        }

        function addCategoryActionButtonListeners() {
            document.querySelectorAll(".edit-category").forEach(btn => {
                btn.onclick = function() {
                    const categoryId = this.getAttribute("data-id");
                    const category = categories.find(u => u.id == categoryId);
                    if (category) {
                        console.log(category)
                        document.getElementById("editCategoryId").value = category.id;
                        document.getElementById("editCode").value = category.code;
                        document.getElementById("editName").value = category.name;
                        document.getElementById("editValue").value = category.value;
                        document.getElementById("editClasificationId").value = category.clasification_id;
                        new bootstrap.Modal(document.getElementById("editCategoryModal")).show();
                    }
                };
            });

            document.querySelectorAll(".delete-category").forEach(btn => {
                btn.onclick = function() {
                    const categoryId = this.getAttribute("data-id");
                    const category = categories.find(u => u.id == categoryId);
                    if (category) {
                        document.getElementById("deleteCategoryId").value = category.id;
                        document.getElementById("deleteCategoryName").textContent = category.name;
                        new bootstrap.Modal(document.getElementById("deleteCategoryModal")).show();
                    }
                };
            });
        }

        // Add Category
        document.getElementById("addCategoryForm").onsubmit = function(e) {
            e.preventDefault();
            const form = this;
            const formData = new FormData(form);
            fetch("{{ route('category.store') }}", {
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
                    bootstrap.Modal.getInstance(document.getElementById("addCategoryModal")).hide();
                    form.reset();
                    fetchCategories();
                })
                .catch(async err => {
                    let msg = "Failed to add category";
                    if (err.json) {
                        const data = await err.json();
                        msg = data?.message || msg;
                    }
                    alert(msg);
                });
        };

        // Edit Category
        document.getElementById("editCategoryForm").onsubmit = function(e) {
            e.preventDefault();
            const categoryId = document.getElementById("editCategoryId").value;
            const formData = new FormData(this);
            formData.append("_method", "PUT");
            fetch(`/category/${categoryId}`, {
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
                    bootstrap.Modal.getInstance(document.getElementById("editCategoryModal")).hide();
                    fetchCategories();
                })
                .catch(async err => {
                    let msg = "Failed to update category";
                    if (err.json) {
                        const data = await err.json();
                        msg = data?.message || msg;
                    }
                    alert(msg);
                });
        };

        // Delete Category
        document.getElementById("confirmDeleteCategoryBtn").onclick = function() {
            const categoryId = document.getElementById("deleteCategoryId").value;
            const formData = new FormData();
            formData.append("_token", "{{ csrf_token() }}");
            formData.append("_method", "DELETE");
            fetch(`/category/${categoryId}`, {
                    method: "POST",
                    body: formData
                })
                .then(res => {
                    if (!res.ok) throw res;
                    return res.json();
                })
                .then(() => {
                    bootstrap.Modal.getInstance(document.getElementById("deleteCategoryModal")).hide();
                    fetchCategories();
                })
                .catch(async err => {
                    let msg = "Failed to delete category";
                    if (err.json) {
                        const data = await err.json();
                        msg = data?.message || msg;
                    }
                    alert(msg);
                });
        };

        document.getElementById("refreshCategoriesBtn").onclick = fetchCategories;

        // Search
        document.getElementById("categorySearch").onkeyup = function() {
            const val = this.value.toLowerCase();
            const filtered = categories.filter(u =>
                u.name.toLowerCase().includes(val)
            );
            const tbody = document.querySelector("#categoryTable tbody");
            tbody.innerHTML = "";
            filtered.forEach((category, idx) => {
                const tr = document.createElement("tr");
                tr.innerHTML = `
                 <td>${idx + 1}</td>
                <td>${category.code}</td>
                <td>${category.name}</td>
                <td>${category.value}</td>
                <td>${category.clasification?.name || ''}</td>
                <td>
                    <button class="btn btn-sm btn-primary edit-category" data-id="${category.id}"><i class="bi bi-pencil"></i></button>
                    <button class="btn btn-sm btn-danger delete-category" data-id="${category.id}"><i class="bi bi-trash"></i></button>
                </td>
            `;
                tbody.appendChild(tr);
            });
            addCategoryActionButtonListeners();
        };

        document.addEventListener("DOMContentLoaded", fetchCategories);
    </script>
@endsection
