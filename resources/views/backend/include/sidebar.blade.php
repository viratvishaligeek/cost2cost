<nav class="navbar navbar-vertical navbar-expand-lg">
    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
        <div class="navbar-vertical-content">
            <ul class="navbar-nav flex-column" id="navbarVerticalNav">
                @include('backend.partial.tenant-selecter')
                @foreach (config('sidemenu') as $menu)

                    @php
                        $hasChildren = isset($menu['children']);
                        $permissions = $menu['can'] ?? [];
                        $canView =
                            empty($permissions) ||
                            auth()->user()->can($permissions[0]) ||
                            collect($permissions)->some(fn($p) => auth()->user()->can($p));
                        $menuId = \Illuminate\Support\Str::slug($menu['title'] ?? ($menu['name'] ?? 'menu'));
                    @endphp

                    @if ($canView)
                        {{-- SINGLE MENU --}}
                        @if (!$hasChildren)
                            <div class="nav-item-wrapper">
                                <a class="nav-link label-1 {{ request()->routeIs($menu['active'] ?? '') ? 'active' : '' }}"
                                    href="{{ isset($menu['route']) ? route($menu['route']) : url($menu['url'] ?? '#') }}">

                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-icon">
                                            <span class="{{ $menu['icon'] }}"></span>
                                        </span>

                                        <span class="nav-link-text-wrapper">
                                            <span class="nav-link-text">
                                                {{ $menu['title'] ?? $menu['name'] }}
                                            </span>
                                        </span>
                                    </div>

                                </a>
                            </div>
                        @else
                            {{-- DROPDOWN MENU --}}
                            @php

                                $isParentActive = false;

                                if ($hasChildren) {
                                    foreach ($menu['children'] as $child) {
                                        if (request()->routeIs($child['active'] ?? '')) {
                                            $isParentActive = true;
                                            break;
                                        }
                                    }
                                }
                            @endphp
                            <div class="nav-item-wrapper">
                                <a class="nav-link dropdown-indicator label-1 {{ $isParentActive ? '' : 'collapsed' }}"
                                    href="#{{ $menuId }}" role="button" data-bs-toggle="collapse"
                                    aria-expanded="{{ $isParentActive ? 'true' : 'false' }}">
                                    <div class="d-flex align-items-center">

                                        <div class="dropdown-indicator-icon-wrapper">
                                            <span class="fas fa-caret-right dropdown-indicator-icon"></span>
                                        </div>

                                        <span class="nav-link-icon">
                                            <span class="{{ $menu['icon'] }}"></span>
                                        </span>

                                        <span class="nav-link-text">
                                            {{ $menu['title'] }}
                                        </span>

                                    </div>
                                </a>

                                <div class="parent-wrapper label-1">
                                    <ul class="nav collapse parent {{ $isParentActive ? 'show' : '' }}"
                                        data-bs-parent="#navbarVerticalCollapse" id="{{ $menuId }}">
                                        <li class="collapsed-nav-item-title d-none">
                                            {{ $menu['title'] }}
                                        </li>

                                        @foreach ($menu['children'] as $child)
                                            @php
                                                $childCan = $child['can'] ?? [];
                                                $canChild =
                                                    empty($childCan) ||
                                                    collect($childCan)->some(fn($p) => auth()->user()->can($p));
                                            @endphp

                                            @if ($canChild)
                                                <li class="nav-item">
                                                    <a class="nav-link {{ request()->routeIs($child['active'] ?? '') ? 'active' : '' }}"
                                                        href="{{ isset($child['route']) ? route($child['route'], $child['params'] ?? []) : url($child['url'] ?? '#') }}">

                                                        <div class="d-flex align-items-center">
                                                            <span class="nav-link-text">
                                                                {{ $child['name'] }}
                                                            </span>
                                                        </div>

                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach

                                    </ul>
                                </div>
                            </div>
                        @endif
                    @endif

                @endforeach
            </ul>
        </div>
    </div>
    <div class="navbar-vertical-footer">
        <button
            class="btn navbar-vertical-toggle border-0 fw-semibold w-100 white-space-nowrap d-flex align-items-center">
            <span class="uil uil-left-arrow-to-left fs-8">
            </span>
            <span class="uil uil-arrow-from-right fs-8">
            </span>
            <span class="navbar-vertical-footer-text ms-2">Collapsed View</span>
        </button>
    </div>
</nav>
