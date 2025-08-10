@extends('layouts.admin')
@section('title', 'Roles')
@section('content')
  <x-page.index :showReset="false" :showViewToggle="false" title="Roles"
    iconSvgPath="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" btn-text="Create New User"
    btn-icon-svg-path="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z">
    <div id="TableContainer" class="table-respone overflow-x-auto h-[60vh]">
      @include('admin.roles.partials.table', ['roles' => $roles])
    </div>
  </x-page.index>
  @include('admin.roles.partials.create')
  @include('admin.roles.partials.edit')
  <x-modal.confirmdelete title="Roles" />

@endsection
@push('scripts')
  <script src="{{ asset('assets/js/modal.js') }}"></script>
  <script>
    // This script is for the roles.index Blade file
    document.addEventListener('DOMContentLoaded', function() {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      const tableContainer = $('#TableContainer');
      const searchInput = $('#searchInput');
      const perPageSelect = $('#perPageSelect');

      function debounce(func, wait) {
        let timeout;
        return function(...args) {
          const context = this;
          const later = () => {
            timeout = null;
            func.apply(context, args);
          };
          clearTimeout(timeout);
          timeout = setTimeout(later, wait);
        };
      }
      searchInput.on('input', debounce(() => searchData(searchInput.val()), 500));

      const openCreateBtn = document.getElementById('openCreateModal');
      if (openCreateBtn) {
        openCreateBtn.addEventListener('click', function() {
          // Fetch all permissions and populate the create modal
          fetchPermissions('permissions-container-create');
          showModal('Modalcreate');
        });
      }

      function fetchPermissions(containerId, rolePermissions = []) {
        $.get('/admin/permissions-list')
          .done(function(response) {
            const container = $(`#${containerId}`);
            container.empty();
            if (response.success && response.permissions.length > 0) {
              response.permissions.forEach(permission => {
                const isChecked = rolePermissions.includes(permission.id) ? 'checked' : '';
                container.append(`
                            <div class="flex items-center space-x-2">
                                <input id="permission-${permission.id}-${containerId}" name="permissions[]" type="checkbox"
                                    value="${permission.id}" ${isChecked}
                                    class="w-4 h-4 text-indigo-600 bg-gray-100 border-gray-300 rounded focus:ring-indigo-500">
                                <label for="permission-${permission.id}-${containerId}"
                                    class="text-sm font-medium text-gray-900 dark:text-gray-300">
                                    ${permission.name}
                                </label>
                            </div>
                        `);
              });
            } else {
              container.html('<p class="text-sm text-gray-500">No permissions found.</p>');
            }
          })
          .fail(function(xhr) {
            console.error('Error fetching permissions:', xhr.responseText);
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
              ShowTaskMessage('success', response.message);
              // Check for a redirect URL and perform the redirection
              if (response.redirect_url) {
                window.location.href = response.redirect_url;
              }
            } else {
              ShowTaskMessage('error', response.message || 'Error creating role');
            }
          },
          error: function(xhr) {
            const errors = xhr.responseJSON?.errors || {};
            if (xhr.status === 422) {
              if (errors.name) {
                $('#name').addClass('border-red-500 is-invalid');
                $('#error-name').text(errors.name[0]);
              }
              if (errors.permissions) {
                $('#permissions-container-create').addClass('border-red-500');
                $('#create-error-permissions').text(errors.permissions[0]);
              }
            } else {
              const errorMsg = xhr.responseJSON?.message || xhr.statusText || 'Network error occurred';
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
        const Id = $(this).data('id');
        const originalContent = editBtn.find('.btn-content').html();
        editBtn.find('.btn-content').html(
          '<i class="fas fa-spinner fa-spin"></i><span class="ml-2 textnone">Loading...</span>');
        editBtn.prop('disabled', true);

        $.get(`/admin/roles/${Id}`)
          .done(function(response) {
            if (response.success) {
              $('#edit_name').val(response.role.name);
              $('#Formedit').attr('action', `/admin/roles/${Id}`);
              $('#Formedit').removeClass('was-validated');
              $('#Formedit').find('.is-valid, .is-invalid').removeClass('is-valid is-invalid');

              const rolePermissionIds = response.role.permissions.map(p => p.id);
              fetchPermissions('permissions-container-edit', rolePermissionIds);

              showModal('Modaledit');
            } else {
              ShowTaskMessage('error', response.message || 'Failed to load role data');
            }
          })
          .fail(function(xhr) {
            console.error('Error:', xhr.responseText);
            ShowTaskMessage('error', 'Failed to load role data');
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
              ShowTaskMessage('success', response.message);
              if (response.redirect_url) {
                window.location.href = response.redirect_url;
              }
            } else {
              ShowTaskMessage('error', response.message || 'Error updating role');
            }
          },
          error: function(xhr) {
            const errors = xhr.responseJSON?.errors || {};
            if (xhr.status === 422) {
              if (errors.name) {
                $('#edit_name').addClass('border-red-500 is-invalid');
                $('#edit-error-name').text(errors.name[0]);
              }
              if (errors.permissions) {
                $('#permissions-container-edit').addClass('border-red-500');
                $('#edit-error-permissions').text(errors.permissions[0]);
              }
            } else {
              const errorMsg = xhr.responseJSON?.message || xhr.statusText || 'Network error occurred';
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
        $('#Formdelete').attr('action', `/admin/roles/${Id}`);
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
              ShowTaskMessage('error', response.message || 'Error deleting role');
            }
          },
          error: function(xhr) {
            ShowTaskMessage('error', xhr.responseJSON?.message || 'Error deleting role');
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
          url: "{{ route('admin.roles.index') }}",
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
          url: "{{ route('admin.roles.index') }}",
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
              ShowTaskMessage('error', 'Failed to refresh role data');
            }
          },
          error: function(xhr) {
            console.error('Refresh failed:', xhr.responseText);
            ShowTaskMessage('error', 'Failed to refresh role data');
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
  {{-- <script>
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
        // Check validity before submitting
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
              // Reset validation state
              form.removeClass('was-validated');
              form.find('.is-valid, .is-invalid').removeClass('is-valid is-invalid');
            } else {
              ShowTaskMessage('error', response.message || 'Error creating role');
            }
          },
          error: function(xhr) {
            const errors = xhr.responseJSON?.errors || {};

            if (xhr.status === 422) {
              // Name field specific handling
              if (errors.name) {
                $('#name').addClass('border-red-500 is-invalid');
                $('#error-name').text(errors.name[0]);
              }
              // Add similar blocks for other fields if needed
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

        $.get(`/admin/roles/${Id}`) // Changed URL to roles
          .done(function(response) {
            if (response.success) {
              $('#edit_name').val(response.role.name); // Changed to response.role
              $('#Formedit').attr('action', `roles/${Id}`); // Changed action URL

              $('#Formedit').removeClass('was-validated');
              $('#Formedit').find('.is-valid, .is-invalid').removeClass('is-valid is-invalid');
              showModal('Modaledit');
            } else {
              ShowTaskMessage('error', response.message ||
                'Failed to load role data'); // Changed message
            }
          })
          .fail(function(xhr) {
            console.error('Error:', xhr.responseText);
            ShowTaskMessage('error', 'Failed to load role data'); // Changed message
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
        // Check validity before submitting
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
              refreshContent(); // Changed to refreshContent
              form.removeClass('was-validated');
              form.find('.is-valid, .is-invalid').removeClass('is-valid is-invalid');
            } else {
              ShowTaskMessage('error', response.message ||
                'Error updating role'); // Changed message
            }
          },
          error: function(xhr) {
            const errors = xhr.responseJSON?.errors || {};

            if (xhr.status === 422) {
              // Name field specific handling
              if (errors.name) {
                $('#edit_name').addClass('border-red-500 is-invalid');
                $('#edit-error-name').text(errors.name[0]);
              }
              // Add similar blocks for other fields if needed
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
        $('#Formdelete').attr('action', `/admin/roles/${Id}`); // Changed URL
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
              refreshContent(); // Changed to refreshContent
            } else {
              ShowTaskMessage('error', response.message ||
                'Error deleting role'); // Changed message
            }
          },
          error: function(xhr) {
            ShowTaskMessage('error', xhr.responseJSON?.message ||
              'Error deleting role'); // Changed message
          },
          complete: function() {
            submitBtn.prop('disabled', false).html(originalBtnHtml);
          }
        });
      }

      // Handle per page selection change
      perPageSelect.off('change').on('change', function() {
        const perPage = $(this).val();
        refreshContent();
      });
      // Search and Pagination
      function searchData(searchTerm) {
        const perPage = perPageSelect.val() || '';
        $.ajax({
          url: "{{ route('admin.roles.index') }}",
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
          url: "{{ route('admin.roles.index') }}", // Changed route
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
              ShowTaskMessage('error', 'Failed to refresh role data'); // Changed message
            }
          },
          error: function(xhr) {
            console.error('Refresh failed:', xhr.responseText);
            ShowTaskMessage('error', 'Failed to refresh role data'); // Changed message
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
  </script> --}}
@endpush
