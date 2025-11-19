@extends('layouts.admin')
@section('title', 'Users')
@section('content')
  <x-page.index :showReset="true" :showViewToggle="false" title="Users"
    iconSvgPath="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" btn-text="Create New User">

    <form action="{{ route('admin.users.index') }}" method="GET" id="FilterForm" class="space-y-4">
      <div class="flex items-center space-x-4 my-4">

        <label for="roleFilterSelect" class="text-sm font-medium text-gray-700 dark:text-gray-300">Filter by Role:</label>
        <select id="roleFilterSelect" name="role_filter" onchange="this.form.submit()"
          class="px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm dark:bg-gray-700 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
          <option value="">All Roles</option>
          @foreach ($roles as $role)
            <option value="{{ $role->name }}" @selected($role->name == $roleFilter)>
              {{ Str::title($role->name) }}
            </option>
          @endforeach
        </select>
      </div>
    </form>

    <div id="TableContainer" class="table-respone overflow-y-hidden overflow-x-auto">
      <x-table.dynamic-table :headers="[
          'name' => ['label' => 'User Name', 'component' => 'table.cell'],
          'role' => [
              'label' => 'Role',
              'format' => fn($item) => $item->roles->first()?->name ? Str::title($item->roles->first()->name) : 'N/A',
          ],
          'email' => ['label' => 'Email'],
          'phone' => ['label' => 'Phone'],
          'joining_date' => [
              'label' => 'Joining Date',
              'format' => fn($item) => $item->joining_date ? $item->joining_date->format('M d, Y') : 'N/A',
          ],
          'gender' => ['label' => 'Gender'],
      ]" :items="$users" empty-message="Create your first users to get started"
        :checkbox="false" :actions="['edit', 'delete']" />
      <x-table.pagination :paginator="$users" />

    </div>
  </x-page.index>
  @include('admin.users.create')
  @include('admin.users.edit')
  <x-modal.confirmdelete title="User" />
@endsection

@push('scripts')
  <script src="{{ asset('assets/js/modal.js') }}"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const searchInput = document.getElementById('searchInput');
      const resetSearch = document.getElementById('resetSearch');
      const filterForm = document.getElementById('FilterForm');

      const openCreateBtn = document.getElementById('openCreateModal');
      if (openCreateBtn) {
        openCreateBtn.addEventListener('click', function() {
          showModal('Modalcreate');
        });
      }

      function submitSearch() {
        const currentUrl = new URL(filterForm.action);
        currentUrl.searchParams.set('search', searchInput.value);
        currentUrl.searchParams.delete('page');
        window.location.href = currentUrl.toString();
      }

      searchInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
          e.preventDefault();
          submitSearch();
        }
      });

      resetSearch.addEventListener('click', () => {
        searchInput.value = '';
        const currentUrl = new URL(filterForm.action);
        currentUrl.searchParams.delete('search');
        currentUrl.searchParams.delete('page');
        window.location.href = currentUrl.toString();
      });

      function handleEditClick(e) {
        e.preventDefault();
        const Id = this.dataset.id;
        fetchAndPopulateModal(Id);
      }

      function handleDeleteClick(e) {
        e.preventDefault();
        const Id = this.dataset.id;
        const deleteForm = document.getElementById('Formdelete');
        deleteForm.setAttribute('action', `/admin/users/${Id}`);
        showModal('Modaldelete');
      }

      function attachRowEventHandlers() {
        document.querySelectorAll('.edit-btn').forEach(btn => {
          btn.removeEventListener('click', handleEditClick);
          btn.addEventListener('click', handleEditClick);
        });
        document.querySelectorAll('.delete-btn').forEach(btn => {
          btn.removeEventListener('click', handleDeleteClick);
          btn.addEventListener('click', handleDeleteClick);
        });
      }

      function fetchAndPopulateModal(Id) {
        $.get(`/admin/users/${Id}`)
          .done(function(response) {
            if (response.success && response.user) {
              const user = response.user;

              $('#Modaledit input[name="name"]').val(user.name || '');
              $('#Modaledit input[name="phone"]').val(user.phone || '');
              $('#Modaledit input[name="email"]').val(user.email || '');
              $('#Modaledit select[name="gender"]').val(user.gender || '');
              $('#Modaledit input[name="date_of_birth"]').val(user.date_of_birth ? user.date_of_birth.substring(0,
                10) : '');
              $('#Modaledit input[name="address"]').val(user.address || '');

              document.getElementById('Formedit').setAttribute('action', `/admin/users/${Id}`);

              if (user.roles && user.roles.length > 0) {
                const roleName = user.roles[0].name;
                $('#Modaledit select[name="type"]').val(roleName);
                if (document.getElementById('Modaledit').__x) {
                  document.getElementById('Modaledit').__x.data.userRole = roleName;
                }
              }

              showModal('Modaledit');
            } else {
              alert(response.message || 'Failed to load user data: Invalid response');
            }
          })
          .fail(function(xhr) {
            alert(xhr.responseJSON?.message || 'Failed to load user data');
          });
      }

      attachRowEventHandlers();
    });
  </script>
@endpush
