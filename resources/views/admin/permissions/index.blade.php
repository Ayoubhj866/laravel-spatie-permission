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
                                                <td class="">
                                                    <div class="flex justify-end px-2">
                                                        <a class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-green-600 border border-transparent rounded-md hover:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800"
                                                            href="{{ route('admin.permissions.edit', $permission) }}">Edit</a>

                                                        <form
                                                            action="{{ route('admin.permissions.destroy', $permission) }}"
                                                            onsubmit="return confirm('are you sure to delete the permission ?')"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <x-danger-button class="ms-3">
                                                                {{ __('Delete') }}
                                                            </x-danger-button>
                                                        </form>
                                                    </div>
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
