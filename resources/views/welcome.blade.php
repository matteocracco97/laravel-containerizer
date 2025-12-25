<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Containerizer</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800|jetbrains-mono:400,500" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <style>

    </style>
</head>
<body class="antialiased bg-slate-950 text-slate-100 font-sans min-h-screen overflow-x-hidden">
    <!-- Animated Background Elements -->
    <div class="fixed inset-0 grid-pattern opacity-30"></div>
    <div class="fixed inset-0 bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950 opacity-90"></div>
    
    <!-- Floating Orbs -->
    <div class="fixed top-1/4 left-1/4 w-64 h-64 bg-blue-500/5 rounded-full blur-3xl animate-float"></div>
    <div class="fixed bottom-1/4 right-1/4 w-96 h-96 bg-green-500/3 rounded-full blur-3xl animate-float" style="animation-delay: 1s;"></div>
    
    <!-- Noise Overlay -->
    <div class="fixed inset-0 opacity-[0.015] pointer-events-none" 
         style="background-image: url('data:image/svg+xml,%3Csvg viewBox=%220 0 256 256%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cfilter id=%22noise%22%3E%3CfeTurbulence type=%22fractalNoise%22 baseFrequency=%220.65%22 numOctaves=%223%22 stitchTiles=%22stitch%22/%3E%3C/filter%3E%3Crect width=%22256%22 height=%22256%22 filter=%22url%28%23noise%29%22 opacity=%220.5%22/%3E%3C/svg%3E');">
    </div>

    <main class="relative z-10 min-h-screen flex flex-col">
        <!-- Minimal Header -->
        <header class="sticky top-0 z-50 glass-card border-b border-slate-800/50">
            <div class="max-w-7xl mx-auto px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-500 to-emerald-500 flex items-center justify-center shadow-lg shadow-blue-500/20">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                        </div>
                        <span class="text-lg font-semibold tracking-tight">
                            Laravel<span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-emerald-400">Containerizer</span>
                        </span>
                    </div>
                    
                    <nav class="hidden md:flex items-center space-x-8">
                        <a href="#" class="text-sm font-medium text-slate-400 hover:text-white transition-colors duration-200">Docs</a>
                        <a href="#" class="text-sm font-medium text-slate-400 hover:text-white transition-colors duration-200">Examples</a>
                        <a href="{{ route('auth.github.redirect') }}" 
                           class="px-4 py-2 bg-slate-800/50 border border-slate-700 rounded-lg text-sm font-medium hover:bg-slate-700/50 hover:border-blue-500/50 transition-all duration-200 flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/>
                            </svg>
                            <span>Sign in</span>
                        </a>
                    </nav>
                </div>
            </div>
        </header>

        <!-- Hero Section - No Scroll Needed -->
        <section class="flex-1 flex items-center justify-center px-4 py-12">
            <div class="max-w-6xl w-full">
                <!-- Centered Content -->
                <div class="text-center mb-16">
                    <!-- Tagline -->
                    <div class="inline-flex items-center space-x-2 px-4 py-2 rounded-full bg-gradient-to-r from-blue-500/10 to-emerald-500/10 border border-blue-500/20 mb-8">
                        <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse-glow"></div>
                        <span class="text-sm font-mono text-blue-400 uppercase tracking-wider">From Laravel to K8s in minutes</span>
                    </div>
                    
                    <!-- Main Headline -->
                    <h1 class="text-5xl md:text-7xl font-bold mb-8 leading-tight">
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-white to-emerald-400">
                            Laravel Containers,<br>
                            Zero Configuration
                        </span>
                    </h1>
                    
                    <!-- Subtitle -->
                    <p class="text-xl text-slate-400 max-w-2xl mx-auto mb-12 leading-relaxed">
                        Connect your GitHub repository. Get production-ready Docker & Kubernetes configurations.
                        No DevOps degree required.
                    </p>
                </div>

                <!-- Main CTA Card -->
                <div class="glass-card rounded-2xl p-8 max-w-2xl mx-auto mb-16 border-blue-500/20 hover:border-blue-500/40 transition-all duration-300">
                    <div class="text-center">
                        <h2 class="text-2xl font-bold mb-6">
                            Connect Your Repository
                        </h2>
                        
                        <a href="{{ route('auth.github.redirect') }}" 
                           class="group relative inline-flex items-center justify-center space-x-4 px-12 py-5 bg-gradient-to-r from-slate-900 to-slate-800 border border-slate-700 rounded-xl font-semibold text-lg hover:border-blue-500 hover:shadow-xl hover:shadow-blue-500/20 transition-all duration-300 transform hover:-translate-y-1">
                            <div class="absolute -inset-0.5 bg-gradient-to-r from-blue-600 to-emerald-600 rounded-xl blur opacity-0 group-hover:opacity-30 transition duration-300"></div>
                            <svg class="w-6 h-6 relative z-10" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/>
                            </svg>
                            <span class="relative z-10">Continue with GitHub</span>
                            <span class="absolute -right-3 -top-3 w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center text-xs font-bold shadow-lg shadow-emerald-500/30">
                                →
                            </span>
                        </a>
                        
                        <p class="text-slate-500 text-sm mt-6">
                            We analyze your Laravel app and generate optimized configurations
                        </p>
                    </div>
                </div>

                <!-- Horizontal Steps -->
                <div class="relative">
                    <!-- Connecting Line -->
                    <div class="hidden lg:block absolute top-12 left-0 right-0 h-0.5 bg-gradient-to-r from-blue-500/20 via-emerald-500/20 to-blue-500/20"></div>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                        <!-- Step 1 -->
                        <div class="glass-card rounded-xl p-6 hover:border-blue-500/50 transition-all duration-300 group">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-gradient-to-br from-blue-500/20 to-blue-500/5 border border-blue-500/20 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                    <span class="text-blue-400 font-bold text-xl">1</span>
                                </div>
                                <div>
                                    <div class="flex items-center space-x-2 mb-2">
                                        <h3 class="font-semibold text-lg">Analyze</h3>
                                        <span class="text-xs px-2 py-0.5 rounded-full bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                            Auto
                                        </span>
                                    </div>
                                    <p class="text-slate-400 text-sm">
                                        Scan composer.json, detect services, queues, and dependencies
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Step 2 -->
                        <div class="glass-card rounded-xl p-6 hover:border-emerald-500/50 transition-all duration-300 group">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-gradient-to-br from-emerald-500/20 to-emerald-500/5 border border-emerald-500/20 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                    <span class="text-emerald-400 font-bold text-xl">2</span>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-lg mb-2">Generate</h3>
                                    <p class="text-slate-400 text-sm">
                                        Multi-stage Dockerfiles, optimized for dev or production
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Step 3 -->
                        <div class="glass-card rounded-xl p-6 hover:border-blue-500/50 transition-all duration-300 group">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-gradient-to-br from-blue-500/20 to-blue-500/5 border border-blue-500/20 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                    <span class="text-blue-400 font-bold text-xl">3</span>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-lg mb-2">Kubernetes</h3>
                                    <p class="text-slate-400 text-sm">
                                        Production manifests with health checks and best practices
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Step 4 -->
                        <div class="glass-card rounded-xl p-6 hover:border-emerald-500/50 transition-all duration-300 group">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-gradient-to-br from-emerald-500/20 to-emerald-500/5 border border-emerald-500/20 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                    <span class="text-emerald-400 font-bold text-xl">4</span>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-lg mb-2">Auto PR</h3>
                                    <p class="text-slate-400 text-sm">
                                        Pull request with configurations directly in your repo
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Live Demo Terminal -->
                <div class="mt-20 max-w-3xl mx-auto">
                    <div class="bg-black/60 border border-slate-800 rounded-xl p-6 font-mono text-sm backdrop-blur-sm">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center space-x-2">
                                <div class="w-3 h-3 rounded-full bg-red-500"></div>
                                <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                                <div class="w-3 h-3 rounded-full bg-emerald-500"></div>
                                <span class="text-slate-500 ml-2 text-xs">terminal</span>
                            </div>
                            <span class="text-xs text-slate-500">Live demo</span>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center space-x-2">
                                <span class="text-emerald-400 terminal-text">$</span>
                                <span class="text-slate-300">laravel-containerizer analyze</span>
                                <span class="text-slate-500 ml-2 text-xs"># Auto-detects Laravel structure</span>
                            </div>
                            <div class="text-blue-400 pl-6 animate-pulse">
                                → Detected: Laravel 12, Redis, Queue workers, Scheduler
                            </div>
                            <div class="flex items-center space-x-2 mt-4">
                                <span class="text-emerald-400 terminal-text">$</span>
                                <span class="text-slate-300">laravel-containerizer generate --prod</span>
                            </div>
                            <div class="text-emerald-400 pl-6">
                                ✓ Generated: Dockerfile.prod, k8s/, docker-compose.yml
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Minimal Footer -->
        <footer class="mt-auto py-8 px-6 text-center border-t border-slate-800/50">
            <div class="flex flex-wrap items-center justify-center gap-4 mb-4">
                <span class="px-3 py-1 rounded-full bg-blue-500/10 text-blue-400 text-xs font-mono border border-blue-500/20">
                    Laravel 12
                </span>
                <span class="px-3 py-1 rounded-full bg-emerald-500/10 text-emerald-400 text-xs font-mono border border-emerald-500/20">
                    PHP 8.3
                </span>
                <span class="px-3 py-1 rounded-full bg-blue-500/10 text-blue-400 text-xs font-mono border border-blue-500/20">
                    K8s Ready
                </span>
                <span class="px-3 py-1 rounded-full bg-emerald-500/10 text-emerald-400 text-xs font-mono border border-emerald-500/20">
                    PA Compatible
                </span>
            </div>
            <p class="text-slate-500 text-sm font-mono">
                Zero enterprise bullshit • Built for developers who ship
            </p>
        </footer>
    </main>

    <!-- Optional: Add a subtle scanline effect -->
    <div class="fixed inset-0 pointer-events-none">
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-blue-500/1 to-transparent opacity-0 animate-scanline" 
             style="height: 2px; animation: scanline 8s linear infinite;"></div>
    </div>

    <style>
        @keyframes scanline {
            0% { transform: translateY(-100%); }
            100% { transform: translateY(100vh); }
        }
    </style>
</body>
</html>