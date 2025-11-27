{{-- This modal requires Alpine.js and Tailwind CSS --}}
<div x-show="isOpen" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title"
  role="dialog" aria-modal="true">

  {{-- Backdrop --}}
  <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="closeModal()"></div>

  {{-- Modal Panel --}}
  <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

    <div x-transition:enter="ease-out duration-300"
      x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
      x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
      x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
      x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
      class="relative inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">

      <form :action="actionUrl" method="POST">
        @csrf
        <input type="hidden" name="fee_id" :value="feeId">
        <template x-if="isEdit">
          @method('PUT')
        </template>

        <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
          <div class="sm:flex sm:items-start">
            <div
              class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 dark:bg-green-900 sm:mx-0 sm:h-10 sm:w-10">
              <i class="fa-solid fa-money-bill-transfer text-green-600 dark:text-green-300"></i>
            </div>
            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
              <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100" id="modal-title"
                x-text="modalTitle"></h3>
              <div class="mt-2 space-y-4">

                {{-- Hidden Fee ID (for context/validation) --}}
                <p class="text-sm text-gray-500 dark:text-gray-400" x-text="'Fee ID: ' + feeId"></p>

                {{-- Amount Field --}}
                <div>
                  <label for="amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Amount
                    Paid</label>
                  <input type="number" step="0.01" min="0.01" id="amount" name="amount"
                    x-model="formData.amount" required
                    class="mt-1 block w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm p-2 text-gray-900 dark:text-gray-100 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                {{-- Payment Date Field --}}
                <div>
                  <label for="payment_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Payment
                    Date</label>
                  <input type="date" id="payment_date" name="payment_date" x-model="formData.payment_date" required
                    class="mt-1 block w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm p-2 text-gray-900 dark:text-gray-100 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                {{-- Payment Method Field --}}
                <div>
                  <label for="payment_method" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Payment
                    Method</label>
                  <select id="payment_method" name="payment_method" x-model="formData.payment_method"
                    class="mt-1 block w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm p-2 text-gray-900 dark:text-gray-100 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="Cash">Cash</option>
                    <option value="Bank Transfer">Bank Transfer</option>
                    <option value="Card">Card</option>
                    <option value="Mobile Payment">Mobile Payment</option>
                  </select>
                </div>

                {{-- Transaction ID Field --}}
                <div>
                  <label for="transaction_id"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Transaction ID (Optional)</label>
                  <input type="text" id="transaction_id" name="transaction_id" x-model="formData.transaction_id"
                    class="mt-1 block w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm p-2 text-gray-900 dark:text-gray-100 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                {{-- Remarks Field --}}
                <div>
                  <label for="remarks" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Remarks
                    (Optional)</label>
                  <textarea id="remarks" name="remarks" x-model="formData.remarks" rows="2"
                    class="mt-1 block w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm p-2 text-gray-900 dark:text-gray-100 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                </div>

              </div>
            </div>
          </div>
        </div>

        <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
          <button type="submit"
            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm"
            x-text="isEdit ? 'Update Payment' : 'Save Payment'">
          </button>
          <button type="button" @click="closeModal()"
            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-gray-800 text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
            Cancel
          </button>
        </div>
      </form>

    </div>
  </div>
</div>

<script>
  document.addEventListener('alpine:init', () => {
    Alpine.data('paymentsModal', () => ({
      // Modal state
      isOpen: false,
      isEdit: false,
      modalTitle: 'Add New Payment',
      actionUrl: '{{ route('admin.payments.store') }}', // Default to store route

      // Data passed from the button
      feeId: null,
      paymentId: null, // For update actions

      // Form data
      formData: {
        amount: '',
        payment_date: new Date().toISOString().substring(0, 10), // Default to today
        payment_method: 'Cash',
        transaction_id: '',
        remarks: '',
      },

      // Opens the modal for C(reate)
      openModal(feeId, storeRoute) {
        this.feeId = feeId;
        this.isEdit = false;
        this.modalTitle = 'Add New Payment to Fee ID: ' + feeId;
        this.actionUrl = storeRoute;

        // Reset form data for creation
        this.formData = {
          amount: '',
          payment_date: new Date().toISOString().substring(0, 10),
          payment_method: 'Cash',
          transaction_id: '',
          remarks: '',
        };

        this.isOpen = true;
      },

      // Future feature: Open for U(pdate)
      // openEditModal(payment, updateRoute) {
      //     this.feeId = payment.fee_id;
      //     this.paymentId = payment.id;
      //     this.isEdit = true;
      //     this.modalTitle = 'Edit Payment #' + payment.id;
      //     this.actionUrl = updateRoute.replace(':payment', payment.id);

      //     // Populate form with payment data
      //     this.formData = {
      //         amount: payment.amount,
      //         payment_date: new Date(payment.payment_date).toISOString().substring(0, 10),
      //         payment_method: payment.payment_method,
      //         transaction_id: payment.transaction_id,
      //         remarks: payment.remarks,
      //     };

      //     this.isOpen = true;
      // },

      closeModal() {
        this.isOpen = false;
      }
    }));
  });
</script>
