<x-filament-widgets::widget>
    <x-filament::section>
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold">Pilih Cafe</h3>
                @if($this->getSelectedCafe())
                    <span class="text-sm text-gray-500">
                        Aktif: <strong>{{ $this->getSelectedCafe()->name }}</strong>
                    </span>
                @endif
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach($this->getCafes() as $cafe)
                    <button
                        wire:click="selectCafe({{ $cafe->id }})"
                        class="p-4 rounded-lg border-2 transition-all hover:shadow-md {{ Session::get('selected_cafe_id') === $cafe->id ? 'border-primary-500 bg-primary-50' : 'border-gray-200 hover:border-primary-300' }}">
                        <div class="flex items-center gap-3">
                            @if($cafe->image_path)
                                <img src="{{ Storage::url($cafe->image_path) }}" alt="{{ $cafe->name }}" class="w-12 h-12 rounded-lg object-cover">
                            @else
                                <div class="w-12 h-12 rounded-lg bg-gray-200 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                            @endif
                            <div class="text-left">
                                <div class="font-semibold">{{ $cafe->name }}</div>
                                <div class="text-xs text-gray-500">{{ Str::limit($cafe->address, 30) }}</div>
                            </div>
                        </div>
                    </button>
                @endforeach
            </div>

            @if(!$this->getSelectedCafe())
                <div class="p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                    <p class="text-sm text-yellow-800">
                        <strong>Perhatian:</strong> Silakan pilih cafe yang ingin Anda kelola.
                    </p>
                </div>
            @endif
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
