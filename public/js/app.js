// ─────────────────────────────────────────────
//  Chaeri-e Matcha — Cart & Checkout Logic
// ─────────────────────────────────────────────

// --- MENU CATALOG ---
const menuCatalog = {
  usucha: {
    id: 'usucha',
    name: 'Usucha (薄茶)',
    basePrice: 30000,
    isUsucha: true,
    allowMilk: false,
    allowSweetness: false,
    allowIce: false,
    image: '/images/Usucha Display.jpeg',
  },
  latte: {
    id: 'latte',
    name: 'Classic Matcha Latte',
    basePrice: 35000,
    isUsucha: false,
    allowMilk: true,
    allowSweetness: true,
    allowIce: true,
    image: '/images/Matcha latte.jpeg',
  },
  coconut: {
    id: 'coconut',
    name: 'Coconut Matcha',
    basePrice: 35000,
    isUsucha: false,
    allowMilk: false,
    allowSweetness: true,
    allowIce: true,
    image: '/images/Coconut Matcha.jpeg',
  },
  ube: {
    id: 'ube',
    name: 'Ube Matcha',
    basePrice: 45000,
    isUsucha: false,
    allowMilk: true,
    allowSweetness: true,
    allowIce: true,
    image: '/images/Matcha Ube.jpeg',
  },
};

// --- STATE ---
let cart = [];
let currentCustomizingItem = null;
let currentReceiptOrder = null;

// ─────────────────────────────────────────────
//  HELPERS
// ─────────────────────────────────────────────

function formatRupiah(amount) {
  return new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
    maximumFractionDigits: 0,
  }).format(amount);
}

function showToast(message) {
  const toast = document.getElementById('toast');
  if (!toast) return;
  toast.innerText = message;
  toast.classList.remove('opacity-0', 'pointer-events-none');
  toast.classList.add('opacity-100');
  clearTimeout(toast._timer);
  toast._timer = setTimeout(() => {
    toast.classList.add('opacity-0', 'pointer-events-none');
    toast.classList.remove('opacity-100');
  }, 2800);
}

function csrfToken() {
  return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
}

// ─────────────────────────────────────────────
//  CUSTOMIZER MODAL
// ─────────────────────────────────────────────

window.openCustomizer = function (itemId) {
  const item = menuCatalog[itemId];
  if (!item) return;
  currentCustomizingItem = { ...item };

  const modal   = document.getElementById('customizerModal');
  const content = document.getElementById('customizerContent');
  if (!modal || !content) return;

  content.innerHTML = buildCustomizerHTML(item);
  modal.classList.remove('hidden');
  modal.classList.add('flex');
  updateCustomizerPrice();
  if (window.lucide) lucide.createIcons();
};

function buildCustomizerHTML(item) {
  return `
    <div class="space-y-5">
      <!-- Header -->
      <div class="flex items-center gap-4 pb-4 pr-8 border-b border-[#EBE3D5]">
        <img src="${item.image}" alt="${item.name}"
          class="w-16 h-16 rounded-xl object-cover border border-[#E0D7C6] shrink-0">
        <div>
          <h3 class="font-serif text-xl font-bold text-[#1F3024]">${item.name}</h3>
          <p id="customizerCurrentPrice" class="text-sm font-semibold text-[#2D5A2B] mt-0.5">
            ${formatRupiah(item.basePrice)}
          </p>
        </div>
      </div>

      ${item.isUsucha ? `
        <div class="bg-[#F4EFEA] border border-[#E0D7C6] rounded-2xl p-4 text-xs text-[#5B6E5F] space-y-2">
          <div class="flex items-center gap-2 text-[#2D5A2B] font-bold">
            <i data-lucide="flame" class="w-4 h-4"></i>
            <span>Served Hot (78°C) · Zero Sugar · Pure Spring Water</span>
          </div>
          <p class="leading-relaxed">
            Traditional Usucha is whisked exclusively with hot spring water in a chawan.
            To honor the tea ceremony, no ice or sweeteners are added.
          </p>
        </div>
      ` : `
        <!-- Temperature -->
        <div>
          <label class="block text-xs font-semibold text-[#5B6E5F] uppercase tracking-wider mb-2">Temperature</label>
          <div class="grid grid-cols-3 gap-2">
            ${['Regular Ice', 'No Ice (Chilled)', 'Hot (78°C)'].map((t, i) => `
              <label class="cursor-pointer border border-[#E0D7C6] rounded-xl p-2.5 text-center text-xs
                has-[:checked]:border-[#2D5A2B] has-[:checked]:bg-[#E8F0E6] has-[:checked]:font-bold text-[#1F3024] transition">
                <input type="radio" name="optTemp" value="${t}" class="sr-only" ${i === 0 ? 'checked' : ''}>
                ${t}
              </label>`).join('')}
          </div>
        </div>

        <!-- Sweetness -->
        <div>
          <label class="block text-xs font-semibold text-[#5B6E5F] uppercase tracking-wider mb-2">Sweetness</label>
          <div class="grid grid-cols-4 gap-2">
            ${[['0%', '0% (None)', false], ['50%', '50% (Less)', true], ['100%', '100% (Normal)', false], ['Agave +3k', 'Agave', false]].map(([label, val, def]) => `
              <label class="cursor-pointer border border-[#E0D7C6] rounded-xl p-2 text-center text-xs
                has-[:checked]:border-[#2D5A2B] has-[:checked]:bg-[#E8F0E6] has-[:checked]:font-bold text-[#1F3024] transition">
                <input type="radio" name="optSweet" value="${val}" class="sr-only" ${def ? 'checked' : ''} onchange="updateCustomizerPrice()">
                ${label}
              </label>`).join('')}
          </div>
        </div>

        ${item.allowMilk ? `
        <div>
          <label class="block text-xs font-semibold text-[#5B6E5F] uppercase tracking-wider mb-2">Milk Base</label>
          <div class="grid grid-cols-3 gap-2">
            ${[['Oat Milk', 'Barista Oat Milk', true], ['Fresh Milk', 'Fresh Milk', false], ['Almond +5k', 'Almond Milk', false]].map(([label, val, def]) => `
              <label class="cursor-pointer border border-[#E0D7C6] rounded-xl p-2.5 text-center text-xs
                has-[:checked]:border-[#2D5A2B] has-[:checked]:bg-[#E8F0E6] has-[:checked]:font-bold text-[#1F3024] transition">
                <input type="radio" name="optMilk" value="${val}" class="sr-only" ${def ? 'checked' : ''} onchange="updateCustomizerPrice()">
                ${label}
              </label>`).join('')}
          </div>
        </div>
        ` : ''}
      `}

      <!-- Quantity -->
      <div class="flex items-center justify-between pt-1">
        <label class="text-xs font-semibold text-[#5B6E5F] uppercase tracking-wider">Quantity</label>
        <div class="flex items-center border border-[#C5BBA7] rounded-xl overflow-hidden bg-white">
          <button type="button" onclick="changeCustomQty(-1)"
            class="px-3 py-1.5 text-sm text-[#1F3024] hover:bg-[#EAE2D3] transition">−</button>
          <span id="customQtyDisplay" class="px-4 text-sm font-bold text-[#1F3024] select-none">1</span>
          <button type="button" onclick="changeCustomQty(1)"
            class="px-3 py-1.5 text-sm text-[#1F3024] hover:bg-[#EAE2D3] transition">+</button>
        </div>
      </div>

      <!-- CTA -->
      <div class="pt-4 border-t border-[#EBE3D5]">
        <button onclick="confirmAddToCart()"
          class="w-full py-3 rounded-full bg-[#273B24] text-[#FAF7F2] text-sm font-semibold hover:bg-[#365132] transition shadow-md flex items-center justify-center gap-2">
          <i data-lucide="plus" class="w-4 h-4"></i>
          Add to Tray · <span id="customizerAddBtnPrice">${formatRupiah(item.basePrice)}</span>
        </button>
      </div>
    </div>
  `;
}

let _customQty = 1;

window.changeCustomQty = function (delta) {
  _customQty = Math.max(1, _customQty + delta);
  const el = document.getElementById('customQtyDisplay');
  if (el) el.innerText = _customQty;
  updateCustomizerPrice();
};

window.updateCustomizerPrice = function () {
  if (!currentCustomizingItem) return;
  let unit = currentCustomizingItem.basePrice;
  const sweet = document.querySelector('input[name="optSweet"]:checked')?.value;
  const milk  = document.querySelector('input[name="optMilk"]:checked')?.value;
  if (sweet === 'Agave') unit += 3000;
  if (milk  === 'Almond Milk') unit += 5000;
  const total   = unit * _customQty;
  const priceEl = document.getElementById('customizerCurrentPrice');
  const btnEl   = document.getElementById('customizerAddBtnPrice');
  if (priceEl) priceEl.innerText = formatRupiah(total);
  if (btnEl)   btnEl.innerText   = formatRupiah(total);
};

window.closeCustomizer = function () {
  const modal = document.getElementById('customizerModal');
  if (modal) { modal.classList.add('hidden'); modal.classList.remove('flex'); }
  _customQty = 1;
};

window.confirmAddToCart = function () {
  if (!currentCustomizingItem) return;
  let unitPrice = currentCustomizingItem.basePrice;
  let details   = '';

  if (currentCustomizingItem.isUsucha) {
    details = 'Hot (78°C) · Pure Spring Water · Zero Sugar';
  } else {
    const temp  = document.querySelector('input[name="optTemp"]:checked')?.value  || 'Regular Ice';
    const sweet = document.querySelector('input[name="optSweet"]:checked')?.value || '50% (Less)';
    const milk  = document.querySelector('input[name="optMilk"]:checked')?.value  ||
                  (currentCustomizingItem.allowMilk ? 'Barista Oat Milk' : '—');
    if (sweet === 'Agave')       unitPrice += 3000;
    if (milk  === 'Almond Milk') unitPrice += 5000;
    details = `${temp} · ${sweet} Sugar${currentCustomizingItem.allowMilk ? ' · ' + milk : ''}`;
  }

  cart.push({
    id:        currentCustomizingItem.id + '-' + Date.now(),
    name:      currentCustomizingItem.name,
    unitPrice,
    qty:       _customQty,
    details,
  });

  renderCart();
  closeCustomizer();
  showToast(`${_customQty}× ${currentCustomizingItem.name} added to your tray!`);
  openCartDrawer();
};

// ─────────────────────────────────────────────
//  CART DRAWER
// ─────────────────────────────────────────────

window.openCartDrawer = function () {
  const panel    = document.getElementById('cartPanel');
  const backdrop = document.getElementById('cartBackdrop');
  if (panel)    { panel.classList.remove('translate-x-full'); panel.classList.add('translate-x-0'); }
  if (backdrop) { backdrop.classList.remove('opacity-0', 'pointer-events-none'); backdrop.classList.add('opacity-100', 'pointer-events-auto'); }
};

window.closeCartDrawer = function () {
  const panel    = document.getElementById('cartPanel');
  const backdrop = document.getElementById('cartBackdrop');
  if (panel)    { panel.classList.add('translate-x-full'); panel.classList.remove('translate-x-0'); }
  if (backdrop) { backdrop.classList.add('opacity-0', 'pointer-events-none'); backdrop.classList.remove('opacity-100', 'pointer-events-auto'); }
};

window.removeCartItem = function (index) {
  cart.splice(index, 1);
  renderCart();
};

window.changeCartQty = function (index, delta) {
  cart[index].qty = Math.max(1, cart[index].qty + delta);
  renderCart();
};

function renderCart() {
  // Navbar badge — hidden when empty, visible when items exist
  const badge      = document.getElementById('cartCountBadge');
  const totalCount = cart.reduce((s, i) => s + i.qty, 0);
  if (badge) {
    badge.innerText = totalCount;
    badge.classList.toggle('hidden', totalCount === 0);
  }

  // Items list
  const container = document.getElementById('cartItemsContainer');
  if (container) {
    if (cart.length === 0) {
      container.innerHTML = `
        <div class="flex flex-col items-center justify-center h-40 text-[#8A9E85] gap-2">
          <i data-lucide="cup-soda" class="w-8 h-8 opacity-40"></i>
          <p class="text-sm">Your tray is empty.</p>
          <p class="text-xs text-[#A0B09A]">Add a drink from the menu.</p>
        </div>`;
      if (window.lucide) lucide.createIcons();
    } else {
      container.innerHTML = cart.map((item, i) => `
        <div class="flex items-start gap-3 py-3 border-b border-[#EBE3D5] last:border-0">
          <div class="flex-1 min-w-0">
            <p class="text-sm font-semibold text-[#1F2B1E] leading-tight">${item.name}</p>
            <p class="text-[11px] text-[#7B8E78] mt-0.5 leading-snug">${item.details}</p>
            <p class="text-xs font-bold text-[#2D5A2B] mt-1">${formatRupiah(item.unitPrice * item.qty)}</p>
          </div>
          <div class="flex items-center gap-1 border border-[#D5CCB8] rounded-lg overflow-hidden bg-white text-xs shrink-0 mt-0.5">
            <button onclick="changeCartQty(${i}, -1)" class="px-2 py-1 hover:bg-[#EAE2D3] transition text-[#1F2B1E]">−</button>
            <span class="px-2 font-bold text-[#1F2B1E]">${item.qty}</span>
            <button onclick="changeCartQty(${i},  1)" class="px-2 py-1 hover:bg-[#EAE2D3] transition text-[#1F2B1E]">+</button>
          </div>
          <button onclick="removeCartItem(${i})"
            class="shrink-0 p-1 rounded-full text-[#B08070] hover:bg-[#FAE5DF] hover:text-[#8B3A2A] transition mt-0.5">
            <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
          </button>
        </div>`).join('');
      if (window.lucide) lucide.createIcons();
    }
  }

  // Totals
  const subtotal = cart.reduce((s, i) => s + i.unitPrice * i.qty, 0);
  const tax      = subtotal * 0.10;
  const total    = subtotal + tax;
  const el       = (id) => document.getElementById(id);
  if (el('cartSubtotal')) el('cartSubtotal').innerText = formatRupiah(subtotal);
  if (el('cartTax'))      el('cartTax').innerText      = formatRupiah(tax);
  if (el('cartTotal'))    el('cartTotal').innerText    = formatRupiah(total);
}

// ─────────────────────────────────────────────
//  ORDER SUBMISSION
// ─────────────────────────────────────────────

window.handleOrderSubmission = async function () {
  if (cart.length === 0) { showToast('Your tray is empty!'); return; }

  const name  = document.getElementById('custNameInput')?.value.trim();
  const phone = document.getElementById('custPhoneInput')?.value.trim() || 'Walk-in';
  const dine  = document.getElementById('custDineOption')?.value || 'Dine-In (Ceramic Chawan)';
  const notes = document.getElementById('custNotesInput')?.value.trim() || '';

  if (!name) {
    showToast('Please enter your name or table number.');
    document.getElementById('custNameInput')?.focus();
    return;
  }

  const subtotal   = cart.reduce((s, i) => s + i.unitPrice * i.qty, 0);
  const tax        = subtotal * 0.10;
  const total      = subtotal + tax;
  const orderItems = cart.slice(); // snapshot for receipt

  const btn  = document.getElementById('proceedOrderBtn');
  const span = document.getElementById('proceedOrderLabel');
  if (btn) btn.disabled = true;
  if (span) span.innerText = 'Processing…';

  try {
    const res = await fetch('/api/orders', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-CSRF-TOKEN': csrfToken(),
      },
      body: JSON.stringify({
        customer_name: name,
        phone,
        dine_option:   dine,
        notes,
        items:         cart,
        subtotal,
        tax,
        total_amount:  total,
      }),
    });

    const result = await res.json();

    if (result.success) {
      const record = {
        orderId:      result.order.order_id,
        customerName: result.order.customer_name,
        dineOption:   result.order.dine_option,
        totalAmount:  parseFloat(result.order.total_amount),
        status:       result.order.status,
        notes,
        items:        orderItems,
      };

      // Reset cart & fields
      cart = [];
      renderCart();
      closeCartDrawer();
      ['custNameInput', 'custPhoneInput', 'custNotesInput'].forEach(id => {
        const el = document.getElementById(id);
        if (el) el.value = '';
      });
      const dineEl = document.getElementById('custDineOption');
      if (dineEl) dineEl.selectedIndex = 0;

      showOrderReceipt(record);
    } else {
      showToast('Something went wrong. Please try again.');
    }
  } catch (err) {
    console.error('Order error:', err);
    showToast('Unable to reach server. Check your connection.');
  } finally {
    if (btn)  btn.disabled   = false;
    if (span) span.innerText = 'Confirm Order';
  }
};

// ─────────────────────────────────────────────
//  RECEIPT MODAL
// ─────────────────────────────────────────────

function showOrderReceipt(order) {
  currentReceiptOrder = order;
  const modal = document.getElementById('receiptModal');
  if (!modal) return;

  const el = (id) => document.getElementById(id);

  if (el('receiptOrderId'))      el('receiptOrderId').innerText      = '#' + order.orderId;
  if (el('receiptCustomerName')) el('receiptCustomerName').innerText = order.customerName;
  if (el('receiptDineOption'))   el('receiptDineOption').innerText   = order.dineOption;
  if (el('receiptTotalAmount'))  el('receiptTotalAmount').innerText  = formatRupiah(order.totalAmount);

  // Items list
  const itemsList = el('receiptItemsList');
  if (itemsList && order.items?.length) {
    itemsList.innerHTML = order.items.map(item => `
      <div class="flex items-start justify-between gap-2">
        <div class="flex-1">
          <span class="font-semibold text-[#1F2A1E]">${item.qty}× ${item.name}</span>
          <p class="text-[10px] text-[#7B8E78] leading-snug mt-0.5">${item.details}</p>
        </div>
        <span class="font-mono text-[#2B4326] shrink-0">${formatRupiah(item.unitPrice * item.qty)}</span>
      </div>`).join('');
  }

  // Special notes
  const notesBlock = el('receiptNotesBlock');
  const notesText  = el('receiptNotes');
  if (notesBlock && notesText) {
    if (order.notes) {
      notesText.innerText = order.notes;
      notesBlock.classList.remove('hidden');
    } else {
      notesBlock.classList.add('hidden');
    }
  }

  // QR code
  const qrImg = el('receiptQrImage');
  if (qrImg) qrImg.src = `https://api.qrserver.com/v1/create-qr-code/?size=140x140&data=CHAERI-E-${order.orderId}`;

  modal.classList.remove('hidden');
  modal.classList.add('flex');
  if (window.lucide) lucide.createIcons();
}

window.closeReceiptModal = function () {
  const modal = document.getElementById('receiptModal');
  if (modal) { modal.classList.add('hidden'); modal.classList.remove('flex'); }
};

// ─────────────────────────────────────────────
//  MOBILE MENU
// ─────────────────────────────────────────────

function initMobileMenu() {
  const btn        = document.getElementById('mobileMenuBtn');
  const menu       = document.getElementById('mobileMenu');
  const icon       = btn?.querySelector('i');
  const mobileLinks = document.querySelectorAll('.mobile-nav-link');

  if (!btn || !menu) return;

  btn.addEventListener('click', () => {
    const isOpen = !menu.classList.contains('hidden');
    menu.classList.toggle('hidden', isOpen);
    // Swap icon between menu and X
    if (icon) {
      icon.setAttribute('data-lucide', isOpen ? 'menu' : 'x');
      if (window.lucide) lucide.createIcons();
    }
  });

  // Close menu when a link is tapped
  mobileLinks.forEach(link => {
    link.addEventListener('click', () => {
      menu.classList.add('hidden');
      if (icon) {
        icon.setAttribute('data-lucide', 'menu');
        if (window.lucide) lucide.createIcons();
      }
    });
  });
}

// ─────────────────────────────────────────────
//  ACTIVE NAV HIGHLIGHT (Intersection Observer)
// ─────────────────────────────────────────────

function initNavHighlight() {
  const sections  = document.querySelectorAll('section[id], header[id]');
  const navLinks  = document.querySelectorAll('.nav-link, .mobile-nav-link');

  if (!sections.length || !navLinks.length) return;

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const id = entry.target.id;
        navLinks.forEach(link => {
          const matches = link.dataset.section === id;
          link.classList.toggle('active', matches);
        });
      }
    });
  }, { rootMargin: '-30% 0px -60% 0px', threshold: 0 });

  sections.forEach(s => observer.observe(s));
}

// ─────────────────────────────────────────────
//  SCROLL TO TOP
// ─────────────────────────────────────────────

function initScrollToTop() {
  const btn = document.getElementById('scrollTopBtn');
  if (!btn) return;

  window.addEventListener('scroll', () => {
    btn.classList.toggle('visible', window.scrollY > 400);
  }, { passive: true });

  btn.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });
}

// ─────────────────────────────────────────────
// ─────────────────────────────────────────────
//  WEBSITE INQUIRY FORM HANDLER
// ─────────────────────────────────────────────

function initWebsiteInquiryForm() {
  const form = document.getElementById('websiteInquiryForm');
  if (!form) return;

  const alertBox = document.getElementById('inquiryAlertBox');
  const submitBtn = document.getElementById('inquirySubmitBtn');
  const btnText = document.getElementById('inquiryBtnText');
  const btnIcon = document.getElementById('inquiryBtnIcon');
  const btnSpinner = document.getElementById('inquiryBtnSpinner');

  function setAlert(type, message) {
    if (!alertBox) return;
    alertBox.className = type === 'success'
      ? 'mb-6 p-4 rounded-2xl bg-[#E8F3E5] border border-[#B9D8B3] text-[#22481D] flex items-start gap-3 text-xs leading-relaxed'
      : 'mb-6 p-4 rounded-2xl bg-[#FDE8E8] border border-[#F8B4B4] text-[#9B1C1C] flex items-start gap-3 text-xs leading-relaxed';

    const iconName = type === 'success' ? 'check-circle-2' : 'alert-circle';
    alertBox.innerHTML = `
      <i data-lucide="${iconName}" class="w-5 h-5 shrink-0 mt-0.5"></i>
      <div>
        <p class="font-semibold text-sm">${type === 'success' ? 'Request Sent!' : 'Submission Failed'}</p>
        <p class="mt-0.5">${message}</p>
      </div>
    `;
    alertBox.classList.remove('hidden');
    if (window.lucide) lucide.createIcons();
  }

  form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const name = form.querySelector('[name="name"]')?.value.trim();
    const email = form.querySelector('[name="email"]')?.value.trim();
    const waNumber = form.querySelector('[name="wa_number"]')?.value.trim();

    if (!name || !email || !waNumber) {
      setAlert('error', 'Please fill in all required fields (Name, Email, and WhatsApp number).');
      return;
    }

    // Set loading state
    submitBtn.disabled = true;
    if (btnText) btnText.innerText = 'Submitting Request...';
    btnIcon?.classList.add('hidden');
    btnSpinner?.classList.remove('hidden');

    try {
      const formData = new FormData(form);
      const response = await fetch(form.action || '/inquiries', {
        method: 'POST',
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': csrfToken(),
        },
        body: formData,
      });

      const data = await response.json();

      if (response.ok && data.success) {
        setAlert('success', data.message || 'Thank you! Your request has been received. We will contact you soon on WhatsApp.');
        form.reset();
        showToast('Website inquiry submitted successfully!');
      } else {
        const errorMsg = data.message || (data.errors ? Object.values(data.errors).flat().join(' ') : 'Failed to send inquiry. Please try again.');
        setAlert('error', errorMsg);
      }
    } catch (err) {
      console.error(err);
      setAlert('error', 'A network error occurred. Please check your connection or contact us directly on WhatsApp.');
    } finally {
      submitBtn.disabled = false;
      if (btnText) btnText.innerText = 'Submit Website Consultation Request';
      btnIcon?.classList.remove('hidden');
      btnSpinner?.classList.add('hidden');
    }
  });
}

//  DOM READY — WIRE UP EVERYTHING
// ─────────────────────────────────────────────

document.addEventListener('DOMContentLoaded', () => {
  renderCart();
  if (window.lucide) lucide.createIcons();

  // Cart
  document.getElementById('openCartBtn')?.addEventListener('click', openCartDrawer);
  document.getElementById('closeCartBtn')?.addEventListener('click', closeCartDrawer);
  document.getElementById('cartBackdrop')?.addEventListener('click', closeCartDrawer);
  document.getElementById('proceedOrderBtn')?.addEventListener('click', handleOrderSubmission);

  // ESC closes any open overlay
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      closeCustomizer();
      closeCartDrawer();
      closeReceiptModal();
    }
  });

  // New features
  initMobileMenu();
  initNavHighlight();
  initScrollToTop();
  initWebsiteInquiryForm();
});
