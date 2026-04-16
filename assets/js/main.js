document.addEventListener('DOMContentLoaded', () => {
    const basePath = getBasePath();
    const apiBase = `${basePath}api`;
    const cartStorageKey = 'shapehugs_cart_v1';

    const fallbackCatalog = [
        {
            id: 1,
            name: 'The Sage Silk Midi',
            price: '68.00',
            comparePrice: '88.00',
            image: 'assets/images/p1.png',
            secondaryImage: 'assets/images/hero2.png',
            category: 'Dresses',
            categorySlug: 'dresses',
            badge: 'New In',
            featured: 1,
            isNew: 1,
            collections: ['new-in', 'featured', 'bestsellers'],
            description: 'A flowing midi dress cut from soft silk with a clean waist tie and elegant drape.',
            sizes: ['XS', 'S', 'M', 'L'],
            colors: ['Sage', 'Ivory'],
            rating: 4.9,
            reviews: 48,
        },
        {
            id: 2,
            name: 'White Lace Blouse',
            price: '45.00',
            comparePrice: '58.00',
            image: 'assets/images/p2.png',
            secondaryImage: 'assets/images/cat_tops.png',
            category: 'Tops',
            categorySlug: 'tops',
            badge: 'Editor\'s Pick',
            featured: 1,
            isNew: 1,
            collections: ['new-in', 'featured'],
            description: 'A modern blouse with delicate lace texture and a relaxed, feminine fit.',
            sizes: ['XS', 'S', 'M', 'L', 'XL'],
            colors: ['Ivory', 'Sand'],
            rating: 4.7,
            reviews: 31,
        },
        {
            id: 3,
            name: 'Pleated High-Waist Skirt',
            price: '54.00',
            comparePrice: '72.00',
            image: 'assets/images/p3.png',
            secondaryImage: 'assets/images/cat_bottoms.png',
            category: 'Bottoms',
            categorySlug: 'bottoms',
            badge: 'Best Seller',
            featured: 1,
            isNew: 0,
            collections: ['bestsellers', 'featured'],
            description: 'A crisp pleated skirt designed to move easily from office hours to dinner.',
            sizes: ['XS', 'S', 'M', 'L'],
            colors: ['Pearl', 'Black'],
            rating: 4.8,
            reviews: 65,
        },
        {
            id: 4,
            name: 'Vintage Floral Dress',
            price: '72.00',
            comparePrice: '92.00',
            image: 'assets/images/hero.png',
            secondaryImage: 'assets/images/hero3.png',
            category: 'Dresses',
            categorySlug: 'dresses',
            badge: 'Limited',
            featured: 1,
            isNew: 0,
            collections: ['featured', 'sale'],
            description: 'A romantic floral dress with soft sleeves and a vintage-inspired shape.',
            sizes: ['XS', 'S', 'M', 'L'],
            colors: ['Rose', 'Cream'],
            rating: 4.6,
            reviews: 22,
        },
        {
            id: 5,
            name: 'Linen Wrap Dress',
            price: '85.00',
            comparePrice: '110.00',
            image: 'assets/images/cat_dresses.png',
            secondaryImage: 'assets/images/hero2.png',
            category: 'Dresses',
            categorySlug: 'dresses',
            badge: 'New In',
            featured: 1,
            isNew: 1,
            collections: ['new-in', 'featured'],
            description: 'A breathable wrap dress in textured linen, made for warm days and easy layering.',
            sizes: ['XS', 'S', 'M', 'L'],
            colors: ['Natural', 'Olive'],
            rating: 4.8,
            reviews: 39,
        },
        {
            id: 6,
            name: 'Tailored Linen Trousers',
            price: '78.00',
            comparePrice: '96.00',
            image: 'assets/images/cat_bottoms.png',
            secondaryImage: 'assets/images/hero3.png',
            category: 'Bottoms',
            categorySlug: 'bottoms',
            badge: 'Minimal',
            featured: 0,
            isNew: 1,
            collections: ['new-in'],
            description: 'Relaxed tailored trousers with a polished silhouette and premium linen handfeel.',
            sizes: ['XS', 'S', 'M', 'L', 'XL'],
            colors: ['Stone', 'Charcoal'],
            rating: 4.5,
            reviews: 18,
        },
        {
            id: 7,
            name: 'Silk Ribbon Blouse',
            price: '55.00',
            comparePrice: '70.00',
            image: 'assets/images/cat_tops.png',
            secondaryImage: 'assets/images/p2.png',
            category: 'Tops',
            categorySlug: 'tops',
            badge: 'New In',
            featured: 0,
            isNew: 1,
            collections: ['new-in'],
            description: 'An airy blouse finished with soft ribbon details and a subtle sheen.',
            sizes: ['XS', 'S', 'M', 'L'],
            colors: ['Ivory', 'Sage'],
            rating: 4.7,
            reviews: 27,
        },
        {
            id: 8,
            name: 'Straw Handbag',
            price: '28.00',
            comparePrice: '38.00',
            image: 'assets/images/cat_accessories.png',
            secondaryImage: 'assets/images/hero3.png',
            category: 'Accessories',
            categorySlug: 'accessories',
            badge: 'Sale',
            featured: 0,
            isNew: 0,
            collections: ['sale'],
            description: 'A lightweight woven bag that pairs easily with resort and everyday looks.',
            sizes: ['One Size'],
            colors: ['Natural'],
            rating: 4.4,
            reviews: 15,
        },
        {
            id: 9,
            name: 'Evening Velvet Midi',
            price: '120.00',
            comparePrice: '145.00',
            image: 'assets/images/hero2.png',
            secondaryImage: 'assets/images/hero.png',
            category: 'Dresses',
            categorySlug: 'dresses',
            badge: 'Exclusive',
            featured: 0,
            isNew: 0,
            collections: ['bestsellers', 'sale'],
            description: 'A dramatic velvet midi designed for after-dark occasions with an elegant drape.',
            sizes: ['XS', 'S', 'M', 'L'],
            colors: ['Black', 'Wine'],
            rating: 4.9,
            reviews: 19,
        },
        {
            id: 10,
            name: 'Soft Tailored Blazer',
            price: '94.00',
            comparePrice: '118.00',
            image: 'assets/images/hero3.png',
            secondaryImage: 'assets/images/cat_tops.png',
            category: 'Tops',
            categorySlug: 'tops',
            badge: 'Featured',
            featured: 1,
            isNew: 0,
            collections: ['featured', 'bestsellers'],
            description: 'A lightweight blazer cut with soft shoulders for a cleaner daily uniform.',
            sizes: ['XS', 'S', 'M', 'L'],
            colors: ['Sand', 'Black'],
            rating: 4.6,
            reviews: 11,
        },
    ];

    const state = {
        products: fallbackCatalog.slice(),
        cart: loadCart(),
        activeProduct: null,
        activeSlide: 0,
        autoPlay: null,
    };

    const dom = {
        mobileToggle: document.getElementById('mobile-toggle'),
        closeMenu: document.getElementById('close-menu'),
        navMenu: document.querySelector('.nav-menu'),
        searchTrigger: document.getElementById('search-trigger'),
        searchTriggerMobile: document.getElementById('search-trigger-mobile'),
        searchOverlay: document.getElementById('search-overlay'),
        searchClose: document.getElementById('search-close'),
        searchInput: document.getElementById('search-input'),
        searchResults: document.getElementById('search-results'),
        cartTrigger: document.getElementById('cart-trigger'),
        cartDrawer: document.getElementById('cart-drawer'),
        cartClose: document.getElementById('cart-close'),
        drawerOverlay: document.getElementById('drawer-overlay'),
        cartItems: document.getElementById('cart-items'),
        cartBadge: document.getElementById('cart-badge'),
        cartTotalAmount: document.getElementById('cart-total-amount'),
        quickViewModal: document.getElementById('quick-view-modal'),
        modalClose: document.getElementById('modal-close'),
        modalBody: document.getElementById('modal-body'),
        cartPageBody: document.getElementById('full-cart-body'),
        cartPageSubtotal: document.getElementById('full-cart-subtotal'),
        cartPageTotal: document.getElementById('full-cart-total'),
        checkoutButton: document.querySelector('.place-order-btn'),
        checkoutSummaryList: document.querySelector('.summary-items'),
        checkoutSubtotalRow: findSummaryValue('Subtotal'),
        checkoutShippingRow: findSummaryValue('Shipping'),
        checkoutTaxRow: findSummaryValue('Estimated Tax'),
        checkoutTotalRow: document.querySelector('.summary-total span:last-child'),
        checkoutSections: document.querySelectorAll('.checkout-section'),
        productViewGrid: document.querySelector('.product-view-grid'),
        productViewMainImage: document.getElementById('main-product-image'),
        productViewGallery: document.querySelector('.thumbnail-grid'),
        productViewBreadcrumb: document.querySelector('.breadcrumb'),
        productViewTitle: document.querySelector('.product-title'),
        productViewPrice: document.querySelector('.product-price-large'),
        productViewDescription: document.querySelector('.tab-item.active .tab-content p'),
        productViewTabs: document.querySelectorAll('.tab-item'),
        faqItems: document.querySelectorAll('.faq-item'),
        newsletterForms: document.querySelectorAll('.newsletter-form'),
        chatTrigger: document.getElementById('chat-trigger-btn'),
        chatWindow: document.getElementById('chat-window'),
        chatClose: document.getElementById('chat-close-btn'),
        addToBagButton: document.querySelector('.add-to-bag-btn'),
    };

    if (window.gsap && window.ScrollTrigger) {
        gsap.registerPlugin(ScrollTrigger);
    }

    initialize();

    async function initialize() {
        setupNavigation();
        setupHeroCarousel();
        setupSearchOverlay();
        setupCartDrawer();
        setupQuickViewModal();
        setupTabs();
        setupFaq();
        setupChatWidget();
        setupNewsletterForms();
        setupCheckoutButton();
        setupCartPage();
        setupScrollMotion();

        hydrateProductLinks(document);
        renderCart();
        renderCartPage();
        renderCheckoutSummary();

        await loadCatalog();

        hydrateProductLinks(document);
        hydrateApiGrids();
        renderCart();
        renderCartPage();
        renderCheckoutSummary();
        hydrateProductView();

        if (dom.searchInput && dom.searchInput.value.trim().length >= 2) {
            renderSearchResults(dom.searchInput.value.trim());
        }

        if (dom.productViewGrid) {
            animatePage('.product-view-grid > *');
        }

        if (document.querySelector('.cart-page')) {
            animatePage('.cart-page > *');
        }

        if (document.querySelector('.checkout-grid')) {
            animatePage('.checkout-grid > *');
        }
    }

    function getBasePath() {
        const pathname = window.location.pathname;
        if (pathname.includes('/user/menus/')) {
            return '../../';
        }

        if (pathname.includes('/user/')) {
            return '../';
        }

        if (pathname.includes('/admin/')) {
            return '../';
        }

        return '';
    }

    function findSummaryValue(label) {
        const rows = document.querySelectorAll('.order-summary-box .summary-item');
        for (const row of rows) {
            if (!row.textContent || !row.textContent.includes(label)) {
                continue;
            }

            return row.querySelector('span:last-child');
        }

        return null;
    }

    function resolveAsset(path) {
        if (!path) {
            return '';
        }

        if (path.startsWith('http') || path.startsWith('/') || path.startsWith('data:')) {
            return path;
        }

        return `${basePath}${path}`;
    }

    function escapeHtml(value) {
        return String(value ?? '')
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#39;');
    }

    function formatMoney(value) {
        return `$${Number(value || 0).toFixed(2)}`;
    }

    function loadCart() {
        try {
            const raw = window.localStorage.getItem(cartStorageKey);
            const parsed = raw ? JSON.parse(raw) : [];
            return Array.isArray(parsed) ? parsed : [];
        } catch (error) {
            return [];
        }
    }

    function saveCart() {
        try {
            window.localStorage.setItem(cartStorageKey, JSON.stringify(state.cart));
        } catch (error) {
            // Ignore storage failures.
        }
    }

    async function fetchJson(url, options = {}) {
        const response = await fetch(url, {
            headers: {
                Accept: 'application/json',
                ...(options.headers || {}),
            },
            ...options,
        });

        const text = await response.text();
        let data = {};

        try {
            data = text ? JSON.parse(text) : {};
        } catch (error) {
            data = { success: false, message: text };
        }

        if (!response.ok) {
            throw new Error(data.message || 'Request failed');
        }

        return data;
    }

    async function loadCatalog() {
        try {
            const data = await fetchJson(`${apiBase}/products.php?limit=100`);
            if (data.success && Array.isArray(data.data) && data.data.length > 0) {
                state.products = data.data;
            }
        } catch (error) {
            state.products = fallbackCatalog.slice();
        }
    }

    function hydrateApiGrids() {
        const apiGrids = document.querySelectorAll('[data-api-collection], [data-api-category], [data-api-featured]');
        apiGrids.forEach((grid) => {
            const shouldReplace = grid.dataset.apiReplace === 'true' || grid.children.length === 0;
            if (!shouldReplace) {
                return;
            }

            const filters = {
                collection: grid.dataset.apiCollection || '',
                category: grid.dataset.apiCategory || '',
                featured: grid.dataset.apiFeatured === 'true',
                sale: grid.dataset.apiSale === 'true',
                limit: Number(grid.dataset.apiLimit || 0),
            };

            const products = filterProducts(state.products, filters);
            grid.innerHTML = products.length > 0
                ? products.map((product) => renderProductCard(product)).join('')
                : '<div class="empty-state">No products available right now.</div>';

            wireProductCards(grid);
        });
    }

    function filterProducts(products, filters = {}) {
        return products.filter((product) => {
            if ((product.status || 'active') !== 'active') {
                return false;
            }

            if (filters.category && String(product.categorySlug || '').toLowerCase() !== String(filters.category).toLowerCase()) {
                return false;
            }

            if (filters.collection) {
                const collection = String(filters.collection).toLowerCase();
                const productCollections = Array.isArray(product.collections)
                    ? product.collections.map((item) => String(item).toLowerCase())
                    : [];

                if (collection === 'featured' && !Number(product.featured)) {
                    return false;
                }

                if (collection === 'new-in' && !Number(product.isNew)) {
                    return false;
                }

                if (collection === 'sale' && Number(product.comparePrice || 0) <= Number(product.price || 0)) {
                    return false;
                }

                if (!['featured', 'new-in', 'sale'].includes(collection) && !productCollections.includes(collection)) {
                    return false;
                }
            }

            if (filters.featured && !Number(product.featured)) {
                return false;
            }

            if (filters.sale && Number(product.comparePrice || 0) <= Number(product.price || 0)) {
                return false;
            }

            return true;
        }).slice(0, filters.limit && filters.limit > 0 ? filters.limit : undefined);
    }

    function renderProductCard(product) {
        const image = resolveAsset(product.image);
        const comparePrice = Number(product.comparePrice || 0);
        const price = Number(product.price || 0);
        const title = escapeHtml(product.name);
        const category = escapeHtml(product.category || 'Collection');
        const badge = product.badge ? `<span class="product-badge">${escapeHtml(product.badge)}</span>` : '';
        const strikePrice = comparePrice > price ? `<span style="margin-left:8px; color: var(--muted-text); text-decoration: line-through; font-size: 12px;">${formatMoney(comparePrice)}</span>` : '';

        return `
            <div class="product-card" data-id="${escapeHtml(product.id)}" data-name="${title}" data-price="${escapeHtml(price.toFixed(2))}" data-image="${image}" data-category="${category}">
                <div class="product-image-wrapper">
                    ${badge}
                    <i class="fa-regular fa-heart wishlist-icon"></i>
                    <img src="${image}" alt="${title}">
                    <div class="product-actions">
                        <button class="action-btn quick-view"><i class="fa-regular fa-eye"></i> Quick View</button>
                        <button class="action-btn add-to-cart"><i class="fa-solid fa-plus"></i> Add to Cart</button>
                    </div>
                </div>
                <div class="product-info">
                    <h3 class="product-name serif"><a href="${resolvePath(`user/pages/product-view.php?id=${product.id}`)}" style="color: inherit; text-decoration: none;">${title}</a></h3>
                    <p class="product-price">${formatMoney(price)}${strikePrice}</p>
                </div>
            </div>
        `;
    }

    function resolvePath(path) {
        return `${basePath}${path}`;
    }

    function wireProductCards(scope = document) {
        scope.querySelectorAll('.product-card').forEach((card) => {
            const id = card.dataset.id;
            const product = findProduct(id, card);
            const name = card.dataset.name || product?.name || 'Product';
            const price = card.dataset.price || product?.price || '0';
            const image = card.dataset.image || product?.image || '';
            const size = product?.sizes?.[0] || 'S';
            const color = product?.colors?.[0] || 'Ivory';

            const titleLink = card.querySelector('.product-name a');
            if (titleLink) {
                titleLink.setAttribute('href', resolvePath(`user/pages/product-view.php?id=${id}`));
            }

            const addButton = card.querySelector('.add-to-cart');
            if (addButton) {
                addButton.onclick = (event) => {
                    event.preventDefault();
                    event.stopPropagation();
                    addToCart({ id, name, price, image, size, color });
                };
            }

            const quickViewButton = card.querySelector('.quick-view');
            if (quickViewButton) {
                quickViewButton.onclick = (event) => {
                    event.preventDefault();
                    event.stopPropagation();
                    openQuickView({ id, name, price, image, size, color, product });
                };
            }
        });
    }

    function findProduct(id, card = null) {
        const numericId = Number(id);
        const byState = state.products.find((product) => Number(product.id) === numericId);
        if (byState) {
            return byState;
        }

        if (card) {
            return fallbackCatalog.find((product) => Number(product.id) === numericId) || null;
        }

        return null;
    }

    function openSearch() {
        if (!dom.searchOverlay) {
            return;
        }

        dom.searchOverlay.classList.add('active');
        document.body.style.overflow = 'hidden';
        window.setTimeout(() => dom.searchInput && dom.searchInput.focus(), 250);

        if (window.gsap) {
            gsap.fromTo('.search-input-wrapper', { opacity: 0, y: 24 }, { opacity: 1, y: 0, duration: 0.6, ease: 'power3.out' });
        }
    }

    function closeSearch() {
        if (!dom.searchOverlay) {
            return;
        }

        dom.searchOverlay.classList.remove('active');
        document.body.style.overflow = '';
        if (dom.searchInput) {
            dom.searchInput.value = '';
        }
        if (dom.searchResults) {
            dom.searchResults.innerHTML = '';
        }
    }

    function renderSearchResults(query) {
        if (!dom.searchResults) {
            return;
        }

        const normalized = query.trim().toLowerCase();
        dom.searchResults.innerHTML = '';

        if (normalized.length < 2) {
            return;
        }

        const matches = state.products.filter((product) => {
            const haystack = `${product.name || ''} ${product.category || ''} ${product.description || ''}`.toLowerCase();
            return haystack.includes(normalized);
        });

        if (matches.length === 0) {
            dom.searchResults.innerHTML = `<div class="no-results">No products found for "${escapeHtml(query)}"</div>`;
            return;
        }

        dom.searchResults.innerHTML = matches.map((product) => `
            <a href="${resolvePath(`user/pages/product-view.php?id=${product.id}`)}" class="search-result-item" style="text-decoration: none; color: inherit;">
                <img src="${resolveAsset(product.image)}" alt="${escapeHtml(product.name)}">
                <div class="search-result-info">
                    <h4>${escapeHtml(product.name)}</h4>
                    <p>${escapeHtml(product.category || '')} | ${formatMoney(product.price)}</p>
                </div>
            </a>
        `).join('');
    }

    function setupSearchOverlay() {
        if (dom.searchTrigger) {
            dom.searchTrigger.addEventListener('click', openSearch);
        }

        if (dom.searchTriggerMobile) {
            dom.searchTriggerMobile.addEventListener('click', openSearch);
        }

        if (dom.searchClose) {
            dom.searchClose.addEventListener('click', closeSearch);
        }

        if (dom.searchInput) {
            dom.searchInput.addEventListener('input', (event) => renderSearchResults(event.target.value));
        }

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && dom.searchOverlay && dom.searchOverlay.classList.contains('active')) {
                closeSearch();
            }
        });
    }

    function setupNavigation() {
        if (dom.mobileToggle && dom.navMenu) {
            dom.mobileToggle.addEventListener('click', () => {
                dom.navMenu.classList.add('active');
                document.body.style.overflow = 'hidden';
            });
        }

        if (dom.closeMenu && dom.navMenu) {
            dom.closeMenu.addEventListener('click', () => {
                dom.navMenu.classList.remove('active');
                document.body.style.overflow = '';
            });
        }

        document.querySelectorAll('.has-submenu > .nav-link').forEach((link) => {
            link.addEventListener('click', (event) => {
                if (window.innerWidth > 991) {
                    return;
                }

                event.preventDefault();
                const parent = link.parentElement;
                document.querySelectorAll('.has-submenu').forEach((item) => {
                    if (item !== parent) {
                        item.classList.remove('mobile-active');
                    }
                });
                parent.classList.toggle('mobile-active');
            });
        });
    }

    function setupHeroCarousel() {
        const slides = Array.from(document.querySelectorAll('.hero-slide'));
        const dots = Array.from(document.querySelectorAll('.dot'));
        const prevBtn = document.querySelector('.carousel-prev');
        const nextBtn = document.querySelector('.carousel-next');

        if (slides.length <= 1) {
            return;
        }

        const showSlide = (index) => {
            slides.forEach((slide) => slide.classList.remove('active'));
            dots.forEach((dot) => dot.classList.remove('active'));
            slides[index].classList.add('active');
            if (dots[index]) {
                dots[index].classList.add('active');
            }
            state.activeSlide = index;

            if (window.gsap) {
                gsap.fromTo(slides[index].querySelectorAll('.hero-content > *'), { opacity: 0, y: 24 }, { opacity: 1, y: 0, duration: 0.8, stagger: 0.12, ease: 'power3.out' });
            }
        };

        const nextSlide = () => showSlide((state.activeSlide + 1) % slides.length);
        const prevSlide = () => showSlide((state.activeSlide - 1 + slides.length) % slides.length);

        if (prevBtn) {
            prevBtn.addEventListener('click', () => {
                prevSlide();
                resetAutoPlay();
            });
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', () => {
                nextSlide();
                resetAutoPlay();
            });
        }

        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                showSlide(index);
                resetAutoPlay();
            });
        });

        const resetAutoPlay = () => {
            if (state.autoPlay) {
                window.clearInterval(state.autoPlay);
            }
            state.autoPlay = window.setInterval(nextSlide, 6000);
        };

        resetAutoPlay();
        showSlide(0);
    }

    function setupCartDrawer() {
        if (dom.cartTrigger) {
            dom.cartTrigger.addEventListener('click', openCartDrawer);
        }

        if (dom.cartClose) {
            dom.cartClose.addEventListener('click', closeCartDrawer);
        }

        if (dom.drawerOverlay) {
            dom.drawerOverlay.addEventListener('click', closeCartDrawer);
        }
    }

    function openCartDrawer() {
        if (!dom.cartDrawer) {
            return;
        }

        dom.cartDrawer.classList.add('active');
        if (dom.drawerOverlay) {
            dom.drawerOverlay.classList.add('active');
        }
        document.body.style.overflow = 'hidden';
    }

    function closeCartDrawer() {
        if (!dom.cartDrawer) {
            return;
        }

        dom.cartDrawer.classList.remove('active');
        if (dom.drawerOverlay) {
            dom.drawerOverlay.classList.remove('active');
        }
        document.body.style.overflow = '';
    }

    function addToCart(product, quantity = 1) {
        const size = product.size || product.sizes?.[0] || 'One Size';
        const color = product.color || product.colors?.[0] || 'Ivory';
        const key = `${product.id}-${size}-${color}`;
        const existing = state.cart.find((item) => item.key === key);

        if (existing) {
            existing.quantity += quantity;
        } else {
            state.cart.push({
                key,
                id: Number(product.id),
                name: product.name,
                price: Number(product.price || 0),
                image: product.image,
                quantity,
                size,
                color,
            });
        }

        saveCart();
        renderCart();
        renderCartPage();
        renderCheckoutSummary();
        showToast(`${product.name} added to your bag`);
        openCartDrawer();
    }

    function updateCartQuantity(key, delta) {
        const item = state.cart.find((cartItem) => cartItem.key === key);
        if (!item) {
            return;
        }

        item.quantity += delta;
        if (item.quantity <= 0) {
            state.cart = state.cart.filter((cartItem) => cartItem.key !== key);
        }

        saveCart();
        renderCart();
        renderCartPage();
        renderCheckoutSummary();
    }

    function removeCartItem(key) {
        state.cart = state.cart.filter((item) => item.key !== key);
        saveCart();
        renderCart();
        renderCartPage();
        renderCheckoutSummary();
    }

    function cartSummary() {
        const subtotal = state.cart.reduce((sum, item) => sum + (Number(item.price) * Number(item.quantity)), 0);
        const shipping = subtotal >= 99 || subtotal === 0 ? 0 : 9.99;
        const tax = subtotal * 0.08;
        const total = subtotal + shipping + tax;

        return { subtotal, shipping, tax, total };
    }

    function renderCart() {
        const totals = cartSummary();
        const count = state.cart.reduce((sum, item) => sum + Number(item.quantity), 0);

        if (dom.cartBadge) {
            dom.cartBadge.textContent = String(count);
        }

        if (!dom.cartItems) {
            return;
        }

        if (state.cart.length === 0) {
            dom.cartItems.innerHTML = `
                <div class="empty-cart-message">
                    <p>Your bag is currently empty.</p>
                    <a href="${resolvePath('user/menus/new-in.php')}" class="btn-underline">Shop New Arrivals</a>
                </div>
            `;
        } else {
            dom.cartItems.innerHTML = state.cart.map((item) => `
                <div class="cart-item">
                    <img src="${resolveAsset(item.image)}" alt="${escapeHtml(item.name)}">
                    <div class="cart-item-info">
                        <h4>${escapeHtml(item.name)}</h4>
                        <p>${formatMoney(item.price)}</p>
                        <p class="small text-muted">Size: ${escapeHtml(item.size)} | Color: ${escapeHtml(item.color)}</p>
                        <div class="cart-item-qty">
                            <button class="qty-btn minus" data-key="${escapeHtml(item.key)}">-</button>
                            <span class="mx-2">${item.quantity}</span>
                            <button class="qty-btn plus" data-key="${escapeHtml(item.key)}">+</button>
                        </div>
                        <span class="cart-item-remove" data-key="${escapeHtml(item.key)}">Remove</span>
                    </div>
                </div>
            `).join('');
        }

        if (dom.cartTotalAmount) {
            dom.cartTotalAmount.textContent = formatMoney(totals.total);
        }

        dom.cartItems.querySelectorAll('.qty-btn.plus').forEach((button) => {
            button.onclick = () => updateCartQuantity(button.dataset.key, 1);
        });

        dom.cartItems.querySelectorAll('.qty-btn.minus').forEach((button) => {
            button.onclick = () => updateCartQuantity(button.dataset.key, -1);
        });

        dom.cartItems.querySelectorAll('.cart-item-remove').forEach((button) => {
            button.onclick = () => removeCartItem(button.dataset.key);
        });
    }

    function renderCartPage() {
        if (!dom.cartPageBody) {
            return;
        }

        const totals = cartSummary();
        if (state.cart.length === 0) {
            dom.cartPageBody.innerHTML = `
                <tr>
                    <td colspan="4" style="padding: 40px; text-align: center; color: var(--muted-text);">Your shopping bag is empty. Browse the collection to begin.</td>
                </tr>
            `;
        } else {
            dom.cartPageBody.innerHTML = state.cart.map((item) => `
                <tr>
                    <td class="cart-product">
                        <img src="${resolveAsset(item.image)}" alt="${escapeHtml(item.name)}">
                        <div>
                            <h3 class="serif">${escapeHtml(item.name)}</h3>
                            <p class="text-muted small">Size: ${escapeHtml(item.size)} | Color: ${escapeHtml(item.color)}</p>
                            <p class="fw-bold">${formatMoney(item.price)}</p>
                        </div>
                    </td>
                    <td data-label="Quantity">
                        <div class="cart-qty-input-wrapper">
                            <input type="number" value="${item.quantity}" min="1" class="cart-qty-input" data-key="${escapeHtml(item.key)}">
                        </div>
                    </td>
                    <td data-label="Total" class="fw-bold">${formatMoney(item.price * item.quantity)}</td>
                    <td class="text-end">
                        <button class="cart-item-remove-btn" data-key="${escapeHtml(item.key)}"><i class="fa-solid fa-trash-can"></i></button>
                    </td>
                </tr>
            `).join('');
        }

        if (dom.cartPageSubtotal) {
            dom.cartPageSubtotal.textContent = formatMoney(totals.subtotal);
        }

        if (dom.cartPageTotal) {
            dom.cartPageTotal.textContent = formatMoney(totals.total);
        }

        dom.cartPageBody.querySelectorAll('.cart-qty-input').forEach((input) => {
            input.onchange = () => {
                const item = state.cart.find((cartItem) => cartItem.key === input.dataset.key);
                if (!item) {
                    return;
                }

                const nextQuantity = Math.max(1, Number(input.value || 1));
                item.quantity = nextQuantity;
                saveCart();
                renderCart();
                renderCartPage();
                renderCheckoutSummary();
            };
        });

        dom.cartPageBody.querySelectorAll('.cart-item-remove-btn').forEach((button) => {
            button.onclick = () => removeCartItem(button.dataset.key);
        });
    }

    function renderCheckoutSummary() {
        if (!dom.checkoutSummaryList && !dom.checkoutButton) {
            return;
        }

        const totals = cartSummary();

        if (dom.checkoutSummaryList) {
            if (state.cart.length === 0) {
                dom.checkoutSummaryList.innerHTML = '<div class="summary-item"><span>Your bag is empty</span><span>$0.00</span></div>';
            } else {
                dom.checkoutSummaryList.innerHTML = state.cart.map((item) => `
                    <div class="summary-item" style="margin-bottom: 20px;">
                        <div style="display: flex; gap: 15px; align-items: flex-start;">
                            <img src="${resolveAsset(item.image)}" alt="${escapeHtml(item.name)}" style="width: 60px; height: 80px; object-fit: cover; border-radius: 4px;">
                            <div>
                                <p style="font-weight: 600;">${escapeHtml(item.name)}</p>
                                <p class="small text-muted">Size: ${escapeHtml(item.size)} / ${escapeHtml(item.color)}</p>
                                <p class="small text-muted">Qty: ${item.quantity}</p>
                            </div>
                        </div>
                        <span>${formatMoney(item.price * item.quantity)}</span>
                    </div>
                `).join('');
            }
        }

        if (dom.checkoutSubtotalRow) {
            dom.checkoutSubtotalRow.textContent = formatMoney(totals.subtotal);
        }

        if (dom.checkoutShippingRow) {
            dom.checkoutShippingRow.textContent = totals.shipping === 0 ? 'FREE' : formatMoney(totals.shipping);
            dom.checkoutShippingRow.style.color = totals.shipping === 0 ? '#28a745' : 'inherit';
            dom.checkoutShippingRow.style.fontWeight = '600';
        }

        if (dom.checkoutTaxRow) {
            dom.checkoutTaxRow.textContent = formatMoney(totals.tax);
        }

        if (dom.checkoutTotalRow) {
            dom.checkoutTotalRow.textContent = formatMoney(totals.total);
        }

        if (dom.checkoutButton) {
            dom.checkoutButton.disabled = state.cart.length === 0;
            dom.checkoutButton.style.opacity = state.cart.length === 0 ? '0.6' : '1';
            dom.checkoutButton.style.cursor = state.cart.length === 0 ? 'not-allowed' : 'pointer';
            dom.checkoutButton.textContent = state.cart.length === 0 ? 'Add Items to Continue' : 'Complete Purchase';
        }
    }

    function setupCheckoutButton() {
        if (!dom.checkoutButton) {
            return;
        }

        dom.checkoutButton.onclick = async (event) => {
            event.preventDefault();
            if (state.cart.length === 0) {
                showToast('Add items to your bag before checkout', 'error');
                return;
            }

            const payload = buildCheckoutPayload();

            if (!payload.customer.email || !payload.customer.name || !payload.customer.address) {
                showToast('Please complete the checkout form fields', 'error');
                return;
            }

            dom.checkoutButton.disabled = true;
            const originalLabel = dom.checkoutButton.textContent;
            dom.checkoutButton.textContent = 'Processing...';

            try {
                const data = await fetchJson(`${apiBase}/orders.php`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(payload),
                });

                if (!data.success) {
                    throw new Error(data.message || 'Order submission failed');
                }

                state.cart = [];
                saveCart();
                renderCart();
                renderCartPage();
                renderCheckoutSummary();

                const redirectUrl = data.data?.redirectUrl || resolvePath(`user/pages/payment-success.php?order=${encodeURIComponent(data.data?.orderNumber || 'SH-0000')}`);
                window.location.href = redirectUrl;
            } catch (error) {
                showToast(error.message || 'Unable to place the order', 'error');
                dom.checkoutButton.disabled = false;
                dom.checkoutButton.textContent = originalLabel;
            }
        };
    }

    function buildCheckoutPayload() {
        const sections = dom.checkoutSections || [];
        const contactSection = sections[0];
        const shippingSection = sections[1];
        const paymentSection = sections[2];

        const email = contactSection?.querySelector('input[type="email"]')?.value?.trim() || '';
        const shippingInputs = shippingSection ? Array.from(shippingSection.querySelectorAll('input, select')) : [];
        const firstName = shippingInputs[0]?.value?.trim() || '';
        const lastName = shippingInputs[1]?.value?.trim() || '';
        const address = shippingInputs[2]?.value?.trim() || '';
        const apartment = shippingInputs[3]?.value?.trim() || '';
        const city = shippingInputs[4]?.value?.trim() || '';
        const postalCode = shippingInputs[5]?.value?.trim() || '';
        const country = shippingInputs[6]?.value?.trim() || '';

        const paymentMethod = paymentSection?.querySelector('.payment-option.active span')?.textContent?.trim() || 'Card';
        const paymentInputs = paymentSection ? Array.from(paymentSection.querySelectorAll('input[type="text"]')) : [];
        const cardNumber = paymentInputs[0]?.value?.trim() || '';
        const expiry = paymentInputs[1]?.value?.trim() || '';
        const cvc = paymentInputs[2]?.value?.trim() || '';

        const totals = cartSummary();

        return {
            customer: {
                name: `${firstName} ${lastName}`.trim(),
                email,
                phone: '',
                address: apartment ? `${address}, ${apartment}` : address,
                city,
                postalCode,
                country,
            },
            paymentMethod,
            paymentDetails: {
                cardNumber,
                expiry,
                cvc,
            },
            totals,
            items: state.cart.map((item) => ({
                id: item.id,
                name: item.name,
                price: item.price,
                quantity: item.quantity,
                image: item.image,
                size: item.size,
                color: item.color,
            })),
        };
    }

    function setupCartPage() {
        if (!dom.cartPageBody) {
            return;
        }

        renderCartPage();
    }

    async function hydrateProductView() {
        if (!dom.productViewGrid) {
            return;
        }

        const params = new URLSearchParams(window.location.search);
        const requestedId = Number(params.get('id') || state.products[0]?.id || fallbackCatalog[0].id);
        let product = state.products.find((item) => Number(item.id) === requestedId);

        if (!product) {
            try {
                const data = await fetchJson(`${apiBase}/products.php?id=${requestedId}`);
                if (data.success && data.data) {
                    product = data.data;
                }
            } catch (error) {
                product = fallbackCatalog.find((item) => Number(item.id) === requestedId) || fallbackCatalog[0];
            }
        }

        if (!product) {
            return;
        }

        state.activeProduct = product;
        document.title = `${product.name} | Shapehugs`;

        if (dom.productViewBreadcrumb) {
            dom.productViewBreadcrumb.textContent = `Home / ${product.category || 'Shop'} / ${product.badge || 'Collection'}`;
        }

        if (dom.productViewTitle) {
            dom.productViewTitle.textContent = product.name;
        }

        if (dom.productViewPrice) {
            dom.productViewPrice.textContent = formatMoney(product.price);
        }

        if (dom.productViewDescription) {
            dom.productViewDescription.textContent = product.description || '';
        }

        if (dom.productViewMainImage) {
            dom.productViewMainImage.src = resolveAsset(product.image);
            dom.productViewMainImage.alt = product.name;
        }

        if (dom.productViewGallery) {
            const relatedImages = [
                product.image,
                product.secondaryImage,
                fallbackCatalog.find((item) => item.categorySlug === product.categorySlug && Number(item.id) !== Number(product.id))?.image,
                fallbackCatalog.find((item) => Number(item.id) !== Number(product.id))?.secondaryImage,
            ].filter(Boolean).filter((value, index, array) => array.indexOf(value) === index);

            dom.productViewGallery.innerHTML = relatedImages.slice(0, 4).map((image, index) => `
                <img src="${resolveAsset(image)}" alt="${escapeHtml(product.name)} ${index + 1}" class="thumbnail ${index === 0 ? 'active' : ''}">
            `).join('');

            const thumbnails = dom.productViewGallery.querySelectorAll('.thumbnail');
            thumbnails.forEach((thumbnail) => {
                thumbnail.addEventListener('click', () => {
                    thumbnails.forEach((thumb) => thumb.classList.remove('active'));
                    thumbnail.classList.add('active');
                    if (dom.productViewMainImage) {
                        dom.productViewMainImage.src = thumbnail.src;
                    }
                });
            });
        }

        if (dom.addToBagButton) {
            dom.addToBagButton.onclick = (event) => {
                event.preventDefault();
                addToCart({
                    id: product.id,
                    name: product.name,
                    price: product.price,
                    image: product.image,
                    sizes: product.sizes,
                    colors: product.colors,
                    size: product.sizes?.[0] || 'One Size',
                    color: product.colors?.[0] || 'Ivory',
                });
            };
        }

        dom.productViewTabs.forEach((tab) => {
            const header = tab.querySelector('.tab-header');
            const content = tab.querySelector('.tab-content');
            if (header && content) {
                header.style.cursor = 'pointer';
                header.onclick = () => {
                    const currentlyActive = tab.classList.contains('active');
                    dom.productViewTabs.forEach((otherTab) => {
                        otherTab.classList.remove('active');
                        const otherContent = otherTab.querySelector('.tab-content');
                        if (otherContent) {
                            otherContent.style.display = 'none';
                        }
                    });

                    if (!currentlyActive) {
                        tab.classList.add('active');
                        content.style.display = 'block';
                    }
                };
            }
        });

        if (window.gsap) {
            gsap.fromTo('.product-view-grid > *', { opacity: 0, y: 24 }, { opacity: 1, y: 0, duration: 0.8, stagger: 0.12, ease: 'power3.out' });
        }
    }

    function setupTabs() {
        document.querySelectorAll('.tab-item').forEach((tab) => {
            const content = tab.querySelector('.tab-content');
            if (content && !tab.classList.contains('active')) {
                content.style.display = 'none';
            }
        });
    }

    function setupFaq() {
        dom.faqItems.forEach((item) => {
            const question = item.querySelector('.faq-question');
            const answer = item.querySelector('.faq-answer');
            if (!question || !answer) {
                return;
            }

            question.addEventListener('click', () => {
                item.classList.toggle('active');
            });
        });
    }

    function setupChatWidget() {
        if (!dom.chatTrigger || !dom.chatWindow || !dom.chatClose) {
            return;
        }

        dom.chatTrigger.addEventListener('click', () => {
            dom.chatWindow.style.display = dom.chatWindow.style.display === 'flex' ? 'none' : 'flex';
        });

        dom.chatClose.addEventListener('click', () => {
            dom.chatWindow.style.display = 'none';
        });
    }

    function setupNewsletterForms() {
        dom.newsletterForms.forEach((form) => {
            form.addEventListener('submit', async (event) => {
                event.preventDefault();
                const email = form.querySelector('input[type="email"]')?.value?.trim() || '';
                if (!email) {
                    showToast('Enter an email address to subscribe', 'error');
                    return;
                }

                try {
                    const data = await fetchJson(`${apiBase}/newsletter.php`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ email }),
                    });

                    if (data.success) {
                        form.reset();
                        showToast(data.message || 'Subscribed successfully');
                    }
                } catch (error) {
                    showToast(error.message || 'Unable to subscribe', 'error');
                }
            });
        });
    }

    function setupQuickViewModal() {
        if (dom.modalClose && dom.quickViewModal) {
            dom.modalClose.addEventListener('click', closeQuickView);
        }

        if (dom.quickViewModal) {
            dom.quickViewModal.addEventListener('click', (event) => {
                if (event.target === dom.quickViewModal) {
                    closeQuickView();
                }
            });
        }
    }

    function openQuickView(product) {
        if (!dom.quickViewModal || !dom.modalBody) {
            return;
        }

        const source = product.product || findProduct(product.id) || product;
        dom.modalBody.innerHTML = `
            <div class="modal-img-column">
                <img src="${resolveAsset(source.image || product.image)}" alt="${escapeHtml(source.name || product.name)}">
            </div>
            <div class="modal-info-column">
                <span class="text-uppercase letter-spacing-1 small text-muted">Shapehugs Exclusive</span>
                <h2 class="serif">${escapeHtml(source.name || product.name)}</h2>
                <p class="modal-price">${formatMoney(source.price || product.price)}</p>
                <div class="modal-desc">
                    <p>${escapeHtml(source.description || 'Designed for the modern woman, this piece combines romantic European aesthetics with a timeless silhouette.')}</p>
                </div>
                <button class="hero-btn modal-add-to-cart" style="width: 100%; border: none; cursor: pointer;">Add to Bag</button>
                <div style="margin-top:20px; display: flex; flex-direction: column; gap: 10px;">
                    <p class="small text-muted" style="margin: 0;"><i class="fa-solid fa-swatchbook"></i> Size & Fit Guide</p>
                    <a href="${resolvePath(`user/pages/product-view.php?id=${source.id}`)}" class="small" style="color: var(--text-color); font-weight: 600; text-decoration: underline;">View Full Product Details</a>
                </div>
            </div>
        `;

        dom.quickViewModal.classList.add('active');
        document.body.style.overflow = 'hidden';

        const modalAddButton = dom.modalBody.querySelector('.modal-add-to-cart');
        if (modalAddButton) {
            modalAddButton.onclick = () => {
                addToCart({
                    id: source.id,
                    name: source.name,
                    price: source.price,
                    image: source.image,
                    sizes: source.sizes,
                    colors: source.colors,
                });
                closeQuickView();
            };
        }
    }

    function closeQuickView() {
        if (!dom.quickViewModal) {
            return;
        }

        dom.quickViewModal.classList.remove('active');
        document.body.style.overflow = '';
    }

    function setupScrollMotion() {
        if (!window.gsap) {
            return;
        }

        const initialTargets = [
            '.hero-slide.active .hero-content > *',
            '.section-title > *',
            '.benefit-item',
        ];

        initialTargets.forEach((selector) => {
            if (document.querySelector(selector)) {
                gsap.from(selector, {
                    duration: 0.9,
                    opacity: 0,
                    y: 24,
                    stagger: 0.12,
                    ease: 'power3.out',
                });
            }
        });

        if (!window.ScrollTrigger) {
            return;
        }

        const scrollTargets = ['.product-card', '.lookbook-content', '.benefit-item', '.category-card'];
        scrollTargets.forEach((selector) => {
            const elements = gsap.utils.toArray(selector);
            if (elements.length === 0) {
                return;
            }

            gsap.from(elements, {
                opacity: 0,
                y: 28,
                duration: 0.8,
                stagger: 0.1,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: elements[0],
                    start: 'top 85%',
                },
            });
        });
    }

    function animatePage(selector) {
        if (!window.gsap || !document.querySelector(selector)) {
            return;
        }

        gsap.from(selector, {
            duration: 0.8,
            opacity: 0,
            y: 20,
            stagger: 0.08,
            ease: 'power3.out',
        });
    }

    function showToast(message, type = 'success') {
        let toast = document.querySelector('.cart-notification');
        if (!toast) {
            toast = document.createElement('div');
            toast.className = 'cart-notification';
            document.body.appendChild(toast);
        }

        toast.style.borderLeftColor = type === 'error' ? '#d9534f' : '#28a745';
        toast.innerHTML = `${type === 'error' ? '<i class="fa-solid fa-circle-exclamation"></i>' : '<i class="fa-solid fa-circle-check"></i>'} <span>${escapeHtml(message)}</span>`;
        toast.classList.add('active');

        window.clearTimeout(toast._hideTimer);
        toast._hideTimer = window.setTimeout(() => {
            toast.classList.remove('active');
        }, 2600);
    }

    function hydrateProductLinks(scope) {
        scope.querySelectorAll('.product-card').forEach((card) => {
            const link = card.querySelector('.product-name a');
            if (link && card.dataset.id) {
                link.setAttribute('href', resolvePath(`user/pages/product-view.php?id=${card.dataset.id}`));
            }
        });
    }
});
