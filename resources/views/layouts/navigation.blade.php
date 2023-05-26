<nav x-data="{ open: false }" class="bg-[#032a38] border-b border-black">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex gap-2">
            <img src="{{asset('logo.png')}}" alt="logo" width="30">
            <!-- Hamburger -->
            <div class="-mr-2 flex items-center">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-[#ffb031] hover:text-gray-500 hover:bg-[#ffb031] focus:outline-none focus:bg-[#ffb031] focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            </div>
            <div class="text-[#ffb031]">
                {{ Auth::user()->name }}
                <div class="text-[#ffb031] text-xs">{{ __(Auth::user()->user_type) }}</div>
            </div>

        </div>



        <div :class="{'block': open, 'hidden': ! open}" class="hidden">
            <div class="pt-2 pb-3 space-y-1 text-sm ">

                @if(auth()->user()->user_type == 'super_admin')
                <x-responsive-nav-link :href="route('super_admin.group.index')" :active="request()->routeIs('super_admin.group.index')">
                    إدارة الوفود والمجموعات
                </x-responsive-nav-link>
                @endif

                @if(auth()->user()->user_type == 'super_admin')
                <x-responsive-nav-link :href="route('super_admin.day.index')" :active="request()->routeIs('super_admin.day.index')">
                    إعداد جدول المهام
                </x-responsive-nav-link>
                @endif

                @if(auth()->user()->user_type == 'super_admin')
                <x-responsive-nav-link :href="route('super_admin.user.orderby_task_count')" :active="request()->routeIs('super_admin.user.orderby_task_count')">
                    ترتيب الأعضاء حسب المهام
                </x-responsive-nav-link>
                @endif

                @if(auth()->user()->user_type == 'super_admin' || auth()->user()->user_type == 'admin')
                <x-responsive-nav-link :href="route('user.today.tasks')" :active="request()->routeIs('user.today.tasks')">
                   مهام كل الأعضاء لهذا اليوم
                </x-responsive-nav-link>
                @endif


                @if(auth()->user()->user_type == 'super_admin' || auth()->user()->user_type == 'admin')
                <x-responsive-nav-link :href="route('user.late.tasks')" :active="request()->routeIs('user.late.tasks')">
                   مهام كل الأعضاء المتأخرة
                </x-responsive-nav-link>
                @endif

                @if(auth()->user()->user_type == 'super_admin' || auth()->user()->user_type == 'admin')
                <x-responsive-nav-link :href="route('user.today.subtasks')" :active="request()->routeIs('user.today.subtasks')">
                تعليقات كل الأعضاء لهذا اليوم
                </x-responsive-nav-link>
                @endif

                @if(auth()->user()->user_type == 'super_admin' || auth()->user()->user_type == 'admin')
                <x-responsive-nav-link :href="route('user.index')" :active="request()->routeIs('user.index')">
                    جدول مهام الأعضاء (إضافة مهمة)
                </x-responsive-nav-link>
                @endif

                <x-responsive-nav-link :href="route('day.index')" :active="request()->routeIs('day.index')">
                جدول مهامي (إضافة مهمة)
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    الرئيسية
                </x-responsive-nav-link>

            </div>


            <div class="p-3 flex justify-between">
                <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-4 py-2 border rounded text-orange-500 border-orange-500 hover:bg-orange-100">الملف الشخصي</a>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-danger-button>
                        تسجيل الخروج
                    </x-danger-button>
                </form>
            </div>
        </div>

    </div>
</nav>