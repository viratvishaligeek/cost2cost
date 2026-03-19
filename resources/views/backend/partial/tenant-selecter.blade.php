<div class="nav-item-wrapper nav-link label-1">
    @php
        $tenantList = TenantList();
    @endphp
    <small class="text-muted">Working on Site:</small>
    <select name="site_id" id="tenantSelector" class="form-select px-3 py-2 border mt-1">
        <option value="all" {{ is_null(Auth::user()->site_id) ? 'selected' : '' }}>
            All Sites
        </option>
        @foreach ($tenantList as $tenant)
            <option value="{{ $tenant->id }}" {{ Auth::user()->site_id == $tenant->id ? 'selected' : '' }}>
                {{ $tenant->name }}
            </option>
        @endforeach
    </select>
</div>
