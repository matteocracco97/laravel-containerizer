<x-app-layout>
    <div class="mb-10">
        <h1 class="text-3xl font-bold tracking-tight mb-2">I tuoi Repository</h1>
        <p class="text-zinc-400">Seleziona un progetto Laravel per iniziare la generazione dei manifesti Docker e Kubernetes.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($repos as $repo)
            <a href="{{ route('wizard.analyze', ['owner' => $repo['owner']['login'], 'repo' => $repo['name']]) }}" 
               class="group relative p-6 bg-zinc-900 border border-zinc-800 rounded-2xl hover:border-zinc-500 transition-all duration-300 overflow-hidden">
                
                <div class="absolute -inset-px bg-gradient-to-r from-zinc-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"></div>

                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-10 h-10 bg-zinc-800 rounded-lg flex items-center justify-center text-xl">
                            📦
                        </div>
                        @if($repo['private'])
                            <span class="text-[10px] font-mono px-2 py-0.5 bg-zinc-800 border border-zinc-700 rounded text-zinc-400 uppercase tracking-widest">Private</span>
                        @endif
                    </div>

                    <h3 class="text-lg font-bold text-white group-hover:text-zinc-200 transition-colors truncate">
                        {{ $repo['name'] }}
                    </h3>
                    
                    <p class="text-sm text-zinc-500 mb-6 line-clamp-2 min-h-[40px]">
                        {{ $repo['description'] ?? 'Nessuna descrizione disponibile.' }}
                    </p>

                    <div class="flex items-center gap-4 text-xs font-mono text-zinc-500">
                        <div class="flex items-center gap-1">
                            <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                            {{ $repo['language'] ?? 'PHP' }}
                        </div>
                        <div>
                            Updated {{ \Carbon\Carbon::parse($repo['updated_at'])->diffForHumans() }}
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>

    @if(empty($repos))
        <div class="text-center py-20 border-2 border-dashed border-zinc-800 rounded-3xl">
            <p class="text-zinc-500">Non abbiamo trovato repository nel tuo account GitHub.</p>
        </div>
    @endif
</x-app-layout>