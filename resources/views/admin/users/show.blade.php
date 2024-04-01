<x-admin-layout>

    <div class="relative max-w-5xl p-4 mx-auto overflow-x-auto rounded-lg sm:p-6">

        <header
            class="flex items-center justify-between w-full p-4 mb-4 text-gray-900 rounded-lg shadow-sm bg-slate-100 dark:bg-gray-800 dark:text-slate-100">
            <h1 class="font-bold text-gray-900 dark:text-slate-100">{{ $user->name }}</h1>

        </header>



        {{-- user infos --}}
        <div class="p-5 mb-4 bg-gray-100 border border-gray-100 rounded-lg dark:bg-gray-800 dark:border-gray-700">
            <h1 class="flex items-center gap-4 text-lg font-semibold text-gray-900 dark:text-white">
                <span>
                    {{ $user->roles()->first()->name }}
                </span>
            </h1>


            <div class="mt-3 divide-y divider-gray-200 dark:divide-gray-700">
                <div class="text-gray-600 dark:text-gray-400">
                    <div class="text-base font-normal"><span class="font-medium text-gray-900 dark:text-white">
                            <span class="font-light text-gray-900 dark:text-white">
                                {{ $user->email }}
                            </span>
                    </div>
                    </ol>
                </div>
            </div>

        </div>

        <div class="p-5 mb-4 bg-gray-100 border border-gray-100 rounded-lg dark:bg-gray-800 dark:border-gray-700">
            {{-- roles  --}}
            <div class="mt-6 ">
                <h2 class="mb-1 text-lg font-medium text-gray-900 dark:text-white title-font">Roles</h2>

                @if ($user->roles)
                    <ul class="px-4 bg-gray-200 rounded-lg dark:bg-gray-700 ">
                        @foreach ($user->roles as $role_permission)
                            <form
                                action="{{ route('admin.users.role.delete', ['user' => $user, 'role' => $role_permission->id]) }}"
                                method='POST' onsubmit="return confirm('are you sure to revoke the role ?')">
                                @csrf

                                <div class="flex items-center justify-between gap-4 p-2 mb-4 ">
                                    <li class="pl-10 font-bold dark:text-red-500 list-item">
                                        {{ $role_permission->name }}</li>

                                    {{-- detach role  --}}
                                    <x-danger-button>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>

                                    </x-danger-button>
                                </div>
                            </form>
                        @endforeach
                    </ul>
                @else
                    <small class="leading-relaxed text-green-500">Assign roles to this user.</small>
                @endif
            </div>

            {{-- add role --}}
            <div class="mt-6">
                <form action="{{ route('admin.users.roles.store', $user) }}" method="POST">
                    @csrf

                    <h2 class="mb-1 text-lg font-medium text-gray-900 dark:text-white title-font">Assign Role</h2>

                    <div class="relative mb-4">
                        <label for="name" class="text-sm leading-7 text-gray-400">Name</label>

                        <select name="role" id="" @required(true)
                            class="w-full px-3 py-1 text-base leading-8 transition-colors duration-200 ease-in-out border border-gray-700 rounded outline-none dark:text-gray-100 dark:bg-gray-800 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-900">
                            <option disabled selected>Select a role...</option>
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

            <div class="flex justify-end">

                <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                    onsubmit="return confirm('are you sur to delete this user ?')">
                    @method('DELETE')
                    @csrf
                    <x-danger-button>Delete user</x-danger-button>
                </form>
            </div>

        </div>

</x-admin-layout>
