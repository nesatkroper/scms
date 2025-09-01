<x-modal.modal id="Modaldetail" title="Student Profile" class="rounded-xl w-full max-w-2xl"
    svgPath="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z">
    <!-- Content -->
    <div class="overflow-y-auto max-h-[80vh]">
        <!-- Profile Header -->
        <div class="relative bg-gradient-to-r from-indigo-500 to-purple-600 h-28 flex items-end justify-center">
            <!-- Circular Avatar -->
            <div class="absolute -bottom-12">
                <div
                    class="size-35 rounded-full border-4 border-white dark:border-slate-800 bg-white dark:bg-slate-700 overflow-hidden shadow-lg">
                    <img id="detail_photo" src="" alt="Student Photo" class="w-full h-full object-cover">
                    <div id="detail_initials"
                        class="w-full h-full flex items-center justify-center bg-indigo-100 dark:bg-slate-600 hidden">
                        <span class="text-3xl font-bold text-indigo-600 dark:text-indigo-300"></span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Profile Body -->
        <div class="pt-16 pb-5 px-5">
            <!-- Name -->
            <div class="text-center mb-4">
                <h3 id="detail_name" class="text-xl font-bold text-gray-800 dark:text-white"></h3>
                <div class="flex justify-center items-center">
                    <x-info.item id="detail_nationality" label="Nationality" color="text-blue-800"
                        icon="ri-flag-line" />
                </div>
            </div>
            <!-- Stats -->
            <div class="grid grid-cols-4 gap-4 text-center border-y border-gray-100 dark:border-slate-700 py-3 mb-4">
                <div>
                    <p class="text-gray-500 dark:text-gray-400 text-xs">Date of Birth</p>
                    <p class="font-bold text-gray-700 dark:text-gray-200 text-sm" id="detail_dob"></p>
                </div>
                <div>
                    <p class="text-gray-500 dark:text-gray-400 text-xs">Age</p>
                    <p class="font-bold text-gray-700 dark:text-gray-200 text-sm"><span id="detail_age"></span> yrs</p>
                </div>
                <div>
                    <p class="text-gray-500 dark:text-gray-400 text-xs">Grade</p>
                    <p id="detail_grade" class="font-bold text-gray-700 dark:text-gray-200 text-sm"></p>
                </div>
                <div>
                    <p class="text-gray-500 dark:text-gray-400 text-xs">Admission</p>
                    <p id="detail_admission_date" class="font-bold text-gray-700 dark:text-gray-200 text-sm"></p>
                </div>
            </div>
            <!-- Contact & Info -->
            <div class="space-y-3 text-sm">
                <div
                    class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-2 pb-2 border-b border-slate-200 dark:border-slate-700">
                    <x-info.item id="detail_email" label="Email" icon="ri-mail-line" />
                    <x-info.item id="detail_phone" label="Phone" icon="ri-phone-line" />
                    <x-info.item id="detail_code" label="Code" icon="ri-barcode-line" />
                    <x-info.item id="detail_gender" label="Gender" icon="ri-user-line" />
                    <x-info.item id="detail_blood_group" label="Blood Group" icon="ri-heart-line" />
                    <x-info.item id="detail_religion" label="Religion" icon="ri-star-line" />
                    <x-info.item id="" label="Gender" icon="ri-calendar-line" />
                    <x-info.item id="detail_specialization" label="Specialization" icon="ri-book-line" />
                    <x-info.item id="detail_qualification" label="Description" icon="ri-award-line" />
                    <x-info.item id="detail_department" label="Description" icon="ri-building-line" />
                    
                </div>
                <x-info.item id="detail_address" label="Address" icon="ri-map-pin-line" />
                <x-info.item id="detail_description" label="Description" icon="ri-file-text-line" />
            </div>
        </div>
    </div>
    <!-- Footer -->
    <x-modal.footer-actions :detail="true" />
</x-modal.modal>
