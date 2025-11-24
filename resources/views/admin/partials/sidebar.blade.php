<aside class="w-64 h-screen bg-dark shadow-md fixed">
    <div class="p-6 border-b">
        <h1 class="text-xl font-bold text-white">Timedoor Academy</h1>
    </div>

    <nav class="mt-4">
        <ul class="space-y-2">

            <li>
                <a href="{{ route('admin.partners.index') }}"
                   class="block px-6 py-3 hover:bg-green-100">
                    Partners
                </a>
            </li>

            <li>
                <a href="{{ route('admin.partners.create') }}"
                   class="block px-6 py-3 hover:bg-green-100">
                    Tambah Partner
                </a>
            </li>

        </ul>
    </nav>
</aside>

{{-- Tambah offset supaya konten tidak tertutup sidebar --}}
<div class="w-64"></div>
