<div class="py-3 flex gap-3">

    <x-nav-link-outline class="btn-outline-orange" :active="request()->routeIs('super_admin.day.index')"  href="{{ route('super_admin.day.index') }}">
        التقويم
    </x-nav-link-outline>

    <x-nav-link-outline class="btn-outline-orange" :active="request()->routeIs('super_admin.group.index')"  href="{{ route('super_admin.group.index') }}">
    الوفود والمجموعات
    </x-nav-link-outline>

</div>