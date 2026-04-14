@extends('dashboard.base')

@section('content')
    <div class="max-w-7xl mx-auto pb-20 px-4">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12 border-b border-slate-100 pb-8">
            <div>
                <h1 class="text-3xl font-light text-slate-900 tracking-tight">User <span
                        class="font-semibold">Directory</span></h1>
                <p class="text-slate-500 text-sm mt-1">Manage platform access, roles, and account permissions.</p>
            </div>
        </div>

        <div
            class="bg-white border border-slate-100 shadow-[0_20px_60px_-15px_rgba(0,0,0,0.03)] overflow-hidden rounded-[2.5rem]">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="px-10 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">User
                                Details</th>
                            <th class="px-10 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Contact
                                Info</th>
                            <th class="px-10 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Role</th>
                            <th
                                class="px-10 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody id="userTableBody" class="divide-y divide-slate-50">
                        <tr>
                            <td colspan="4" class="text-center py-10 text-slate-400">
                                Loading users...
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            fetchUsers();

            function fetchUsers() {
                fetch("{{ route('users.json') }}")
                    .then(res => res.json())
                    .then(response => {

                        let users = response.data;
                        let html = '';

                        if (users.length === 0) {
                            html = `<tr>
                        <td colspan="4" class="text-center py-10 text-slate-400">
                            No users found
                        </td>
                    </tr>`;
                        } else {

                            users.forEach(user => {

                                let initials = user.name.substring(0, 2).toUpperCase();

                                let avatarClass = user.role === 'company' ?
                                    'bg-indigo-50 text-indigo-600 border border-indigo-100' :
                                    'bg-emerald-50 text-emerald-600 border border-emerald-100';

                                let badge = user.role === 'company' ?
                                    `<span class="px-3 py-1 bg-indigo-50 text-indigo-600 text-[9px] font-black rounded-full uppercase tracking-widest border border-indigo-100">
                Company
           </span>` :
                                    `<span class="px-3 py-1 bg-emerald-50 text-emerald-600 text-[9px] font-black rounded-full uppercase tracking-widest border border-emerald-100">
                Jobseeker
           </span>`;

                                html += `
    <tr class="group hover:bg-slate-50/50 transition-all">

        <!-- USER -->
        <td class="px-10 py-6">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-full ${avatarClass} 
                    flex items-center justify-center font-bold text-xs uppercase shadow-sm">
                    ${initials}
                </div>

                <div>
                    <p class="text-sm font-bold text-slate-900">${user.name}</p>
                    <p class="text-[11px] text-slate-400 font-medium tracking-tight">
                        ${user.email}
                    </p>
                </div>
            </div>
        </td>

        <!-- PHONE -->
        <td class="px-10 py-6">
            <p class="text-xs font-bold text-slate-700 tracking-wide">
                ${user.phone ?? 'N/A'}
            </p>
        </td>

        <!-- ROLE -->
        <td class="px-10 py-6">
            ${badge}
        </td>

        <!-- ACTIONS -->
        <td class="px-10 py-6">
            <div class="flex justify-center items-center gap-3">

                <!-- TOGGLE -->
                <label class="relative inline-flex items-center cursor-pointer" title="Toggle Active Status">
                    <input type="checkbox" 
                        class="sr-only peer toggle-status"
                        data-id="${user.id}"
                        ${user.is_active ? 'checked' : ''}>

                    <div class="w-9 h-5 bg-slate-200 rounded-full 
                        peer-checked:bg-emerald-500 
                        relative after:content-[''] after:absolute after:top-[2px] after:left-[2px] 
                        after:bg-white after:border after:rounded-full after:h-4 after:w-4 
                        after:transition-all peer-checked:after:translate-x-full shadow-inner">
                    </div>
                </label>

                <!-- EDIT -->
                <button class="w-9 h-9 flex items-center justify-center rounded-xl bg-slate-50 text-slate-400 hover:text-indigo-600 hover:bg-white border border-transparent hover:border-slate-100 transition-all hover:shadow-sm">
                    <i class="fas fa-edit text-[10px]"></i>
                </button>

                <!-- VIEW -->
<button 
    onclick="viewUser(${user.id})"
    class="w-9 h-9 flex items-center justify-center rounded-xl bg-slate-50 text-slate-400 hover:text-blue-600 hover:bg-white border border-transparent hover:border-slate-100 transition-all hover:shadow-sm"
    title="View User"
>
    <i class="fas fa-eye text-[10px]"></i>
</button>

                <!-- DELETE -->
                <button class="w-9 h-9 flex items-center justify-center rounded-xl bg-slate-50 text-slate-400 hover:text-red-500 hover:bg-white border border-transparent hover:border-slate-100 transition-all hover:shadow-sm">
                    <i class="fas fa-trash-alt text-[10px]"></i>
                </button>

            </div>
        </td>

    </tr>`;
                            });
                        }

                        document.getElementById("userTableBody").innerHTML = html;

                        bindToggle();

                    })
                    .catch(err => {
                        console.error(err);
                        document.getElementById("userTableBody").innerHTML = `<tr>
                            <td colspan="4" class="text-center py-10 text-red-500">
                                Failed to load users. Please refresh.
                            </td>
                        </tr>`;
                    });
            }

            function bindToggle() {
                document.querySelectorAll(".toggle-status").forEach(toggle => {
                    toggle.addEventListener("change", function() {

                        let id = this.dataset.id;
                        let isChecked = this.checked;

                        fetch(`/users/toggle-status/${id}`, {
                                method: "POST",
                                headers: {
                                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                    "Accept": "application/json"
                                }
                            })
                            .then(res => res.json())
                            .then(response => {

                                showToast(response.message || 'Status updated!', 'success');

                            })
                            .catch(() => {
                                showToast('Something went wrong!', 'error');

                                // revert toggle if failed
                                this.checked = !isChecked;
                            });

                    });
                });
            }

        });


        function showToast(message, type = 'success') {
            // Remove existing toasts to prevent stacking clutter (optional)
            const existing = document.querySelector('.luxury-toast');
            if (existing) existing.remove();

            const toast = document.createElement('div');

            // Configuration for luxury colors
            const config = {
                success: {
                    icon: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>`,
                    colorClass: 'text-emerald-600 border-emerald-500',
                    label: 'Success'
                },
                error: {
                    icon: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>`,
                    colorClass: 'text-rose-600 border-rose-500',
                    label: 'Attention'
                }
            };

            const current = config[type] || config.success;

            toast.className = `
        fixed top-6 right-6 z-[9999] flex items-center gap-4 px-6 py-4 
        rounded-2xl luxury-toast animate-luxury min-w-[320px] overflow-hidden
        border-l-4 ${current.colorClass}
    `;

            toast.innerHTML = `
        <div class="flex-shrink-0 w-10 h-10 flex items-center justify-center rounded-xl bg-white/50 shadow-sm ${current.colorClass}">
            ${current.icon}
        </div>

        <div class="flex flex-col">
            <span class="text-[10px] uppercase tracking-[0.2em] font-black opacity-50 mb-0.5">${current.label}</span>
            <span class="text-sm font-semibold text-slate-800 tracking-tight">${message}</span>
        </div>

        <div class="toast-progress ${current.colorClass}"></div>
    `;

            document.body.appendChild(toast);

            // Smooth Exit Sequence
            setTimeout(() => {
                toast.style.transition = 'all 0.5s cubic-bezier(0.22, 1, 0.36, 1)';
                toast.style.opacity = '0';
                toast.style.transform = 'translateY(-20px) scale(0.9)';

                setTimeout(() => toast.remove(), 500);
            }, 3000);
        }




        function viewUser(id) {
            window.location.href = `/users/${id}`;
        }
    </script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {

            document.querySelectorAll(".toggle-status").forEach(function(toggle) {
                toggle.addEventListener("change", function() {

                    let userId = this.dataset.id;

                    fetch(`/users/toggle-status/${userId}`, {
                            method: "POST",
                            headers: {
                                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                "Content-Type": "application/json"
                            }
                        })
                        .then(res => res.json())
                        .then(data => {
                            console.log(data.message);
                        })
                        .catch(err => console.error(err));

                });
            });

        });
    </script>
@endpush
