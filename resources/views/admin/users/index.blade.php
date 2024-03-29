<x-admin-layout>

    <div class="relative max-w-5xl p-4 mx-auto overflow-x-auto rounded-lg sm:p-6">

        <header
            class="flex items-center justify-between w-full p-4 mb-4 text-gray-900 rounded-lg shadow-sm bg-slate-100 dark:bg-gray-800 dark:text-slate-100">
            <h1 class="font-bold text-gray-900 dark:text-slate-100">Users</h1>

        </header>

        <table class="w-full text-sm text-left text-gray-500 rtl:text-right dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $key => $user)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $user->name }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $user->email }}
                        </td>

                        <td scope="col" class="gap-2 px-6 py-3 text-center">
                            <x-create-button href="{{ route('admin.users.show', $user) }}"
                                class="text-xs bg-orange-500 hover:bg-orange-400 dark:bg-white dark:hover:bg-slate-100 dark:text-gray-900">Show</x-create-button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-admin-layout>
