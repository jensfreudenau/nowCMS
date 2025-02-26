<x-admin.layout>
    <div class="p-6 text-gray-900 pl-10">
    <p class="pb-11">
        <x-button-new href="/users/create">+ {{__('User')}}</x-button-new>
    </p>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div id="dataTable_length"></div>
        <table id="content" class="border-collapse table-auto w-full text-sm my-6 pt-6">
            <thead>
            <tr>
                <th class="text-left">{{ __('Name') }}</th>
                <th class="text-left">{{ __('Email') }}</th>
                <th class="text-left">{{__('Active')}}</th>

                <th class="no-sort"></th>
                <th class="no-sort"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td class="border-b border-slate-100 dark:border-slate-700 py-4">{{$user->name}}</td>
                    <td class="border-b border-slate-100 dark:border-slate-700 py-4">{{$user->email}}</td>
                    <td class="border-b border-slate-100 dark:border-slate-700 py-4">{{$user->active}}</td>
                    <td class="border-b border-slate-100 dark:border-slate-700 py-4">
                        <x-button-new href="{{ route('users.edit', $user->id) }}">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </x-button-new>
                    </td>
                    <td class="border-b border-slate-100 dark:border-slate-700 py-4">
                        <div class="flex justify-end">
                            <form method="POST" action="{{ route('users.destroy', $user) }}"
                                  onsubmit="return confirm('Are you sure:');">
                                @method('DELETE')
                                @csrf
                                <button type="submit"
                                        class="right-0 rounded-md bg-red-300 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-700">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
    </x-admin.layout>
