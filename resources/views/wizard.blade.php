<x-app-layout>
    <div x-data="{ 
        step: 1, 
        postgres: false, 
        redis: true, 
        architecture: 'monolith' 
    }" class="max-w-4xl mx-auto py-12 px-4">

        <div class="mb-12">
            <div class="flex items-center gap-4 mb-2">
                <span class="text-xs font-mono text-zinc-500 uppercase tracking-widest">
                    Step <span x-text="step"></span> of 3
                </span>
            </div>
            <div class="flex gap-2">
                <template x-for="i in 3">
                    <div class="h-1 flex-1 rounded-full transition-colors duration-500" 
                         :class="i <= step ? 'bg-white' : 'bg-zinc-800'"></div>
                </template>
            </div>
        </div>

        <div x-show="step === 1" x-transition>
            <h1 class="text-3xl font-bold mb-2 text-white">We have analyzed your repository</h1>
            <p class="text-zinc-400 mb-8">Here’s what we found in your Laravel project. Please confirm or modify the basic settings.</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="p-6 bg-zinc-900 border border-zinc-800 rounded-2xl">
                    <div class="text-zinc-500 text-sm mb-4">PHP Version</div>
                    <div class="text-2xl font-mono font-bold italic text-white">8.3</div>
                </div>
                
                <div class="p-6 bg-zinc-900 border border-zinc-800 rounded-2xl md:col-span-2">
                    <div class="text-zinc-500 text-sm mb-4">Detected Features</div>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-3 py-1 bg-zinc-800 border border-zinc-700 rounded-full text-xs font-medium text-white flex items-center gap-2">
                            <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                            Laravel Horizon
                        </span>
                        <span class="px-3 py-1 bg-zinc-800 border border-zinc-700 rounded-full text-xs font-medium text-white">Redis</span>
                        <span class="px-3 py-1 bg-zinc-800 border border-zinc-700 rounded-full text-xs font-medium text-white">MySQL</span>
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <button @click="step = 2" class="px-6 py-3 bg-white text-zinc-950 rounded-xl font-semibold hover:bg-zinc-200 transition">
                    Continue to configuration
                </button>
            </div>
        </div>

        <div x-show="step === 2" x-transition x-cloak>
            <h1 class="text-3xl font-bold mb-2 text-white">What do you want to include?</h1>
            <p class="text-zinc-400 mb-8">Choose the services that will be generated in your Docker Compose and Kubernetes.</p>

            <div class="space-y-4 mb-8">
               <label class="group block p-4 bg-zinc-900 border rounded-2xl cursor-pointer transition"
       :class="postgres ? 'border-blue-500 bg-blue-900/20' : 'border-zinc-800 hover:border-zinc-600'">
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <div class="w-10 h-10 bg-zinc-800 rounded-lg flex items-center justify-center">🐘</div>
            <div>
                <div class="font-semibold text-white">PostgreSQL</div>
                <div class="text-sm text-zinc-500">Advanced relational database</div>
            </div>
        </div>
        <div class="relative flex items-center justify-center">
            <input type="checkbox" 
                   x-model="postgres"
                   class="sr-only">
            <div class="w-5 h-5 rounded border-2 transition-all duration-200 flex items-center justify-center"
                 :class="postgres ? 'bg-blue-500 border-blue-500' : 'bg-zinc-800 border-zinc-700'">
                <svg x-show="postgres" x-transition.opacity class="w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                </svg>
            </div>
        </div>
    </div>
</label>

<label class="group block p-4 bg-zinc-900 border rounded-2xl cursor-pointer transition"
       :class="redis ? 'border-green-500 bg-green-900/20' : 'border-zinc-800 hover:border-zinc-600'">
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <div class="w-10 h-10 bg-zinc-800 rounded-lg flex items-center justify-center text-red-500">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path></svg>
            </div>
            <div>
                <div class="font-semibold text-white">Redis</div>
                <div class="text-sm text-zinc-500">Cache and Message Queue</div>
            </div>
        </div>
        <div class="relative flex items-center justify-center">
            <input type="checkbox" 
                   x-model="redis"
                   class="sr-only">
            <div class="w-5 h-5 rounded border-2 transition-all duration-200 flex items-center justify-center"
                 :class="redis ? 'bg-green-500 border-green-500' : 'bg-zinc-800 border-zinc-700'">
                <svg x-show="redis" x-transition.opacity class="w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                </svg>
            </div>
        </div>
    </div>
</label>
            </div>

            <div class="flex justify-between">
                <button @click="step = 1" class="px-6 py-3 bg-zinc-800 text-white rounded-xl font-semibold hover:bg-zinc-700 transition">Back</button>
                <button @click="step = 3" class="px-6 py-3 bg-white text-zinc-950 rounded-xl font-semibold hover:bg-zinc-200 transition">Final step</button>
            </div>
        </div>

        <div x-show="step === 3" x-transition x-cloak>
            <h1 class="text-3xl font-bold mb-2 text-white">Final Architecture</h1>
            <p class="text-zinc-400 mb-8">Choose how to organize your containers.</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <button @click="architecture = 'monolith'" 
                        class="p-6 bg-zinc-900 border-2 rounded-2xl text-left relative overflow-hidden transition"
                        :class="architecture === 'monolith' ? 'border-white' : 'border-zinc-800 hover:border-zinc-600'">
                    <div class="font-bold text-lg mb-1 italic text-white">Single Container (Monolith)</div>
                    <p class="text-sm text-zinc-500">Ideal for small projects or testing. Everything in one container.</p>
                </button>
                
                <button @click="architecture = 'microservices'" 
                        class="p-6 bg-zinc-900 border-2 rounded-2xl text-left transition"
                        :class="architecture === 'microservices' ? 'border-white' : 'border-zinc-800 hover:border-zinc-600'">
                    <div class="font-bold text-lg mb-1 text-white">Multi-Container (Microservices)</div>
                    <p class="text-sm text-zinc-500">Kubernetes-ready scalability. Separated Worker and App containers.</p>
                </button>
            </div>

            <div class="flex justify-between">
                <button @click="step = 2" class="px-6 py-3 bg-zinc-800 text-white rounded-xl font-semibold hover:bg-zinc-700 transition">Back</button>
                <button @click="console.log('Postgres:', postgres, 'Redis:', redis, 'Arch:', architecture)" 
                        class="px-8 py-3 bg-white text-zinc-950 rounded-xl font-bold hover:bg-zinc-200 transition shadow-[0_0_20px_rgba(255,255,255,0.3)]">
                    Generate Manifests ✨
                </button>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    [x-cloak] { display: none !important; }
</style>