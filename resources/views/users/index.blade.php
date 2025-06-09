@extends('layouts.app')
@section('breadcrumbs')
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">User Management</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active">Users</li>
                </ol>
            </nav>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
            <i class="bi bi-person-plus me-2"></i>Add New User
        </button>
    </div>
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">User List</h6>
                <button id="refreshUsersBtn" class="btn btn-sm btn-outline-primary ms-2" title="Refresh Users">
                    <i class="bi bi-arrow-clockwise"></i>
                </button>
            </div>
            <div class="search-container">
                <input type="text" id="userSearch" class="form-control" placeholder="Search users...">
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="userTable">
                    <thead>
                        <tr>
                            <th width="50">#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
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

    <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="addUserForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label required-field">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label required-field">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label required-field">Role</label>
                            <select class="form-select" id="role" name="role" required>
                                <option value="">Select Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role }}">{{ ucfirst($role) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label required-field">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label required-field">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="saveUserBtn">Save User</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editUserForm">
                <input type="hidden" id="editUserId" name="id">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editName" class="form-label required-field">Full Name</label>
                            <input type="text" class="form-control" id="editName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="editEmail" class="form-label required-field">Email</label>
                            <input type="email" class="form-control" id="editEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="editRole" class="form-label required-field">Role</label>
                            <select class="form-select" id="editRole" name="role" required>
                                <option value="">Select Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role }}">{{ ucfirst($role) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editPassword" class="form-label">Password (leave blank to keep current)</label>
                            <input type="password" class="form-control" id="editPassword" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="editPasswordConfirmation" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="editPasswordConfirmation" name="password_confirmation">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="updateUserBtn">Update User</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete User Modal (tidak berubah) -->
    <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteUserModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="deleteUserId">
                    <p>Are you sure you want to delete the user <strong id="deleteUserName"></strong>?</p>
                    <p class="text-danger"><i class="bi bi-exclamation-triangle-fill me-2"></i>This action cannot be
                        undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete User</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    let usersTable;
    let users = [];

    function fetchUsers() {
        document.querySelector("#userTable tbody").innerHTML = `
            <tr>
                <td colspan="6" class="text-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2">Loading users data...</p>
                </td>
            </tr>
        `;

        fetch("{{ route('users.getDataList') }}")
            .then(res => res.json())
            .then(data => {
                users = data.data || data;
                initializeDataTable();
            });
    }

    function initializeDataTable() {
        // Destroy DataTable if exists (DataTables.js is jQuery-based, so skip destroy)
        // We'll just re-render the table body

        const tbody = document.querySelector("#userTable tbody");
        tbody.innerHTML = "";

        users.forEach((user, idx) => {
            const tr = document.createElement("tr");
            tr.innerHTML = `
                <td>${idx + 1}</td>
                <td>${user.name}</td>
                <td>${user.email}</td>
                <td>${user.role}</td>
                <td>${new Date(user.created_at).toLocaleString('id-ID', { dateStyle: 'medium', timeStyle: 'short' })}</td>
                <td>
                    <button class="btn btn-sm btn-primary edit-user" data-id="${user.id}"><i class="bi bi-pencil"></i></button>
                    <button class="btn btn-sm btn-danger delete-user" data-id="${user.id}"><i class="bi bi-trash"></i></button>
                </td>
            `;
            tbody.appendChild(tr);
        });

        addActionButtonListeners();
    }

    function addActionButtonListeners() {
        document.querySelectorAll(".edit-user").forEach(btn => {
            btn.onclick = function() {
                const userId = this.getAttribute("data-id");
                const user = users.find(u => u.id == userId);
                if (user) {
                    document.getElementById("editUserId").value = user.id;
                    document.getElementById("editName").value = user.name;
                    document.getElementById("editEmail").value = user.email;
                    document.getElementById("editRole").value = user.role;
                    document.getElementById("editPassword").value = '';
                    document.getElementById("editPasswordConfirmation").value = '';
                    new bootstrap.Modal(document.getElementById("editUserModal")).show();
                }
            };
        });

        document.querySelectorAll(".delete-user").forEach(btn => {
            btn.onclick = function() {
                const userId = this.getAttribute("data-id");
                const user = users.find(u => u.id == userId);
                if (user) {
                    document.getElementById("deleteUserId").value = user.id;
                    document.getElementById("deleteUserName").textContent = user.name;
                    new bootstrap.Modal(document.getElementById("deleteUserModal")).show();
                }
            };
        });
    }

    // Add User
    document.getElementById("addUserForm").onsubmit = function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        fetch("{{ route('users.store') }}", {
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
            bootstrap.Modal.getInstance(document.getElementById("addUserModal")).hide();
            fetchUsers();
        })
        .catch(async err => {
            let msg = "Failed to add user";
            if (err.json) {
                const data = await err.json();
                msg = data?.message || msg;
            }
            alert(msg);
        });
    };

    // Edit User
    document.getElementById("editUserForm").onsubmit = function(e) {
        e.preventDefault();
        const userId = document.getElementById("editUserId").value;
        const formData = new FormData(this);
        formData.append("_method", "PUT");
        fetch(`/users/${userId}`, {
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
            bootstrap.Modal.getInstance(document.getElementById("editUserModal")).hide();
            fetchUsers();
        })
        .catch(async err => {
            let msg = "Failed to update user";
            if (err.json) {
                const data = await err.json();
                msg = data?.message || msg;
            }
            alert(msg);
        });
    };

    // Delete User
    document.getElementById("confirmDeleteBtn").onclick = function() {
        const userId = document.getElementById("deleteUserId").value;
        const formData = new FormData();
        formData.append("_token", "{{ csrf_token() }}");
        formData.append("_method", "DELETE");
        fetch(`/users/${userId}`, {
            method: "POST",
            body: formData
        })
        .then(res => {
            if (!res.ok) throw res;
            return res.json();
        })
        .then(() => {
            bootstrap.Modal.getInstance(document.getElementById("deleteUserModal")).hide();
            fetchUsers();
        })
        .catch(async err => {
            let msg = "Failed to delete user";
            if (err.json) {
                const data = await err.json();
                msg = data?.message || msg;
            }
            alert(msg);
        });
    };

    document.getElementById("refreshUsersBtn").onclick = fetchUsers;

    // Search
    document.getElementById("userSearch").onkeyup = function() {
        const val = this.value.toLowerCase();
        const filtered = users.filter(u =>
            u.name.toLowerCase().includes(val) ||
            u.email.toLowerCase().includes(val) ||
            u.role.toLowerCase().includes(val)
        );
        const tbody = document.querySelector("#userTable tbody");
        tbody.innerHTML = "";
        filtered.forEach((user, idx) => {
            const tr = document.createElement("tr");
            tr.innerHTML = `
                <td>${idx + 1}</td>
                <td>${user.name}</td>
                <td>${user.email}</td>
                <td>${user.role}</td>
                <td>${new Date(user.created_at).toLocaleString('id-ID', { dateStyle: 'medium', timeStyle: 'short' })}</td>
                <td>
                    <button class="btn btn-sm btn-primary edit-user" data-id="${user.id}"><i class="bi bi-pencil"></i></button>
                    <button class="btn btn-sm btn-danger delete-user" data-id="${user.id}"><i class="bi bi-trash"></i></button>
                </td>
            `;
            tbody.appendChild(tr);
        });
        addActionButtonListeners();
    };

    document.addEventListener("DOMContentLoaded", fetchUsers);
</script>
@endsection
