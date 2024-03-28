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
                            <form action="{{ route('admin.permissions.update', $permission) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <x-input-label>Role name</x-input-label>
                                <x-text-input name='name' class="w-full" :value="old('name', $permission->name)"></x-text-input>
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />

                                <x-primary-button class="mt-4">Edit</x-primary-button>
                            </form>
                        </div>

                        <div class="mt-6">
                            <h2 class="mb-1 text-lg font-medium text-white title-font">Role Permissions</h2>

                            @if ($permission->roles)
                                <ul>
                                    @foreach ($permission->roles as $role_permission)
                                        <form
                                            action="{{ route('admin.permissions.role.delete', ['permission' => $permission, 'role' => $role_permission->id]) }}"
                                            method='POST'
                                            onsubmit="return confirm('are you sure to revok the permission ?')">
                                            @csrf

                                            <div
                                                class="flex items-center justify-between gap-4 p-2 mb-4 dark:bg-gray-700 ">
                                                <li class="pl-10 font-bold dark:text-red-500 list-item">
                                                    {{ $role_permission->name }}</li>

                                                {{-- detach role  --}}
                                                <x-danger-button>
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                    </svg>

                                                </x-danger-button>
                                            </div>
                                        </form>
                                    @endforeach
                                </ul>
                            @else
                                <small class="leading-relaxed text-green-500">Assign roles to this permission.</small>
                            @endif
                        </div>


                        <div class="mt-6">
                            <form action="{{ route('admin.permissions.role.store', $permission) }}" method="POST">
                                @csrf

                                <h2 class="mb-1 text-lg font-medium text-white title-font">Assign Role</h2>

                                <div class="relative mb-4">
                                    <label for="name" class="text-sm leading-7 text-gray-400">Name</label>

                                    <select name="role" id=""
                                        class="w-full px-3 py-1 text-base leading-8 text-gray-100 transition-colors duration-200 ease-in-out bg-gray-800 border border-gray-700 rounded outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-900">
                                        <option disabled selected>Select a permission...</option>
                                        @forelse ($roles as $key => $name)
                                            <option value="{{ $key }}">{{ $name }}</option>
                                        @empty
                                        @endforelse
                                    </select>

                                    @error('permission')
                                        <span>{{ $message }}</span>
                                    @enderror
                                    <x-input-error :messages="$errors->get('role')" class="mt-2" />


                                    <div class="flex items-center gap-4">
                                        <x-primary-button
                                            class="mt-4 text-white bg-blue-500 dark:text-gray-800 dark:bg-blue-500 dark:hover:bg-blue-600 hover:bg-blue-600">Assign</x-primary-button>
                                        @session('hasOne')
                                            <small class="h-full text-red-500 ">{{ session('hasOne') }}</small>
                                        @endsession
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </section>
            </div>
        </div>
    </div>
</x-admin-layout>
