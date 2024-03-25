<x-admin-layout>
    <div class="w-full p-2 py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <section class="py-1 bg-blueGray-50">
                    <div class="w-full px-4 mx-auto mt-24 mb-12 xl:w-8/12 xl:mb-0">
                        <div
                            class="relative flex flex-col w-full min-w-0 mb-6 break-words bg-white rounded shadow-lg dark:text-slate-200 dark:bg-gray-700 ">
                            <div class="px-4 py-3 mb-0 border-0 rounded-t">
                                <div class="flex flex-wrap items-center">
                                    <div class="relative flex-1 flex-grow w-full max-w-full px-4">
                                        <h3 class="text-base font-semibold text-blueGray-700">Permissions</h3>
                                    </div>
                                    <div class="relative flex-1 flex-grow w-full max-w-full px-4 text-right">
                                        <x-create-button href="{{ route('admin.permissions.create') }}">Create
                                            Permission</x-create-button>
                                    </div>
                                </div>
                            </div>

                            <div class="block w-full overflow-x-auto">
                                <table class="items-center w-full bg-transparent border-collapse ">
                                    <thead>
                                        <tr>
                                            <th
                                                class="px-6 py-3 font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid bg-blueGray-50 text-blueGray-500 border-blueGray-100 whitespace-nowrap">
                                                Permission
                                            </th>
                                            <th
                                                class="px-6 py-3 font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid bg-blueGray-50 text-blueGray-500 border-blueGray-100 whitespace-nowrap">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($permissions as $permission)
                                            <tr>
                                                <th
                                                    class="p-4 px-6 text-left align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap text-blueGray-700 ">
                                                    {{ $permission->name }}
                                                </th>
                                                <td
                                                    class="p-4 px-6 align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap ">
                                                    <a href="#">Edit</a>
                                                    <a href="#">Delete</a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="2"
                                                    class="py-4 font-bold text-center text-purple-900 dark:text-white">
                                                    No permission found !
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-admin-layout>
