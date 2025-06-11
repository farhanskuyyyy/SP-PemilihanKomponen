@extends('layouts.app')
@section('breadcrumbs')
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">Rule Management</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Rules</li>
                </ol>
            </nav>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRuleModal">
            <i class="bi bi-person-plus me-2"></i>Add New Rule
        </button>
    </div>
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Rule List</h6>
                <button id="refreshRulesBtn" class="btn btn-sm btn-outline-primary ms-2" title="Refresh Rules">
                    <i class="bi bi-arrow-clockwise"></i>
                </button>
            </div>
            <div class="search-container">
                <input type="text" id="ruleSearch" class="form-control" placeholder="Search rules...">
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="ruleTable">
                    <thead>
                        <tr>
                            <th width="50">#</th>
                            <th>Kondisi</th>
                            <th>Description</th>
                            <th>Solusi</th>
                            <th>Solusi Rekomendasi</th>
                            <th>Description Rekomendasi</th>
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

    <!-- Add Rule Modal -->
    <div class="modal fade" id="addRuleModal" tabindex="-1" aria-labelledby="addRuleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="addRuleForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addRuleModalLabel">Add New Rule</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label required-field">Clasification</label>
                            <div>
                                @foreach ($clasifications as $class)
                                    <p>{{ $class->name }}</p>
                                    @foreach ($class->categories as $category)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="categories[]"
                                                id="category_{{ $category->id }}" value="{{ $category->id }}">
                                            <label class="form-check-label"
                                                for="category_{{ $category->id }}">{{ $category->name }}</label>
                                        </div>
                                    @endforeach
                                    <hr>
                                @endforeach
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label required-field">Description</label>
                            <textarea class="form-control" id="description" name="description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="solusi" class="form-label required-field">Solusi</label>
                            <select class="form-select" id="solusi" name="solusi" required>
                                <option value="" disabled selected>Pilih Solusi</option>
                                @foreach ($rakitans as $rakitan)
                                    <option value="{{ $rakitan->id }}">{{ $rakitan->code }} - {{ $rakitan->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="solusi_rekomendasi" class="form-label">Solusi Rekomendasi</label>
                            <select class="form-select" id="solusi_rekomendasi" name="solusi_rekomendasi">
                                <option value="" disabled selected>Pilih Solusi Rekomendasi</option>
                                @foreach ($rakitans as $rakitan)
                                    <option value="{{ $rakitan->id }}">{{ $rakitan->code }} - {{ $rakitan->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="description_rekomendasi" class="form-label">Description Rekomendasi</label>
                            <textarea class="form-control" id="description_rekomendasi" name="description_rekomendasi"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="saveRuleBtn">Save Rule</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Rule Modal -->
    <div class="modal fade" id="editRuleModal" tabindex="-1" aria-labelledby="editRuleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editRuleForm">
                <input type="hidden" id="editRuleId" name="id">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editRuleModalLabel">Edit Rule</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label required-field">Categories</label>
                            <div>
                                @foreach ($clasifications as $class)
                                    <p>{{ $class->name }}</p>
                                    @foreach ($class->categories as $category)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="categories[]"
                                                id="edit_category_{{ $category->id }}" value="{{ $category->id }}">
                                            <label class="form-check-label"
                                                for="edit_category_{{ $category->id }}">{{ $category->name }}</label>
                                        </div>
                                    @endforeach
                                    <hr>
                                @endforeach
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="editDescription" class="form-label required-field">Description</label>
                            <textarea class="form-control" id="editDescription" name="description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="editSolusi" class="form-label required-field">Solusi</label>
                            <select class="form-select" id="editSolusi" name="solusi" required>
                                <option value="" disabled selected>Pilih Solusi</option>
                                @foreach ($rakitans as $rakitan)
                                    <option value="{{ $rakitan->id }}">{{ $rakitan->code }} - {{ $rakitan->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editSolusiRekomendasi" class="form-label">Solusi Rekomendasi</label>
                            <select class="form-select" id="editSolusiRekomendasi" name="solusi_rekomendasi">
                                <option value="" disabled selected>Pilih Solusi Rekomendasi</option>
                                @foreach ($rakitans as $rakitan)
                                    <option value="{{ $rakitan->id }}">{{ $rakitan->code }} - {{ $rakitan->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editDescriptionRekomendasi" class="form-label">Description Rekomendasi</label>
                            <textarea class="form-control" id="editDescriptionRekomendasi" name="description_rekomendasi"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="updateRuleBtn">Update Rule</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Rule Modal -->
    <div class="modal fade" id="deleteRuleModal" tabindex="-1" aria-labelledby="deleteRuleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteRuleModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="deleteRuleId">
                    <p>Are you sure you want to delete the rule <strong id="deleteRuleDescription"></strong>?</p>
                    <p class="text-danger"><i class="bi bi-exclamation-triangle-fill me-2"></i>This action cannot be
                        undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteRuleBtn">Delete Rule</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        let rules = [];

        function fetchRules() {
            document.querySelector("#ruleTable tbody").innerHTML = `
            <tr>
                <td colspan="6" class="text-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2">Loading rules data...</p>
                </td>
            </tr>
        `;

            fetch("{{ route('rule.getDataList') }}")
                .then(res => res.json())
                .then(data => {
                    rules = data.data || data;
                    initializeRuleTable();
                });
        }

        function initializeRuleTable() {
            const tbody = document.querySelector("#ruleTable tbody");
            tbody.innerHTML = "";

            rules.forEach((rule, idx) => {
                const tr = document.createElement("tr");
                tr.innerHTML = `
                <td>${idx + 1}</td>
                <td>${Array.isArray(rule.category_codes) ? rule.category_codes.join(", ") : rule.category_codes}</td>
                <td>${rule.description}</td>
                <td>${rule.solusi.code}</td>
                <td>${rule.solusi_rekomendasi ? rule.solusi_rekomendasi.code : "-"}</td>
                <td>${rule.description_rekomendasi ?? "-"}</td>
                <td>
                    <button class="btn btn-sm btn-primary edit-rule" data-id="${rule.id}"><i class="bi bi-pencil"></i></button>
                    <button class="btn btn-sm btn-danger delete-rule" data-id="${rule.id}"><i class="bi bi-trash"></i></button>
                </td>
            `;
                tbody.appendChild(tr);
            });

            addRuleActionButtonListeners();
        }

        function addRuleActionButtonListeners() {
            document.querySelectorAll(".edit-rule").forEach(btn => {
                btn.onclick = function() {
                    const ruleId = this.getAttribute("data-id");
                    const rule = rules.find(u => u.id == ruleId);
                    if (rule) {
                        document.getElementById("editRuleId").value = rule.id;
                        document.getElementById("editDescription").value = rule.description;
                        document.getElementById("editSolusi").value = rule.solusi.id;
                        document.getElementById("editSolusiRekomendasi").value = rule.solusi_rekomendasi ? rule
                            .solusi_rekomendasi.code : "";
                        document.getElementById("editDescriptionRekomendasi").value = rule
                            .description_rekomendasi ?? '';
                        if (Array.isArray(rule.category_ids)) {
                            rule.category_ids.forEach(id => {
                                const checkbox = document.getElementById(`edit_category_${id}`);
                                if (checkbox) checkbox.checked = true;
                            });
                        }
                        new bootstrap.Modal(document.getElementById("editRuleModal")).show();
                    }
                };
            });

            document.querySelectorAll(".delete-rule").forEach(btn => {
                btn.onclick = function() {
                    const ruleId = this.getAttribute("data-id");
                    const rule = rules.find(u => u.id == ruleId);
                    if (rule) {
                        document.getElementById("deleteRuleId").value = rule.id;
                        document.getElementById("deleteRuleDescription").textContent = rule.description;
                        new bootstrap.Modal(document.getElementById("deleteRuleModal")).show();
                    }
                };
            });
        }

        // Add Rule
        document.getElementById("addRuleForm").onsubmit = function(e) {
            e.preventDefault();
            const form = this;
            const formData = new FormData(form);
            fetch("{{ route('rule.store') }}", {
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
                    bootstrap.Modal.getInstance(document.getElementById("addRuleModal")).hide();
                    form.reset();
                    fetchRules();
                })
                .catch(async err => {
                    let msg = "Failed to add rule";
                    if (err.json) {
                        const data = await err.json();
                        msg = data?.message || msg;
                    }
                    alert(msg);
                });
        };

        // Edit Rule
        document.getElementById("editRuleForm").onsubmit = function(e) {
            e.preventDefault();
            const ruleId = document.getElementById("editRuleId").value;
            const formData = new FormData(this);
            formData.append("_method", "PUT");
            fetch(`/rule/${ruleId}`, {
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
                    bootstrap.Modal.getInstance(document.getElementById("editRuleModal")).hide();
                    fetchRules();
                })
                .catch(async err => {
                    let msg = "Failed to update rule";
                    if (err.json) {
                        const data = await err.json();
                        msg = data?.message || msg;
                    }
                    alert(msg);
                });
        };

        // Delete Rule
        document.getElementById("confirmDeleteRuleBtn").onclick = function() {
            const ruleId = document.getElementById("deleteRuleId").value;
            const formData = new FormData();
            formData.append("_token", "{{ csrf_token() }}");
            formData.append("_method", "DELETE");
            fetch(`/rule/${ruleId}`, {
                    method: "POST",
                    body: formData
                })
                .then(res => {
                    if (!res.ok) throw res;
                    return res.json();
                })
                .then(() => {
                    bootstrap.Modal.getInstance(document.getElementById("deleteRuleModal")).hide();
                    fetchRules();
                })
                .catch(async err => {
                    let msg = "Failed to delete rule";
                    if (err.json) {
                        const data = await err.json();
                        msg = data?.message || msg;
                    }
                    alert(msg);
                });
        };

        document.getElementById("refreshRulesBtn").onclick = fetchRules;

        // Search
        document.getElementById("ruleSearch").onkeyup = function() {
            const val = this.value.toLowerCase();
            const filtered = rules.filter(u =>
                (u.description && u.description.toLowerCase().includes(val)) ||
                (u.description_rekomendasi && u.description_rekomendasi.toLowerCase().includes(val))
            );
            const tbody = document.querySelector("#ruleTable tbody");
            tbody.innerHTML = "";
            filtered.forEach((rule, idx) => {
                const tr = document.createElement("tr");
                tr.innerHTML = `
                <td>${idx + 1}</td>
                <td>${rule.description}</td>
                <td>${rule.solusi.code}</td>
                <td>${rule.solusi_rekomendasi ? rule.solusi_rekomendasi.code : "-"}</td>
                <td>${rule.description_rekomendasi ?? "-"}</td>
                <td>
                    <button class="btn btn-sm btn-primary edit-rule" data-id="${rule.id}"><i class="bi bi-pencil"></i></button>
                    <button class="btn btn-sm btn-danger delete-rule" data-id="${rule.id}"><i class="bi bi-trash"></i></button>
                </td>
            `;
                tbody.appendChild(tr);
            });
            addRuleActionButtonListeners();
        };

        document.addEventListener("DOMContentLoaded", fetchRules);
    </script>
@endsection
