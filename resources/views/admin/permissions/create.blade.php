<x-admin-layout>
    <div class="w-full p-2 py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">

                <section class="py-1 bg-blueGray-50">
                    <div class="w-full px-4 mx-auto mt-24 xl:w-8/12 xl:mb-0">
                        <div
                            class="relative flex w-full min-w-0 p-4 mb-6 break-words bg-white rounded shadow-lg dark:text-slate-200 dark:bg-gray-700 ">
                            <x-create-button href="{{ route('admin.permissions.index') }}">Back ro
                                permissions</x-create-button>
                        </div>

                        <div class="block w-full mb-12 overflow-x-auto dark:text-slate-200">
                            <form action="{{ route('admin.permissions.store') }}" method="POST">
                                @csrf
                                <x-input-label>Permission name</x-input-label>
                                <x-text-input name='name' class="w-full"></x-text-input>
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />

                                <x-primary-button class="mt-4">Create</x-primary-button>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-admin-layout>
