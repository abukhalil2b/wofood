<div class="mt-1 space-y-6">


    <x-primary-button class="w-16" x-data="" x-on:click.prevent="$dispatch('open-modal', 'update_day')">
        تعديل
    </x-primary-button>

    <x-modal name="update_day" :show="$errors->any()" focusable>
        <div class="mt-1 w-full text-center">
            التاريخ
        </div>
        <form method="post" action="{{ route('super_admin.day.update',$day->id) }}" class="p-2 text-[#035b62]">
            @csrf

            <div class="mt-6 flex items-center gap-1">
                <div class="text-xs w-64">
                   اليوم
                </div>
                <x-text-input type="text" name="title" class="mt-1 block w-full" value="{{ $day->title }}" />
            </div>

            <div class="mt-6 flex items-center gap-1">
                <div class="text-xs w-64">
                    العربي: مثلا (25 ذي القعدة)
                </div>
                <x-text-input type="text" name="ar_date" class="mt-1 block w-full" value="{{ $day->ar_date }}" />
            </div>

            <div class="mt-6 flex items-center gap-1">
                <div class="text-xs w-64">
                    الإنجليزي
                </div>
                <x-text-input type="date" name="en_date" class="mt-1 block w-full" value="{{ $day->en_date }}" />
            </div>


            <div class="mt-6 flex justify-between">
                <x-secondary-button x-on:click="$dispatch('close')" class="w-14">
                    إلغ
                </x-secondary-button>

                <x-primary-button class="ml-3 w-14">
                    تحديث
                </x-primary-button>
            </div>


        </form>
    </x-modal>
</div>