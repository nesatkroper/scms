<x-modal.modal id="Modaledit" title="Edit User Profile" svgClass="rounded-md" fill="none" stroke="currentColor"
  viewBox="0 0 24 24" class="rounded-xl w-full max-w-4xl"
  svgPath="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
  <form id="Formedit" method="POST" class="overflow-y-auto max-h-[80vh] needs-validation" novalidate
    enctype="multipart/form-data" x-data="{ userRole: '' }">
    @csrf
    @method('PUT')

    <div class="space-y-6">
      <div class="relative bg-gradient-to-r from-indigo-500 to-purple-600 h-28 flex items-end justify-center">
        <x-photos.upload :edit="true" name="avatar" />
      </div>

      <div class="pt-16 pb-4 px-4 border-b">
        <h3 class="text-lg font-semibold text-gray-700 mb-4">👤 Basic Information</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-2 gap-x-4">
          <x-fields.input :edit="true" label="Name" name="name" placeholder="Enter name" :required="true" />

          <x-fields.input :edit="true" type="email" label="Email" name="email"
            placeholder="Enter email address" :required="true" />

          <div class="mb-2">
            <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              User Role <span class="text-red-500">*</span>
            </label>
            {{-- The x-model="userRole" will update the Alpine state --}}
            <select id="role" name="type" x-model="userRole"
              class="form-control w-full px-3 py-2 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('type') border-red-500 @else border-gray-400 @enderror"
              required>
              <option value="">Select user Type</option>
              @foreach ($roles as $role)
                <option value="{{ $role->name }}">
                  {{ ucfirst($role->name) }}
                </option>
              @endforeach
            </select>
            <p id="edit-error-type" class="mt-1 text-sm text-red-600 dark:text-red-500"></p>
            <div class="invalid-feedback text-sm text-red-600 dark:text-red-500 mt-1">
              field user role is required
            </div>
          </div>

          <x-fields.input :edit="true" type="password" label="New Password" name="password"
            placeholder="Leave blank to keep current password" :required="false" />
          <x-fields.input :edit="true" type="password" label="Confirm new password" name="password_confirmation"
            placeholder="Confirm new password" :required="false" />

          <x-fields.input :edit="true" type="tel" label="Phone number" name="phone"
            placeholder="Enter phone number" />
          <x-fields.input :edit="true" label="Address" name="address" placeholder="Enter address" />
          <x-fields.input :edit="true" type="date" label="Date of Birth" name="date_of_birth" />
          <x-fields.select :edit="true" name="gender" label="Gender" :options="['male' => 'Male', 'female' => 'Female', 'other' => 'Other']" :value="old('gender', 'male')" />

          <x-fields.input :edit="true" label="Nationality" name="nationality" placeholder="Enter nationality" />
          <x-fields.input :edit="true" label="Religion" name="religion" placeholder="Enter religion" />
          <x-fields.input :edit="true" label="Blood Group" name="blood_group" placeholder="e.g., A+" />
        </div>
      </div>

      <div class="px-4 border-b" x-show="['teacher', 'admin', 'staff'].includes(userRole)">
        <h3 class="text-lg font-semibold text-gray-700 mb-4">🧑‍💼 Employment/Academic Details</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-2 gap-x-4">
          <x-fields.select :edit="true" name="department_id" label="Department" :options="$departments ?? []"
            placeholder="Select Department" searchable="true" />
          <x-fields.input :edit="true" type="date" label="Joining Date" name="joining_date"
            placeholder="Enter Joining Date" />
          <x-fields.input :edit="true" label="Qualification" name="qualification"
            placeholder="e.g., Master of Science" />
          <x-fields.input :edit="true" label="Experience (Years)" name="experience" placeholder="e.g., 5"
            type="number" min="0" step="0.5" />
          <x-fields.input :edit="true" label="Specialization" name="specialization"
            placeholder="e.g., Computer Science" />
          <x-fields.input :edit="true" type="number" label="Salary" name="salary"
            placeholder="Enter salary amount" min="0" step="0.01" />
          <x-fields.input :edit="true" type="file" label="CV/Resume" name="cv" accept=".pdf,.doc,.docx"
            :required="false" />
        </div>
      </div>

      <div class="px-4 border-b" x-show="userRole === 'student'">
        <h3 class="text-lg font-semibold text-gray-700 mb-4">🎓 Student Details</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-2 gap-x-4">
          <x-fields.input :edit="true" type="date" label="Admission Date" name="admission_date"
            placeholder="Enter Admission Date" />
          <x-fields.input :edit="true" label="Parent/Guardian Occupation" name="occupation"
            placeholder="Enter Occupation" />
          <x-fields.input :edit="true" label="Parent/Guardian Company" name="company"
            placeholder="Enter Company Name" />
        </div>
      </div>
    </div>

    <x-modal.footer-actions :edit="true" />
  </form>
</x-modal.modal>
