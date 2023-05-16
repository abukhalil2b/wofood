<div class="">

    <div class="p-1 w-12 border rounded border-orange-400 bg-orange-50 text-xs cursor-pointer" x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
        + مهمة 
    </div>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form x-data="{ expected_duration: '' }" method="post" action="{{ route('task.for_my_team.store') }}" class="p-3 text-[#035b62]">
            @csrf

            <div class="text-orange-400">
                {{ $user->name }}
            </div>
            <div class="mt-6">
                المهمة
                <x-text-input type="text" name="title" class="mt-1 block w-full" placeholder="المهمة" />
            </div>

            <div class="mt-6">
                تاريخ بدء المهمة
                <x-text-input type="date" name="due_date" class="mt-1 block w-full" value="{{ date('Y-m-d') }}" />
            </div>

            <div class="mt-6 border p-1 rounded">
                <div>
                    الوقت المتوقع لإنجاز المهمة:
                    <input class="mt-1 border rounded" x-model="expected_duration">
                </div>
                <div class="mt-2 w-full grid grid-cols-3 md:grid-cols-8 gap-1">
                    <div @click=" expected_duration = 'نص ساعة' " class="option">
                        نص ساعة
                    </div>
                    <div @click=" expected_duration = 'ساعة' " class="option">
                        ساعة
                    </div>
                    <div @click=" expected_duration = 'ساعتين' " class="option">
                        ساعتين
                    </div>
                    <div @click=" expected_duration = 'ثلاث ساعات' " class="option">
                        ثلاث ساعات
                    </div>
                    <div @click=" expected_duration = 'أربع ساعات' " class="option">
                        أربع ساعات
                    </div>
                    <div @click=" expected_duration = 'خمس ساعات' " class="option">
                        خمس ساعات
                    </div>
                    <div @click=" expected_duration = 'ست ساعات' " class="option">
                        ست ساعات
                    </div>
                    <div @click=" expected_duration = '' " class="option">
                    </div>
                </div>
            </div>

            <div class="mt-6 flex justify-between">
                <x-secondary-button x-on:click="$dispatch('close')" class="w-14">
                    إلغ
                </x-secondary-button>

                <x-primary-button class="ml-3 w-14">
                    حفظ
                </x-primary-button>
            </div>
            <input type="hidden" value="{{ $user->id }}" name="assign_for_id">

        </form>
    </x-modal>
</div>