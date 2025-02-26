<x-admin.layout>
    <x-slot:heading></x-slot:heading>
    <x-slot:meta>{{ __('User Edit') }}</x-slot:meta>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User') }}
        </h2>
    </x-slot>

        <div class="mx-auto sm:px-6 lg:px-8">

                @if(session('status'))
                <div class="p-4 text-sm text-gray-800 rounded-lg bg-gray-50 dark:bg-gray-800 dark:text-gray-300" role="alert">
                    <span class="font-medium">{{ session('status') }}
                </div>
                @endif

                                <div class="grid grid-cols-1 gap-4">
                                    <h2>{{ __('User') }}</h2>
                                    @if (isset($user))
                                    <form action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data">
                                        @method('PUT')
                                    @else
                                        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                                    @endif
                                         @csrf

                                         <div class="p-6">
                                                <label for="name" class="required block">{{ __('Name')}}*</label>
                                                <input type="text"
                                                       name="name"
                                                       value="{{ old('name', $user?->name ?? '') }}"
                                                       class="{{ $errors->has('name') ? 'is-invalid' : '' }} mt-0 block w-full px-0.5 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-black"
                                                       aria-describedby="nameHelp"
                                                       id="name"
                                                       placeholder="Name"
                                                       required>
                                                <div id="nameHelp" class="text-sm">
                                                    {{ __('Gib dem einen Namen') }}.
                                                </div>
                                                @error('name')

                                                <div class="invalid-feedback">
                                                    {{ __('ein gültiger Name ist erforderlich') }}
                                                </div>
                                                @enderror
                                         </div>
                                        <div class="p-6">
                                            <label for="email" class="required block">{{ __('Email')}}*</label>
                                            <input type="text"
                                                   name="email"
                                                   value="{{ old('email', $user?->email ?? '') }}"
                                                   class="{{ $errors->has('email') ? 'is-invalid' : '' }} mt-0 block w-full px-0.5 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-black"
                                                   aria-describedby="nameHelp"
                                                   id="email"
                                                   placeholder="Email"
                                                   required>
                                            <div id="nameHelp" class="text-sm">
                                                {{ __('Gib dem einen Namen') }}.
                                            </div>
                                            @error('email')

                                            <div class="invalid-feedback">
                                                {{ __('eine gültige Email ist erforderlich') }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="p-6">
                                            <label for="password" class="required block">{{ __('Password')}}*</label>
                                            <input type="password"
                                                   name="password"
                                                   class="{{ $errors->has('password') ? 'is-invalid' : '' }} mt-0 block w-full px-0.5 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-black"
                                                   aria-describedby="nameHelp"
                                                   id="password"
                                                   placeholder="password"
                                                   >

                                        </div>

                                        <div class="p-12 flex items-center justify-end">
                                            <x-link class=" mr-4"  href="/users/index">zurück</x-link>
                                            <button type="submit"
                                                    class="
                                                    rounded-md
                                                    bg-indigo-600
                                                    px-3
                                                    py-2
                                                    text-sm
                                                    font-semibold
                                                    text-white
                                                    shadow-sm
                                                    hover:bg-indigo-500
                                                    focus-visible:outline
                                                    focus-visible:outline-2
                                                    focus-visible:outline-offset-2
                                                    focus-visible:outline-indigo-600"
                                            >
                                                Save
                                            </button>
                                        </div>
                                    </form>

                                </div>
                            </div>

    @push('js_after')

    @endpush
</x-admin.layout>
