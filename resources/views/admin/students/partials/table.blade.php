<x-table.table :headers="['Student', 'Gender', 'Age', 'Phone', 'Grade Level', 'Blood Group', 'Admission Date']" :checkbox="true">
  @if (count($students) > 0)
    @foreach ($students as $student)
      <x-table.tr>
        <x-table.td class="whitespace-nowrap text-gray-900 dark:text-white">
          <div class="flex items-center">
            @if ($student->photo)
              <img class="detail-btn size-10 rounded-full object-cover cursor-pointer" src="{{ asset($student->photo) }}"
                alt="{{ $student->name }} image" data-id="{{ $student->id }}">
            @else
              <div data-id="{{ $student->id }}"
                class="detail-btn w-10 h-10 rounded-full flex items-center justify-center bg-indigo-600 text-white font-bold cursor-default select-none">
                {{ strtoupper(substr($student->name, 0, 1)) }}
              </div>
            @endif
            <div class="pl-3">
              <div class="text-base font-semibold">
                {{ $student->name }}
              </div>
              <div class="font-normal text-gray-500 truncate w-[85%]">
                {{ $student->email }}
              </div>
            </div>
          </div>
        </x-table.td>
        <x-table.td>{{ $student->gender ?? 'N/A' }}</x-table.td>
        <x-table.td>{{ $student->age ?? 'N/A' }}</x-table.td>
        <x-table.td>{{ $student->phone ?? 'N/A' }}</x-table.td>
        <x-table.td>{{ $student->gradeLevel?->name ?? 'N/A' }}</x-table.td>
        <x-table.td>{{ $student->blood_group ?? 'N/A' }}</x-table.td>
        <x-table.td>
          {{ $student->admission_date->format('Y-m-d') }}
        </x-table.td>
        {{-- <x-table.td>
                    {{ $student->created_at->format('Y-m-d') }}
                </x-table.td> --}}
        <x-table.td class="text-right">
          <x-table.action :id="$student->id" />
        </x-table.td>
        <x-table.td class="px-2 py-2">
          <x-fields.checkbox id="" name="selected_ids[]" class="row-checkbox" value="{{ $student->id }}" />
        </x-table.td>
      </x-table.tr>
    @endforeach
  @else
    <tr>
      <td colspan="12" class="p-4 text-center">
        <x-not-found-data title="students" />
      </td>
    </tr>
  @endif
</x-table.table>
<x-bulkactions />
