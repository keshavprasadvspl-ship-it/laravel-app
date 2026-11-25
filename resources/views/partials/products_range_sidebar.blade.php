@php
    $menuData = cache()->remember('bellows_sidebar_menu_data_v2', 86400, function () {
        $jsonPath = database_path('data/bellows_sidebar_menu.json');
        if (file_exists($jsonPath)) {
            return json_decode(file_get_contents($jsonPath), true) ?: [];
        }
        return [];
    });

    $activeTargetSlug = trim($currentSlug ?? ($product->slug ?? ($category->slug ?? '')));
    $activeTargetSlug = trim($activeTargetSlug, '/');

    // 1. Direct and normalized slug resolution (handles country landing pages & aliases)
    $normSlug = preg_replace('/-manufacturers?-(?:exporters-suppliers-)?in-.*$/', '', $activeTargetSlug);
    $normSlug = preg_replace('/-manufacturer-.*$/', '', $normSlug);
    $normSlug = preg_replace('/-supplier-in-.*$/', '', $normSlug);
    $normSlug = preg_replace('/-in-.*$/', '', $normSlug);

    $openCatSlugs = [];
    $openSubSlugs = [];

    // Find direct matches in menuData
    foreach ($menuData as $catKey => $cat) {
        if ($cat['slug'] === $activeTargetSlug || $cat['slug'] === $normSlug) {
            $openCatSlugs[] = $cat['slug'];
        }
        foreach ($cat['children'] as $subKey => $sub) {
            if ($sub['slug'] === $activeTargetSlug || $sub['slug'] === $normSlug) {
                $openCatSlugs[] = $cat['slug'];
                $openSubSlugs[] = $sub['slug'];
            }
            foreach ($sub['products'] as $prod) {
                if ($prod['slug'] === $activeTargetSlug || $prod['slug'] === $normSlug) {
                    $openCatSlugs[] = $cat['slug'];
                    $openSubSlugs[] = $sub['slug'];
                    break 2;
                }
            }
        }
    }

    // Secondary fallback: if viewing a Product instance, resolve via primary category
    if (empty($openSubSlugs) && isset($product) && $product instanceof \App\Models\Product) {
        $primaryCat = $product->primary_category ?: $product->categories->first();
        if ($primaryCat) {
            foreach ($menuData as $catKey => $c) {
                foreach ($c['children'] as $subKey => $s) {
                    if ($s['slug'] === $primaryCat->slug) {
                        $openCatSlugs[] = $c['slug'];
                        $openSubSlugs[] = $s['slug'];
                        break 2;
                    }
                }
            }
        }
    }

    // Secondary fallback: if viewing a Category instance with parent
    if (empty($openSubSlugs) && isset($category) && $category instanceof \App\Models\Category) {
        foreach ($menuData as $catKey => $c) {
            foreach ($c['children'] as $subKey => $s) {
                if ($s['slug'] === $category->slug) {
                    $openCatSlugs[] = $c['slug'];
                    $openSubSlugs[] = $s['slug'];
                    break 2;
                }
            }
        }
    }

    // Tertiary fallback: prefix / substring matching (for subcategory variants)
    if (empty($openSubSlugs)) {
        foreach ($menuData as $catKey => $c) {
            foreach ($c['children'] as $subKey => $s) {
                if (str_starts_with($activeTargetSlug, $s['slug']) || str_starts_with($normSlug, $s['slug'])) {
                    $openCatSlugs[] = $c['slug'];
                    $openSubSlugs[] = $s['slug'];
                    break 2;
                }
            }
        }
    }

    // Default open Dyes if dyes-related
    if (empty($openCatSlugs)) {
        if (str_contains($activeTargetSlug, 'dye')) {
            $openCatSlugs[] = 'dyes';
        } elseif (str_contains($activeTargetSlug, 'pigment')) {
            $openCatSlugs[] = 'pigments';
        } elseif (str_contains($activeTargetSlug, 'colour') || str_contains($activeTargetSlug, 'f-d-c')) {
            $openCatSlugs[] = 'f-d-c-colours';
        } else {
            $openCatSlugs[] = 'dyes';
        }
    }
@endphp

<style>
    /* ==========================================================================
       SD International - PRODUCTS RANGE Bellows Accordion Menu
       Matching sdinternational.com 1:1 with nested subcategory products
       ========================================================================== */
    .bellows-products-range-sidebar {
        margin-bottom: 25px;
        font-family: 'Poppins', sans-serif;
    }

    .bellows-sidebar-header {
        background-color: #73001B !important;
        background-image: linear-gradient(180deg, #941533 0%, #74001B 100%) !important;
        color: #ffffff !important;
        padding: 12px 18px !important;
        font-family: 'Poppins', sans-serif !important;
        font-size: 16.5px !important;
        font-weight: 700 !important;
        text-transform: uppercase !important;
        border-radius: 4px 4px 0 0 !important;
        letter-spacing: 0.5px !important;
        line-height: 1.3 !important;
        margin: 0 !important;
    }

    .bellows-sidebar-card {
        background: #ffffff !important;
        border: 1px solid #e5e7eb !important;
        border-top: none !important;
        border-radius: 0 0 4px 4px !important;
        overflow: hidden !important;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04) !important;
    }

    .bellows-tree-root {
        list-style: none !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    .bellows-tree-item {
        list-style: none !important;
        margin: 0 !important;
        padding: 0 !important;
        border-bottom: 1px solid #f1f5f9 !important;
    }

    .bellows-tree-item:last-child {
        border-bottom: none !important;
    }

    /* Level 0: Main Categories (DYES, F D & C COLOURS, PIGMENTS, OTHER PRODUCTS) */
    .bellows-header-row {
        display: flex !important;
        align-items: center !important;
        gap: 10px !important;
        padding: 12px 16px !important;
        font-family: 'Poppins', sans-serif !important;
        font-size: 14.5px !important;
        font-weight: 600 !important;
        color: #1e293b !important;
        cursor: pointer !important;
        background: #ffffff !important;
        transition: background 0.15s ease, color 0.15s ease !important;
        user-select: none !important;
    }

    .bellows-header-row:hover {
        background: #f8fafc !important;
        color: #73001B !important;
    }

    .bellows-header-row.open {
        background: #ffffff !important;
        color: #73001B !important;
        border-bottom: 1px solid #f1f5f9 !important;
    }

    .bellows-title-link {
        color: inherit !important;
        text-decoration: none !important;
        flex: 1 !important;
        font-weight: 600 !important;
        font-size: 14.5px !important;
    }

    .bellows-title-link:hover {
        color: #73001B !important;
        text-decoration: none !important;
    }

    /* Chevron rotation: pointing right '>' closed, pointing up '^' open */
    .bellows-chevron {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 16px !important;
        height: 16px !important;
        color: #64748b !important;
        transition: transform 0.2s ease, color 0.15s ease !important;
        flex-shrink: 0 !important;
    }

    .bellows-chevron.open,
    .bellows-header-row.open .bellows-chevron {
        transform: rotate(-90deg) !important;
        color: #73001B !important;
    }

    /* Level 1: Subcategories Tree */
    .bellows-sub-tree {
        list-style: none !important;
        margin: 0 !important;
        padding: 0 !important;
        background: #ffffff !important;
    }

    .bellows-sub-item {
        list-style: none !important;
        margin: 0 !important;
        padding: 0 !important;
        border-bottom: 1px solid #f8fafc !important;
    }

    .bellows-sub-item:last-child {
        border-bottom: none !important;
    }

    .bellows-sub-header {
        display: flex !important;
        align-items: center !important;
        gap: 8px !important;
        padding: 8px 16px 8px 24px !important;
        font-family: 'Poppins', sans-serif !important;
        font-size: 13.5px !important;
        font-weight: 500 !important;
        color: #334155 !important;
        cursor: pointer !important;
        transition: background 0.15s ease, color 0.15s ease, border-left 0.15s ease !important;
        user-select: none !important;
        background: #ffffff !important;
    }

    .bellows-sub-header:hover {
        background: #f8fafc !important;
        color: #73001B !important;
    }

    .bellows-sub-header.open {
        color: #73001B !important;
        font-weight: 600 !important;
    }

    /* Active Subcategory: matching sdinternational.com 1:1 (Pink background + Red vertical left border) */
    .bellows-sub-item.active .bellows-sub-header,
    .bellows-sub-header.active {
        background: #fff5f5 !important;
        border-left: 4px solid #73001B !important;
        padding-left: 20px !important;
        color: #73001B !important;
        font-weight: 600 !important;
    }

    .bellows-sub-header.no-children {
        padding-left: 36px !important;
    }

    .bellows-sub-item.active .bellows-sub-header.no-children {
        padding-left: 32px !important;
    }

    .bellows-sub-chevron {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 14px !important;
        height: 14px !important;
        color: #94a3b8 !important;
        transition: transform 0.2s ease, color 0.15s ease !important;
        flex-shrink: 0 !important;
    }

    .bellows-sub-chevron.open,
    .bellows-sub-header.open .bellows-sub-chevron,
    .bellows-sub-item.active .bellows-sub-chevron {
        transform: rotate(-90deg) !important;
        color: #73001B !important;
    }

    .bellows-sub-link {
        color: inherit !important;
        text-decoration: none !important;
        flex: 1 !important;
        transition: color 0.15s ease !important;
        font-size: 13.5px !important;
    }

    .bellows-sub-link:hover {
        color: #73001B !important;
        text-decoration: none !important;
    }

    .bellows-sub-link.active,
    .bellows-sub-item.active .bellows-sub-link {
        color: #73001B !important;
        font-weight: 600 !important;
    }

    /* Level 2: Products under Subcategory */
    .bellows-product-tree {
        list-style: none !important;
        margin: 0 !important;
        padding: 4px 0 6px 0 !important;
        background: #fafbfc !important;
        border-top: 1px solid #f1f5f9 !important;
        border-bottom: 1px solid #f1f5f9 !important;
    }

    .bellows-prod-item {
        list-style: none !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    .bellows-prod-link {
        display: block !important;
        padding: 6px 16px 6px 40px !important;
        font-family: 'Poppins', sans-serif !important;
        font-size: 13px !important;
        line-height: 1.45 !important;
        color: #475569 !important;
        text-decoration: none !important;
        transition: color 0.15s ease, background 0.15s ease !important;
    }

    .bellows-prod-link:hover {
        color: #73001B !important;
        background: #fdf2f2 !important;
        text-decoration: none !important;
    }

    .bellows-prod-link.active {
        color: #73001B !important;
        font-weight: 700 !important;
        background: #ffe4e6 !important;
        border-left: 3px solid #73001B !important;
        padding-left: 37px !important;
    }
</style>

<aside class="bellows-products-range-sidebar">
    <div class="bellows-sidebar-header">
        PRODUCTS RANGE
    </div>
    <div class="bellows-sidebar-card">
        <ul class="bellows-tree-root">
            @foreach($menuData as $catKey => $cat)
                @php
                    $catId = 'bellows-cat-' . \Illuminate\Support\Str::slug($cat['slug']);
                    $isCatOpen = in_array($cat['slug'], $openCatSlugs);
                @endphp
                <li class="bellows-tree-item">
                    <div class="bellows-header-row {{ $isCatOpen ? 'open' : '' }}" onclick="toggleBellowsMenu('{{ $catId }}', this, event)">
                        <span class="bellows-chevron {{ $isCatOpen ? 'open' : '' }}">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </span>
                        <a href="{{ slash_url('/' . $cat['slug']) }}" class="bellows-title-link" onclick="event.stopPropagation()">
                            {{ $catKey }}
                        </a>
                    </div>

                    <ul id="{{ $catId }}" class="bellows-sub-tree" style="display: {{ $isCatOpen ? 'block' : 'none' }};">
                        @foreach($cat['children'] as $subKey => $sub)
                            @php
                                $hasProducts = !empty($sub['products']);
                                $subId = 'bellows-sub-' . \Illuminate\Support\Str::slug($sub['slug']);
                                $isSubOpen = in_array($sub['slug'], $openSubSlugs);
                                $isSubActive = ($activeTargetSlug === $sub['slug'] || $normSlug === $sub['slug']);
                            @endphp
                            <li class="bellows-sub-item {{ $isSubActive ? 'active' : '' }}">
                                @if($hasProducts)
                                    <div class="bellows-sub-header {{ ($isSubOpen || $isSubActive) ? 'open' : '' }} {{ $isSubActive ? 'active' : '' }}" onclick="toggleBellowsMenu('{{ $subId }}', this, event)">
                                        <span class="bellows-sub-chevron {{ ($isSubOpen || $isSubActive) ? 'open' : '' }}">
                                            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                <polyline points="9 18 15 12 9 6"></polyline>
                                            </svg>
                                        </span>
                                        <a href="{{ slash_url('/' . $sub['slug']) }}" class="bellows-sub-link {{ $isSubActive ? 'active' : '' }}" onclick="event.stopPropagation()">
                                            {{ $subKey }}
                                        </a>
                                    </div>

                                    <ul id="{{ $subId }}" class="bellows-product-tree" style="display: {{ ($isSubOpen || $isSubActive) ? 'block' : 'none' }};">
                                        @foreach($sub['products'] as $prod)
                                            @php
                                                $isProdActive = ($activeTargetSlug === $prod['slug'] || $normSlug === $prod['slug']);
                                            @endphp
                                            <li class="bellows-prod-item">
                                                <a href="{{ slash_url('/' . $prod['slug']) }}" class="bellows-prod-link {{ $isProdActive ? 'active' : '' }}" title="{{ $prod['name'] }}">
                                                    {{ $prod['name'] }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <div class="bellows-sub-header no-children {{ $isSubActive ? 'active' : '' }}">
                                        <a href="{{ slash_url('/' . $sub['slug']) }}" class="bellows-sub-link {{ $isSubActive ? 'active' : '' }}">
                                            {{ $subKey }}
                                        </a>
                                    </div>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>
</aside>

<script>
    if (typeof window.toggleBellowsMenu !== 'function') {
        window.toggleBellowsMenu = function(targetId, headerEl, event) {
            if (event) {
                event.stopPropagation();
            }
            const list = document.getElementById(targetId);
            if (!list) return;

            const isCurrentlyHidden = (list.style.display === 'none' || list.style.display === '');
            list.style.display = isCurrentlyHidden ? 'block' : 'none';

            const chevron = headerEl.querySelector('.bellows-chevron, .bellows-sub-chevron');
            if (chevron) {
                if (isCurrentlyHidden) {
                    chevron.classList.add('open');
                    headerEl.classList.add('open');
                } else {
                    chevron.classList.remove('open');
                    headerEl.classList.remove('open');
                }
            }
        };
    }
</script>
