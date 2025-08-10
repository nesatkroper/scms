@extends('layouts.admin')
@section('title', 'Roles')
@section('content')

  <x-page.alert />

  <a href="{{ route('admin.roles.create') }}"
    class="px-4 py-2 cursor-pointer bg-indigo-600 text-white rounded-md hover:bg-indigo-700 flex items-center gap-2 w-48 mb-4">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
      <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
        clip-rule="evenodd" />
    </svg>
    Create New Role
  </a>

  <x-page.index :canCreate="false" :showReset="false" :showViewToggle="false" title="Roles"
    iconSvgPath="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z">

    <div id="TableContainer" class="table-respone overflow-x-auto h-[60vh]">
      <x-table.dynamic-table :headers="[
          'id' => ['label' => 'Id'],
          'name' => ['label' => 'Name'],
          'permissions_count' => ['label' => 'Permissions'],
          'users_count' => ['label' => 'Users'],
      ]" endpoint="roles" :items="$roles"
        empty-message="Create your first roles to get started" :checkbox="false" :actions="['edit', 'delete']" />

      <x-table.pagination :paginator="$roles" />
    </div>
  </x-page.index>

  <x-modal.confirmdelete title="Roles" />

@endsection

@push('scripts')
  <script src="{{ asset('assets/js/modal.js') }}"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {

      function handleDeleteClick(e) {
        e.preventDefault();
        const id = e.currentTarget.dataset.id;
        const form = document.getElementById('Formdelete');
        if (form) {
          form.action = `/admin/roles/${id}`;
        }
        document.getElementById('Modaldelete').classList.remove('hidden');
        document.getElementById('Modaldelete').classList.add('flex');
      }


      function attachRowEventHandlers() {
        const deleteButtons = document.querySelectorAll('.delete-btn');
        deleteButtons.forEach(button => {
          button.addEventListener('click', handleDeleteClick);
        });
      }
      attachRowEventHandlers();
    });
  </script>
@endpush
