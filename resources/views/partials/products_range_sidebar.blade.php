@php
    $menuData = cache()->rememberForever('bellows_sidebar_menu_data', function () {
        $jsonPath = database_path('data/bellows_sidebar_menu.json');
        if (file_exists($jsonPath)) {
            return json_decode(file_get_contents($jsonPath), true) ?: [];
        }
        return [];
    });

    $activeTargetSlug = $currentSlug ?? ($product->slug ?? ($category->slug ?? ''));

    // Automatically determine which Category and Subcategory must be open
    $openCatSlugs = [];
    $openSubSlugs = [];

    foreach ($menuData as $catKey => $cat) {
        if ($cat['slug'] === $activeTargetSlug) {
            $openCatSlugs[] = $cat['slug'];
        }
        foreach ($cat['children'] as $subKey => $sub) {
            if ($sub['slug'] === $activeTargetSlug) {
                $openCatSlugs[] = $cat['slug'];
                $openSubSlugs[] = $sub['slug'];
            }
            foreach ($sub['products'] as $prod) {
                if ($prod['slug'] === $activeTargetSlug) {
                    $openCatSlugs[] = $cat['slug'];
                    $openSubSlugs[] = $sub['slug'];
                    break 2;
                }
            }
        }
    }

    // Default open Dyes if on dyes-related URL
    if (empty($openCatSlugs)) {
        if (str_contains($activeTargetSlug, 'dyes') || str_contains($activeTargetSlug, 'dye')) {
            $openCatSlugs[] = 'dyes';
        } elseif (str_contains($activeTargetSlug, 'pigment')) {
            $openCatSlugs[] = 'pigments';
        } elseif (str_contains($activeTargetSlug, 'f-d-c') || str_contains($activeTargetSlug, 'colour')) {
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
    .bellows-sidebar-header {
        background-image: linear-gradient(180deg, #941533 0%, #74001B 100%);
        color: #ffffff;
        padding: 13px 18px;
        font-family: 'Poppins', sans-serif;
        font-size: 16.5px;
        font-weight: 700;
        text-transform: uppercase;
        border-radius: 4px 4px 0 0;
        letter-spacing: 0.5px;
    }

    .bellows-sidebar-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-top: none;
        border-radius: 0 0 4px 4px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    .bellows-tree-root {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .bellows-tree-item {
        border-bottom: 1px solid #f1f5f9;
    }

    .bellows-tree-item:last-child {
        border-bottom: none;
    }

    /* Level 0: Main Categories */
    .bellows-header-row {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 11px 16px;
        font-family: 'Poppins', sans-serif;
        font-size: 14.5px;
        font-weight: 600;
        color: #1e293b;
        cursor: pointer;
        background: #ffffff;
        transition: background 0.15s ease, color 0.15s ease;
        user-select: none;
    }

    .bellows-header-row:hover {
        background: #f8fafc;
        color: #73001B;
    }

    .bellows-header-row.open {
        background: #fafafa;
        color: #73001B;
    }

    .bellows-title-link {
        color: inherit;
        text-decoration: none;
        flex: 1;
        font-weight: 600;
    }

    .bellows-title-link:hover {
        color: #73001B;
        text-decoration: none;
    }

    .bellows-chevron {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 16px;
        height: 16px;
        color: #64748b;
        transition: transform 0.2s ease, color 0.15s ease;
    }

    .bellows-chevron.open,
    .bellows-header-row.open .bellows-chevron {
        transform: rotate(180deg);
        color: #73001B;
    }

    /* Level 1: Subcategories */
    .bellows-sub-tree {
        list-style: none;
        margin: 0;
        padding: 4px 0 6px 0;
        background: #fbfcfd;
        border-top: 1px solid #f1f5f9;
    }

    .bellows-sub-item {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .bellows-sub-header {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px 8px 24px;
        font-family: 'Poppins', sans-serif;
        font-size: 13.5px;
        font-weight: 500;
        color: #334155;
        cursor: pointer;
        transition: background 0.15s ease, color 0.15s ease;
        user-select: none;
    }

    .bellows-sub-header:hover {
        background: #f1f5f9;
        color: #73001B;
    }

    .bellows-sub-header.open {
        color: #73001B;
        font-weight: 600;
    }

    .bellows-sub-header.no-children {
        padding-left: 36px;
    }

    .bellows-sub-chevron {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 14px;
        height: 14px;
        color: #94a3b8;
        transition: transform 0.2s ease, color 0.15s ease;
    }

    .bellows-sub-chevron.open,
    .bellows-sub-header.open .bellows-sub-chevron {
        transform: rotate(180deg);
        color: #73001B;
    }

    .bellows-sub-link {
        color: inherit;
        text-decoration: none;
        flex: 1;
        transition: color 0.15s ease;
    }

    .bellows-sub-link:hover {
        color: #73001B;
        text-decoration: none;
    }

    .bellows-sub-link.active {
        color: #73001B !important;
        font-weight: 700 !important;
    }

    /* Level 2: Products under Subcategory */
    .bellows-product-tree {
        list-style: none;
        margin: 2px 0 6px 36px;
        padding: 2px 0 4px 0;
        border-left: 2px solid #e2e8f0;
    }

    .bellows-prod-item {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .bellows-prod-link {
        display: block;
        padding: 5px 12px 5px 14px;
        font-family: 'Poppins', sans-serif;
        font-size: 12.5px;
        line-height: 1.45;
        color: #64748b;
        text-decoration: none;
        transition: color 0.15s ease, background 0.15s ease;
        border-radius: 0 3px 3px 0;
    }

    .bellows-prod-link:hover {
        color: #73001B;
        background: #fdf2f2;
        text-decoration: none;
    }

    .bellows-prod-link.active {
        color: #73001B !important;
        font-weight: 700 !important;
        background: #ffe4e6 !important;
        border-left: 3px solid #73001B;
        padding-left: 11px;
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
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </span>
                        <a href="{{ url('/' . $cat['slug']) }}" class="bellows-title-link" onclick="event.stopPropagation()">
                            {{ $catKey }}
                        </a>
                    </div>

                    <ul id="{{ $catId }}" class="bellows-sub-tree" style="display: {{ $isCatOpen ? 'block' : 'none' }};">
                        @foreach($cat['children'] as $subKey => $sub)
                            @php
                                $hasProducts = !empty($sub['products']);
                                $subId = 'bellows-sub-' . \Illuminate\Support\Str::slug($sub['slug']);
                                $isSubOpen = in_array($sub['slug'], $openSubSlugs);
                                $isSubActive = ($activeTargetSlug === $sub['slug']);
                            @endphp
                            <li class="bellows-sub-item {{ $isSubActive ? 'active' : '' }}">
                                @if($hasProducts)
                                    <div class="bellows-sub-header {{ $isSubOpen ? 'open' : '' }}" onclick="toggleBellowsMenu('{{ $subId }}', this, event)">
                                        <span class="bellows-sub-chevron {{ $isSubOpen ? 'open' : '' }}">
                                            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                <polyline points="6 9 12 15 18 9"></polyline>
                                            </svg>
                                        </span>
                                        <a href="{{ url('/' . $sub['slug']) }}" class="bellows-sub-link {{ $isSubActive ? 'active' : '' }}" onclick="event.stopPropagation()">
                                            {{ $subKey }}
                                        </a>
                                    </div>

                                    <ul id="{{ $subId }}" class="bellows-product-tree" style="display: {{ $isSubOpen ? 'block' : 'none' }};">
                                        @foreach($sub['products'] as $prod)
                                            @php
                                                $isProdActive = ($activeTargetSlug === $prod['slug']);
                                            @endphp
                                            <li class="bellows-prod-item">
                                                <a href="{{ url('/' . $prod['slug']) }}" class="bellows-prod-link {{ $isProdActive ? 'active' : '' }}" title="{{ $prod['name'] }}">
                                                    {{ $prod['name'] }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <div class="bellows-sub-header no-children">
                                        <a href="{{ url('/' . $sub['slug']) }}" class="bellows-sub-link {{ $isSubActive ? 'active' : '' }}">
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
