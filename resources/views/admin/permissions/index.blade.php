@extends('layouts.admin')
@section('title', 'Permissions')
@section('content')

  <x-page.index :showReset="false" :showViewToggle="false" title="Permissions"
    iconSvgPath="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" btn-text="Create New Permission"
    btn-icon-svg-path="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z">

    <div id="TableContainer" class="table-respone overflow-x-auto overflow-y-hidden">
      @include('admin.permissions.partials.table', ['permissions' => $permissions])
    </div>
  </x-page.index>
  @include('admin.permissions.partials.create')
  @include('admin.permissions.partials.edit')
  <x-modal.confirmdelete title="Permissions" />

@endsection
@push('scripts')
  <script src="{{ asset('assets/js/modal.js') }}"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      const backdrop = document.getElementById('modalBackdrop');
      const tableContainer = $('#TableContainer');
      const searchInput = $('#searchInput');
      const perPageSelect = $('#perPageSelect');

      function debounce(func, wait) {
        let timeout;
        return function() {
          const context = this,
            args = arguments;
          clearTimeout(timeout);
          timeout = setTimeout(() => func.apply(context, args), wait);
        };
      }
      searchInput.on('input', debounce(() => searchData(searchInput.val()), 500));

      const openCreateBtn = document.getElementById('openCreateModal');
      if (openCreateBtn) {
        openCreateBtn.addEventListener('click', function() {
          showModal('Modalcreate');
        });
      }

      function handleCreateSubmit(e) {
        e.preventDefault();
        const form = $(this);
        const submitBtn = $('#createSubmitBtn');
        const originalBtnHtml = submitBtn.html();
        if (!this.checkValidity()) {
          $(this).addClass('was-validated');
          return;
        }
        submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i> Saving...');

        $.ajax({
          url: form.attr('action'),
          method: 'POST',
          data: form.serialize(),
          success: function(response) {
            if (response.success) {
              closeModal('Modalcreate');
              ShowTaskMessage('success', response.message);
              refreshContent();
              form.trigger('reset');
              form.removeClass('was-validated');
              form.find('.is-valid, .is-invalid').removeClass('is-valid is-invalid');
            } else {
              ShowTaskMessage('error', response.message || 'Error creating permission');
            }
          },
          error: function(xhr) {
            const errors = xhr.responseJSON?.errors || {};

            if (xhr.status === 422) {
              if (errors.name) {
                $('#name').addClass('border-red-500 is-invalid');
                $('#error-name').text(errors.name[0]);
              }
            } else {
              const errorMsg = xhr.responseJSON?.message ||
                xhr.statusText ||
                'Network error occurred';
              ShowTaskMessage('error', errorMsg);
            }
          },
          complete: function() {
            submitBtn.prop('disabled', false).html(originalBtnHtml);
          }
        });
      }

      function handleEditClick(e) {
        e.preventDefault();
        const editBtn = $(this);
        const originalContent = editBtn.find('.btn-content').html();
        editBtn.find('.btn-content').html(
          '<i class="fas fa-spinner fa-spin"></i><span class="ml-2 textnone">Loading...</span>');
        editBtn.prop('disabled', true);

        const Id = $(this).data('id');

        {{-- The URL is changed to point to the permissions show route --}}
        $.get(`/admin/permissions/${Id}`)
          .done(function(response) {
            if (response.success) {
              {{-- The variable name is changed to response.permission --}}
              $('#edit_name').val(response.permission.name);
              $('#Formedit').attr('action', `permissions/${Id}`);
              $('#Formedit').removeClass('was-validated');
              $('#Formedit').find('.is-valid, .is-invalid').removeClass('is-valid is-invalid');
              showModal('Modaledit');
            } else {
              ShowTaskMessage('error', response.message || 'Failed to load permission data');
            }
          })
          .fail(function(xhr) {
            console.error('Error:', xhr.responseText);
            ShowTaskMessage('error', 'Failed to load permission data');
          })
          .always(function() {
            editBtn.find('.btn-content').html(originalContent);
            editBtn.prop('disabled', false);
          });
      }

      function handleEditSubmit(e) {
        e.preventDefault();
        const form = $(this);
        const submitBtn = $('#saveEditBtn');
        const originalBtnHtml = submitBtn.html();
        if (!this.checkValidity()) {
          $(this).addClass('was-validated');
          return;
        }

        submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i> Saving...');

        $.ajax({
          url: form.attr('action'),
          method: 'POST',
          data: form.serialize() + '&_method=PUT',
          success: function(response) {
            if (response.success) {
              closeModal('Modaledit');
              ShowTaskMessage('success', response.message);
              refreshContent();
              form.removeClass('was-validated');
              form.find('.is-valid, .is-invalid').removeClass('is-valid is-invalid');
            } else {
              ShowTaskMessage('error', response.message || 'Error updating permission');
            }
          },
          error: function(xhr) {
            const errors = xhr.responseJSON?.errors || {};

            if (xhr.status === 422) {
              if (errors.name) {
                $('#edit_name').addClass('border-red-500 is-invalid');
                $('#edit-error-name').text(errors.name[0]);
              }
            } else {
              const errorMsg = xhr.responseJSON?.message ||
                xhr.statusText ||
                'Network error occurred';
              ShowTaskMessage('error', errorMsg);
            }
          },
          complete: function() {
            submitBtn.prop('disabled', false).html(originalBtnHtml);
          }
        });
      }

      function handleDeleteClick(e) {
        e.preventDefault();
        const Id = $(this).data('id');
        {{-- The URL is changed to point to the permissions destroy route --}}
        $('#Formdelete').attr('action', `/admin/permissions/${Id}`);
        showModal('Modaldelete');
      }

      function handleDeleteSubmit(e) {
        e.preventDefault();
        const form = $(this);
        const submitBtn = $('#confirmDeleteBtn');
        const originalBtnHtml = submitBtn.html();

        submitBtn.prop('disabled', true).html(
          '<i class="fas fa-spinner fa-spin"></i><span class="ml-2 textnone">Deleting...</span>');

        $.ajax({
          url: form.attr('action'),
          method: 'POST',
          data: {
            _method: 'DELETE'
          },
          success: function(response) {
            if (response.success) {
              closeModal('Modaldelete');
              ShowTaskMessage('success', response.message);
              refreshContent();
            } else {
              ShowTaskMessage('error', response.message || 'Error deleting permission');
            }
          },
          error: function(xhr) {
            ShowTaskMessage('error', xhr.responseJSON?.message || 'Error deleting permission');
          },
          complete: function() {
            submitBtn.prop('disabled', false).html(originalBtnHtml);
          }
        });
      }

      perPageSelect.off('change').on('change', function() {
        const perPage = $(this).val();
        refreshContent();
      });

      function searchData(searchTerm) {
        const perPage = perPageSelect.val() || '';
        $.ajax({
          {{-- The route is changed to the permissions index route --}}
          url: "{{ route('admin.permissions.index') }}",
          method: 'GET',
          data: {
            search: searchTerm,
            per_page: perPage
          },
          success: function(response) {
            if (response.success) {
              tableContainer.html(response.html.table);
              $('.pagination').html(response.html.pagination);
              attachRowEventHandlers();
            } else {
              ShowTaskMessage('error', 'Failed to load data');
            }
          },
          error: function(xhr) {
            console.error('Search failed:', xhr.responseText);
            ShowTaskMessage('error', 'Failed to load data');
          }
        });
      }

      function refreshContent() {
        const perPage = perPageSelect.val() || '';
        $.ajax({
          {{-- The route is changed to the permissions index route --}}
          url: "{{ route('admin.permissions.index') }}",
          method: 'GET',
          data: {
            per_page: perPage
          },
          success: function(response) {
            if (response.success) {
              tableContainer.html(response.html.table);
              $('.pagination').html(response.html.pagination);
              attachRowEventHandlers();
            } else {
              ShowTaskMessage('error', 'Failed to refresh permission data');
            }
          },
          error: function(xhr) {
            console.error('Refresh failed:', xhr.responseText);
            ShowTaskMessage('error', 'Failed to refresh permission data');
          }
        });
      }

      function attachRowEventHandlers() {
        $('.edit-btn').off('click').on('click', handleEditClick);
        $('.delete-btn').off('click').on('click', handleDeleteClick);
      }

      function initialize() {
        $('#Modalcreate form').off('submit').on('submit', handleCreateSubmit);
        $('#Formedit').off('submit').on('submit', handleEditSubmit);
        $('#Formdelete').off('submit').on('submit', handleDeleteSubmit);
        attachRowEventHandlers();
      }

      initialize();
    });
  </script>
@endpush
