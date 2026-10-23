<!-- 1. DRINK CUSTOMIZER MODAL -->
<div id="customizerModal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm hidden items-center justify-center p-4">
  <div class="bg-[#FAF8F5] border border-[#EBE3D5] rounded-3xl max-w-lg w-full max-h-[90vh] overflow-y-auto p-6 relative shadow-2xl">
    <button type="button" onclick="closeCustomizer()" class="absolute top-5 right-5 z-20 w-8 h-8 flex items-center justify-center rounded-full bg-[#EFE9DF] text-[#4A5D4E] hover:text-[#1F3024] hover:bg-[#E3DACB] transition">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
      </svg>
    </button>
    <div id="customizerContent"></div>
  </div>
</div>

<!-- 2. SLIDING CART TRAY DRAWER -->
<div id="cartDrawer" class="fixed inset-y-0 right-0 z-50 w-full max-w-md bg-[#FAF8F5] shadow-2xl border-l border-[#EBE3D5] transform translate-x-full transition-transform duration-300 ease-in-out flex flex-col justify-between">
  <!-- Drawer Header -->
  <div class="p-6 border-b border-[#EBE3D5] flex items-center justify-between">
    <div class="flex items-center space-x-2">
      <h3 class="font-serif text-xl font-bold text-[#1F3024]">Your Atelier Tray</h3>
      <span id="activeTabsCountBadge" class="hidden text-[10px] bg-amber-600 text-white font-bold px-2 py-0.5 rounded-full"></span>
    </div>
    <button onclick="closeCartDrawer()" class="w-8 h-8 flex items-center justify-center rounded-full bg-[#EFE9DF] text-[#4A5D4E] hover:text-[#1F3024] hover:bg-[#E3DACB] transition">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
      </svg>
    </button>
  </div>

  <!-- Tray Items List -->
  <div id="cartItemsList" class="p-6 flex-1 overflow-y-auto space-y-4">
    <!-- Populated by renderCart() in app.js -->
  </div>

  <!-- Checkout / Order Details Form -->
  <div class="p-6 border-t border-[#EBE3D5] bg-[#F5EFE6] space-y-4">
    <div class="space-y-2">
      <input type="text" id="custNameInput" placeholder="Name or Counter / Table No. *" class="w-full text-xs px-3 py-2.5 rounded-xl border border-[#D8CEBC] bg-white focus:outline-none focus:border-[#2D5A2B]">
      <input type="text" id="custPhoneInput" placeholder="WhatsApp / Phone (Optional)" class="w-full text-xs px-3 py-2.5 rounded-xl border border-[#D8CEBC] bg-white focus:outline-none focus:border-[#2D5A2B]">
      
      <select id="custDineOption" class="w-full text-xs px-3 py-2.5 rounded-xl border border-[#D8CEBC] bg-white text-[#1F3024] focus:outline-none focus:border-[#2D5A2B]">
        <option value="Dine-In (Atelier Counter)">Dine-In (Atelier Counter)</option>
        <option value="Takeaway Chawan">Takeaway Cup</option>
      </select>
    </div>

    <!-- Settlement Method Selector -->
    <div>
      <label class="block text-[11px] font-semibold text-[#5B6E5F] uppercase tracking-wider mb-1.5">Settlement Method</label>
      <div class="grid grid-cols-2 gap-2 text-xs">
        <button type="button" id="btnPayLater" onclick="selectPaymentMethod('pay_later')" class="p-2 border rounded-xl text-center border-[#2D5A2B] bg-[#E8F0E6] font-bold text-[#1F3024] transition">
          Open House Tab
        </button>
        <button type="button" id="btnPayNow" onclick="selectPaymentMethod('pay_now')" class="p-2 border rounded-xl text-center border-[#D8CEBC] bg-white text-[#1F3024] transition">
          Pay Immediately
        </button>
      </div>
    </div>

    <!-- Financial Summary -->
    <div class="space-y-1 text-xs pt-2 border-t border-[#E0D7C6]">
      <div class="flex justify-between text-[#5B6E5F]">
        <span>Subtotal</span>
        <span id="cartSubtotal">Rp 0</span>
      </div>
      <div class="flex justify-between text-[#5B6E5F]">
        <span>PB1 Tax (10%)</span>
        <span id="cartTax">Calculated at 10%</span>
      </div>
      <div class="flex justify-between text-sm font-bold text-[#1F3024] pt-1">
        <span>Estimated Total</span>
        <span id="cartTotal">Rp 0</span>
      </div>
    </div>

    <!-- Submit Order Button -->
    <button onclick="handleOrderSubmission()" class="w-full bg-[#2D5A2B] hover:bg-[#234722] text-white py-3 rounded-xl font-medium text-sm shadow-md transition">
      Confirm Order & Send to Atelier
    </button>
  </div>
</div>

<!-- 3. ORDER RECEIPT MODAL -->
<div id="receiptModal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm hidden items-center justify-center p-4">
  <div class="bg-[#FAF8F5] border border-[#EBE3D5] rounded-3xl max-w-sm w-full p-6 text-center space-y-4 shadow-2xl relative">
    <button onclick="closeReceiptModal()" class="absolute top-4 right-4 text-[#5B6E5F] hover:text-[#1F3024]">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
      </svg>
    </button>
    <div class="w-12 h-12 bg-[#E3F2E1] text-[#2D5A2B] rounded-full mx-auto flex items-center justify-center font-bold text-lg">✓</div>
    <h3 class="font-serif text-xl font-bold text-[#1F3024]">Order Recorded</h3>
    <p id="receiptOrderId" class="text-xs font-mono font-bold text-[#2D5A2B]"></p>
    <div class="bg-white p-3 rounded-xl border border-[#EBE3D5] text-xs space-y-1 text-left">
      <div class="flex justify-between"><span class="text-gray-500">Guest:</span><span id="receiptCustName" class="font-semibold"></span></div>
      <div class="flex justify-between"><span class="text-gray-500">Status:</span><span id="receiptStatus"></span></div>
      <div class="flex justify-between font-bold pt-1 border-t border-gray-100"><span class="text-gray-500">Total:</span><span id="receiptTotalAmount"></span></div>
    </div>
    <button id="markSettleBtn" onclick="settleTabNow()" class="w-full bg-[#1F3024] hover:bg-black text-white py-2 rounded-xl text-xs font-semibold">
      Settle Tab Now (Cash / QRIS)
    </button>
  </div>
</div>

<!-- 4. TOAST NOTIFICATION -->
<div id="toastNotification" class="fixed bottom-6 right-6 z-50 bg-[#1F3024] text-white px-5 py-3 rounded-2xl shadow-lg text-sm transition-opacity duration-300 opacity-0 pointer-events-none"></div>