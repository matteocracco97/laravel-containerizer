<x-app-layout>
    <div class="mb-12">
        <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-blue-500/10 border border-blue-500/20 mb-4">
            <div class="w-2 h-2 rounded-full bg-blue-500 animate-pulse-glow"></div>
            <span class="text-[10px] font-mono text-blue-400 uppercase tracking-widest">Dashboard</span>
        </div>
        <h1 class="text-4xl font-bold tracking-tight mb-3">
            I tuoi <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-emerald-400">Repository</span>
        </h1>
        <p class="text-slate-400 max-w-2xl">
            Seleziona un progetto Laravel. Analizzeremo la struttura per generare manifesti Docker e Kubernetes pronti per la produzione.
        </p>
    </div>

    <!-- Search Form -->
    <div class="mb-8">
        <div class="flex gap-4">
            <div class="flex-1">
                <input type="text" id="search-input" value="{{ $query ?? '' }}"
                       placeholder="Cerca repository..."
                       class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <button id="clear-search" class="px-6 py-3 bg-slate-700 hover:bg-slate-600 text-white font-medium rounded-xl transition-colors duration-200" style="display: {{ ($query ?? false) ? 'block' : 'none' }};">
                Cancella
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($repos as $repo)
            <a href="{{ route('wizard.analyze', ['owner' => $repo->owner, 'repo' => $repo->name]) }}"
               class="glass-card group relative p-8 rounded-2xl border-slate-800/50 hover:border-blue-500/50 transition-all duration-300 transform hover:-translate-y-1 overflow-hidden">
                
                <div class="absolute -inset-px bg-gradient-to-br from-blue-600/10 to-emerald-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"></div>

                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-6">
                        <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-blue-500/20 to-emerald-500/20 border border-blue-500/20 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        
                        @if($repo->isPrivate)
                            <span class="px-2 py-1 rounded-full bg-slate-800/50 text-[10px] font-mono text-slate-400 border border-slate-700 uppercase tracking-tight">
                                Private
                            </span>
                        @endif
                    </div>

                    <h3 class="text-xl font-bold text-white mb-2 group-hover:text-blue-400 transition-colors duration-300 truncate">
                        {{ $repo->name }}
                    </h3>

                    <p class="text-sm text-slate-400 mb-8 line-clamp-2 min-h-[40px] leading-relaxed">
                        {{ $repo->description ?: 'No description provided for this Laravel project.' }}
                    </p>

                    <div class="flex items-center justify-between pt-6 border-t border-slate-800/50">
                        <div class="flex items-center space-x-3">
                            <span class="flex items-center text-[11px] font-mono text-emerald-400">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-2 animate-pulse"></span>
                                {{ $repo->language ?? 'PHP' }}
                            </span>
                        </div>
                        <span class="text-[11px] font-mono text-slate-500 uppercase tracking-tighter">
                            Updated {{ \Carbon\Carbon::instance($repo->updatedAt)->diffForHumans() }}
                        </span>
                    </div>
                </div>

                <div class="absolute bottom-4 right-4 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-x-2 group-hover:translate-x-0">
                    <span class="text-blue-400">→</span>
                </div>
            </a>
        @endforeach
    </div>

    <!-- Pagination -->
    @if(!empty($repos))
        <div class="mt-16 flex justify-center">
            <div class="flex items-center space-x-2">
                @if(($page ?? 1) > 1)
                    <a href="{{ route('dashboard', array_merge(request()->query(), ['page' => ($page ?? 1) - 1])) }}"
                       class="px-4 py-2 bg-slate-800/50 hover:bg-slate-700 text-slate-300 hover:text-white rounded-lg border border-slate-700 transition-colors duration-200 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Precedente
                    </a>
                @endif

                <span class="px-4 py-2 bg-slate-800/50 text-slate-400 rounded-lg border border-slate-700">
                    Pagina {{ $page ?? 1 }}
                </span>

                @if(count($repos) >= 6) <!-- Assuming perPage is 6 -->
                    <a href="{{ route('dashboard', array_merge(request()->query(), ['page' => ($page ?? 1) + 1])) }}"
                       class="px-4 py-2 bg-slate-800/50 hover:bg-slate-700 text-slate-300 hover:text-white rounded-lg border border-slate-700 transition-colors duration-200 flex items-center gap-2">
                        Successivo
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                @endif
            </div>
        </div>
    @endif

    @if(empty($repos))
        <div class="glass-card rounded-3xl p-20 text-center border-dashed border-slate-800">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-900 mb-6 border border-slate-800">
                <svg class="w-8 h-8 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 9.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h3 class="text-xl font-semibold mb-2">Nessun repository trovato</h3>
            <p class="text-slate-500 font-mono text-sm">Controlla i permessi del tuo token GitHub o prova a ricollegare l'account.</p>
        </div>
    @endif

    <script>
        let currentPage = {{ $page ?? 1 }};
        let currentQuery = '{{ $query ?? '' }}';
        let isLoading = false;

        const searchInput = document.getElementById('search-input');
        const clearButton = document.getElementById('clear-search');
        const reposContainer = document.querySelector('.grid.grid-cols-1.md\\:grid-cols-2.lg\\:grid-cols-3');
        const paginationContainer = document.querySelector('.mt-12.flex.justify-center');
        const emptyState = document.querySelector('.glass-card.rounded-3xl.p-20.text-center');

        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        function showLoading() {
            if (reposContainer) {
                reposContainer.innerHTML = `
                    <div class="col-span-full flex flex-col items-center justify-center py-16">
                        <div class="animate-spin rounded-full h-16 w-16 border-4 border-slate-700 border-t-blue-500 mb-4"></div>
                        <p class="text-slate-400 text-sm">Caricamento repository...</p>
                    </div>
                `;
            }
        }

        function hideLoading() {
            // Loading is replaced by content
        }

        async function fetchRepos(query = '', page = 1) {
            if (isLoading) return;
            isLoading = true;
            showLoading();

            try {
                const response = await fetch(`{{ route('dashboard.repos') }}?q=${encodeURIComponent(query)}&page=${page}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                const data = await response.json();

                updateRepos(data.repos);
                updatePagination(data.hasMore, page, query);
                currentPage = page;
                currentQuery = query;

                if (clearButton) {
                    clearButton.style.display = query ? 'block' : 'none';
                }

            } catch (error) {
                console.error('Error fetching repos:', error);
                if (reposContainer) {
                    reposContainer.innerHTML = '<div class="col-span-full text-center py-12 text-red-400">Errore nel caricamento dei repository</div>';
                }
            } finally {
                isLoading = false;
            }
        }

        function updateRepos(repos) {
            if (!reposContainer) return;

            if (repos.length === 0) {
                reposContainer.innerHTML = '';
                if (emptyState) emptyState.style.display = 'block';
                return;
            }

            if (emptyState) emptyState.style.display = 'none';

            const html = repos.map(repo => `
                <a href="/dashboard/analyze/${repo.owner}/${repo.name}"
                   class="glass-card group relative p-8 rounded-2xl border-slate-800/50 hover:border-blue-500/50 transition-all duration-300 transform hover:-translate-y-1 overflow-hidden">

                    <div class="absolute -inset-px bg-gradient-to-br from-blue-600/10 to-emerald-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"></div>

                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-6">
                            <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-blue-500/20 to-emerald-500/20 border border-blue-500/20 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                            </div>

                            ${repo.isPrivate ? `
                                <span class="px-2 py-1 rounded-full bg-slate-800/50 text-[10px] font-mono text-slate-400 border border-slate-700 uppercase tracking-tight">
                                    Private
                                </span>
                            ` : ''}
                        </div>

                        <h3 class="text-xl font-bold text-white mb-2 group-hover:text-blue-400 transition-colors duration-300 truncate">
                            ${repo.name}
                        </h3>

                        <p class="text-sm text-slate-400 mb-8 line-clamp-2 min-h-[40px] leading-relaxed">
                            ${repo.description || 'No description provided for this Laravel project.'}
                        </p>

                        <div class="flex items-center justify-between pt-6 border-t border-slate-800/50">
                            <div class="flex items-center space-x-3">
                                <span class="flex items-center text-[11px] font-mono text-emerald-400">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-2 animate-pulse"></span>
                                    ${repo.language || 'PHP'}
                                </span>
                            </div>
                            <span class="text-[11px] font-mono text-slate-500 uppercase tracking-tighter">
                                Updated ${new Date(repo.updatedAt).toLocaleDateString('it-IT', { year: 'numeric', month: 'short', day: 'numeric' })}
                            </span>
                        </div>
                    </div>

                    <div class="absolute bottom-4 right-4 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-x-2 group-hover:translate-x-0">
                        <span class="text-blue-400">→</span>
                    </div>
                </a>
            `).join('');

            reposContainer.innerHTML = html;
        }

        function updatePagination(hasMore, page, query) {
            if (!paginationContainer) return;

            let html = '<div class="flex items-center space-x-2">';

            if (page > 1) {
                html += `
                    <button onclick="changePage(${page - 1}, '${query}')" class="px-4 py-2 bg-slate-800/50 hover:bg-slate-700 text-slate-300 hover:text-white rounded-lg border border-slate-700 transition-colors duration-200 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Precedente
                    </button>
                `;
            }

            html += `<span class="px-4 py-2 bg-slate-800/50 text-slate-400 rounded-lg border border-slate-700">Pagina ${page}</span>`;

            if (hasMore) {
                html += `
                    <button onclick="changePage(${page + 1}, '${query}')" class="px-4 py-2 bg-slate-800/50 hover:bg-slate-700 text-slate-300 hover:text-white rounded-lg border border-slate-700 transition-colors duration-200 flex items-center gap-2">
                        Successivo
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                `;
            }

            html += '</div>';
            paginationContainer.innerHTML = html;
        }

        function changePage(page, query) {
            fetchRepos(query, page);
        }

        // Event listeners
        const debouncedSearch = debounce((query) => {
            fetchRepos(query, 1);
        }, 300);

        searchInput.addEventListener('input', (e) => {
            const query = e.target.value.trim();
            if (query.length === 0 || query.length >= 2) {
                debouncedSearch(query);
            }
        });

        clearButton.addEventListener('click', () => {
            searchInput.value = '';
            fetchRepos('', 1);
        });

        // Initial load if there's a query
        if (currentQuery) {
            fetchRepos(currentQuery, currentPage);
        }
    </script>
</x-app-layout>