<ul class="nav nav-underline optionChainTableHeader gap-0 flex-nowrap scrollbar mb-4" id="productTab">

    {{-- GENERAL --}}
    <li class="nav-item">
        <a class="nav-link pt-0 text-nowrap ps-0 pe-3
            {{ request()->routeIs('admin.product.edit') ? 'active' : '' }}"
            href="{{ route('admin.product.edit', encrypt($data->id)) }}">
            General Information
        </a>
    </li>

    {{-- VARIANTS --}}
    @if ($data->has_variation == 'yes')
        @foreach ($data->variants as $item)
            <li class="nav-item">
                <a class="nav-link pt-0 text-nowrap px-3
                    {{ request()->routeIs('admin.variant.edit') && request()->route('id') == encrypt($item->id) ? 'active' : '' }}"
                    href="{{ route('admin.variant.edit', encrypt($item->id)) }}">
                    {{ $item->combo }}
                </a>
            </li>
        @endforeach
    @endif

    {{-- FAQ --}}
    <li class="nav-item">
        <a class="nav-link pt-0 text-nowrap px-3
            {{ request()->routeIs('admin.product.get-faqs') ? 'active' : '' }}"
            href="{{ route('admin.product.get-faqs', encrypt($data->id)) }}">
            Product FAQ
        </a>
    </li>

</ul>
