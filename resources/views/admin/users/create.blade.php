<x-modal.modal id="Modalcreate" title="Create New User" class="rounded-xl w-full max-w-4xl"
  svgPath="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z">

  <form action="{{ route('admin.users.store') }}" method="POST" class="needs-validation overflow-y-auto max-h-[80vh]"
    enctype="multipart/form-data" novalidate x-data="{ userRole: '{{ old('type') }}' }">
    @csrf

    <div class="space-y-6">
      <div class="relative bg-gradient-to-r from-indigo-500 to-purple-600 h-28 flex items-end justify-center">
        <div class="absolute -bottom-12">
          <x-photos.upload2 name="avatar" size="xl" />
        </div>
      </div>

      <div class="pt-16 pb-4 px-4 border-b">
        <h3 class="text-lg font-semibold text-gray-700 mb-4">👤 Basic Information</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-2 gap-x-4">
          <x-fields.input label="Name" name="name" placeholder="Enter name" :required="true" />
          <x-fields.input type="email" label="Email" name="email" placeholder="Enter email" :required="true" />
          <x-fields.input type="password" label="Password" name="password" placeholder="Enter password"
            :required="true" />
          <x-fields.input type="password" label="Confirm Password" name="password_confirmation"
            placeholder="Confirm password" :required="true" />
          <x-fields.select name="type" label="User Role" :options="$roles" :value="old('type')" required="true"
            searchable="true" x-model="userRole" />
          <x-fields.input type="tel" label="Phone number" name="phone" placeholder="Enter phone number" />
          <x-fields.input label="Address" name="address" placeholder="Enter address" />
          <x-fields.input type="date" label="Date of Birth" name="date_of_birth" placeholder="Enter Date of Birth" />
          <x-fields.select name="gender" label="Gender" :options="['male' => 'Male', 'female' => 'Female', 'other' => 'Other']" :value="old('gender', 'male')" />
          <x-fields.input label="Nationality" name="nationality" placeholder="Enter nationality" />
          <x-fields.input label="Religion" name="religion" placeholder="Enter religion" />
          <x-fields.input label="Blood Group" name="blood_group" placeholder="e.g., A+" />
        </div>
      </div>

      <div class="px-4 border-b" x-show="['teacher', 'admin', 'staff'].includes(userRole)">
        <h3 class="text-lg font-semibold text-gray-700 mb-4">🧑‍💼 Employment/Academic Details</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-2 gap-x-4">
          <x-fields.select name="department_id" label="Department" :options="$departments ?? []" :value="old('department_id')"
            placeholder="Select Department" searchable="true" />
          <x-fields.input type="date" label="Joining Date" name="joining_date" placeholder="Enter Joining Date" />
          <x-fields.input label="Qualification" name="qualification" placeholder="e.g., Master of Science" />
          <x-fields.input label="Experience (Years)" name="experience" placeholder="e.g., 5" type="number"
            min="0" step="0.5" />
          <x-fields.input label="Specialization" name="specialization" placeholder="e.g., Computer Science" />
          <x-fields.input type="number" label="Salary" name="salary" placeholder="Enter salary amount" min="0"
            step="0.01" />
          <x-fields.input type="file" label="CV/Resume" name="cv" accept=".pdf,.doc,.docx" />
        </div>
      </div>

      <div class="px-4 border-b" x-show="userRole === 'student'">
        <h3 class="text-lg font-semibold text-gray-700 mb-4">🎓 Student Details</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-2 gap-x-4">
          <x-fields.input type="date" label="Admission Date" name="admission_date"
            placeholder="Enter Admission Date" />
          <x-fields.input label="Parent/Guardian Occupation" name="occupation" placeholder="Enter Occupation" />
          <x-fields.input label="Parent/Guardian Company" name="company" placeholder="Enter Company Name" />
        </div>
      </div>
    </div>

    <x-modal.footer-actions :create="true" />
  </form>
</x-modal.modal>
