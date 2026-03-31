@can('choose_tenant')
    <div class="nav-item-wrapper nav-link label-1">
        @php
            $tenantList = TenantList();
        @endphp
        <small class="text-muted">Working on Site:</small>
        <select name="tenant_id" id="tenantSelector" class="form-select px-3 py-2 border mt-1">
            @foreach ($tenantList as $tenant)
                <option value="{{ $tenant->id }}" {{ Auth::user()->tenant_id == $tenant->id ? 'selected' : '' }}>
                    {{ $tenant->name }}
                </option>
            @endforeach
        </select>
    </div>
@endcan
