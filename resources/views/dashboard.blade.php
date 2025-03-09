<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}

                    <!-- Tampilkan profil siswa jika ada -->
                    @if ($student)
                        <div class="mt-4">
                            <h3 class="text-lg font-semibold">Profil Siswa</h3>
                            <p><strong>Nama:</strong> {{ $student->name }}</p>
                            <p><strong>NIS:</strong> {{ $student->nis }}</p>
                            <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                        </div>
                    @else
                        <div class="mt-4">
                            <p>Anda belum terdaftar sebagai siswa.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>