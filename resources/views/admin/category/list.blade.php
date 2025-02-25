<x-admin.layout>

                <div class="p-6 text-gray-900 pl-10">
                    <p class="pb-11">
                        <x-button-new href="/categories/create">Neue Kategorie</x-button-new>
                    </p>
                    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
                        <table id="category" class="border-collapse table-auto w-full text-sm my-6 pt-6">
                            <thead>
                            <tr>
                                <th class="text-left">Name</th>
                                <th class="text-left">Edit</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)

                                <tr>
                                    <td class="border-b border-slate-100 dark:border-slate-700 py-4">

                                        {{$category->translate('de')->name}} <br>
                                        {{$category->translate('en')->name}}

                                    </td>
                                    <td class="border-b border-slate-100 dark:border-slate-700 py-4">
                                        <x-button href="{{ route('category.edit', $category->id) }}">Edit</x-button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

</x-admin.layout>
