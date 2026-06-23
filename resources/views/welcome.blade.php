<!DOCTYPE html>

<html class="scroll-smooth" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>TamDan | Manage Clients. Deliver Projects. Get Paid.</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@300;400;500;600;700;800&amp;family=JetBrains+Mono:wght@500&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-primary-container": "#fefcff",
                        "on-error": "#ffffff",
                        "on-surface": "#191c1e",
                        "surface-dim": "#d8dadc",
                        "secondary": "#565c81",
                        "outline-variant": "#c1c6d7",
                        "on-error-container": "#93000a",
                        "surface-container-low": "#f2f4f6",
                        "primary-fixed-dim": "#adc7ff",
                        "surface-variant": "#e0e3e5",
                        "secondary-fixed": "#dee1ff",
                        "background": "#f7f9fb",
                        "surface-container-highest": "#e0e3e5",
                        "on-tertiary-container": "#fcfcff",
                        "inverse-primary": "#adc7ff",
                        "on-tertiary-fixed-variant": "#004b72",
                        "tertiary-container": "#007bb8",
                        "error": "#ba1a1a",
                        "on-secondary-fixed-variant": "#3f4568",
                        "tertiary-fixed-dim": "#91cdff",
                        "surface": "#f7f9fb",
                        "on-secondary-fixed": "#13193a",
                        "on-tertiary": "#ffffff",
                        "on-primary-fixed-variant": "#004493",
                        "inverse-surface": "#2d3133",
                        "surface-container-lowest": "#ffffff",
                        "inverse-on-surface": "#eff1f3",
                        "surface-bright": "#f7f9fb",
                        "primary": "#0059bb",
                        "tertiary": "#006192",
                        "secondary-fixed-dim": "#bec4ee",
                        "primary-container": "#0070ea",
                        "on-primary-fixed": "#001a41",
                        "surface-container": "#eceef0",
                        "surface-container-high": "#e6e8ea",
                        "outline": "#717786",
                        "on-tertiary-fixed": "#001e31",
                        "on-secondary": "#ffffff",
                        "on-secondary-container": "#555b7f",
                        "tertiary-fixed": "#cce5ff",
                        "on-surface-variant": "#414754",
                        "on-background": "#191c1e",
                        "error-container": "#ffdad6",
                        "primary-fixed": "#d8e2ff",
                        "on-primary": "#ffffff",
                        "surface-tint": "#005bc0",
                        "secondary-container": "#cfd5ff"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "16px",
                        "2xl": "24px",
                        "3xl": "32px",
                        "4xl": "48px",
                        "full": "9999px"
                    },
                    "spacing": {
                        "unit": "4px",
                        "max-width": "1440px",
                        "gutter": "24px",
                        "margin-mobile": "16px",
                        "margin-desktop": "32px",
                        "stack-sm": "8px",
                        "stack-md": "16px",
                        "stack-lg": "32px",
                        "section-gap-md": "100px",
                        "section-gap-lg": "160px"
                    },
                    "fontFamily": {
                        "display-lg": ["Hanken Grotesk"],
                        "body-md": ["Hanken Grotesk"],
                        "body-lg": ["Hanken Grotesk"],
                        "title-md": ["Hanken Grotesk"],
                        "label-sm": ["JetBrains Mono"],
                        "headline-lg": ["Hanken Grotesk"],
                        "headline-lg-mobile": ["Hanken Grotesk"]
                    },
                    "fontSize": {
                        "display-lg": ["64px", {
                            "lineHeight": "72px",
                            "letterSpacing": "-0.03em",
                            "fontWeight": "800"
                        }],
                        "body-md": ["16px", {
                            "lineHeight": "24px",
                            "fontWeight": "400"
                        }],
                        "body-lg": ["18px", {
                            "lineHeight": "28px",
                            "fontWeight": "400"
                        }],
                        "title-md": ["22px", {
                            "lineHeight": "30px",
                            "fontWeight": "700"
                        }],
                        "label-sm": ["12px", {
                            "lineHeight": "16px",
                            "letterSpacing": "0.05em",
                            "fontWeight": "600"
                        }],
                        "headline-lg": ["40px", {
                            "lineHeight": "48px",
                            "letterSpacing": "-0.02em",
                            "fontWeight": "700"
                        }],
                        "headline-lg-mobile": ["28px", {
                            "lineHeight": "36px",
                            "fontWeight": "700"
                        }]
                    }
                },
            },
        }
    </script>
    <style>
        body {
            font-family: 'Hanken Grotesk', sans-serif;
            background-color: #f7f9fb;
            overflow-x: hidden;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.65);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.4);
        }

        .glass-card-dark {
            background: rgba(0, 26, 65, 0.8);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .hover-lift {
            transition: transform 0.4s cubic-bezier(0.2, 0, 0, 1), box-shadow 0.4s cubic-bezier(0.2, 0, 0, 1);
        }

        .hover-lift:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px -10px rgba(0, 89, 187, 0.12);
        }

        .text-gradient {
            background: linear-gradient(135deg, #0059bb 0%, #00a3ff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .glow-border:hover {
            border-color: rgba(0, 89, 187, 0.4);
            box-shadow: 0 0 20px rgba(0, 89, 187, 0.05);
        }

        .scroll-reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.2, 0, 0, 1);
        }

        .scroll-reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .marquee-track {
            animation: marquee 40s linear infinite;
        }

        @keyframes marquee {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .abstract-blob {
            border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
            filter: blur(60px);
        }

        .mesh-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
            opacity: 0.4;
        }

        .flow-line {
            height: 1.5px;
            background: linear-gradient(90deg, transparent, #0059bb 20%, #0059bb 80%, transparent);
        }
    </style>
</head>

<body class="text-on-surface">
    <!-- Mesh Background Decorations -->
    <div class="mesh-bg pointer-events-none">
        <div class="abstract-blob absolute top-[-10%] right-[-5%] w-[500px] h-[500px] bg-primary/10"></div>
        <div class="abstract-blob absolute top-[40%] left-[-10%] w-[400px] h-[400px] bg-secondary-container/20"></div>
    </div>
    <!-- 1. TopNavBar -->
    <header class="fixed top-0 w-full z-50 bg-white/70 backdrop-blur-xl border-b border-outline-variant/30 h-[80px]">
        <div class="flex justify-between items-center h-full px-gutter max-w-[1440px] mx-auto">
            <div class="flex items-center gap-3">
                <img alt="TamDan Logo" class="h-20 w-auto contrast-125 brightness-110" src="{{ asset('images/tam_dan_logo.png') }}" />
                <!-- <span class="font-display-lg text-title-md font-extrabold tracking-tight text-on-primary-fixed">TamDan</span> -->
            </div>
            <nav class="hidden md:flex gap-10">
                <a class="font-body-md text-primary font-bold border-b-2 border-primary pb-1" href="#features">Features</a>
                <a class="font-body-md text-on-surface-variant hover:text-primary transition-colors font-semibold" href="#workflow">Workflow</a>
                <a class="font-body-md text-on-surface-variant hover:text-primary transition-colors font-semibold" href="#pricing">Pricing</a>
                <a class="font-body-md text-on-surface-variant hover:text-primary transition-colors font-semibold" href="#faq">FAQs</a>
            </nav>
            <div class="flex items-center gap-6">
                <a class="font-body-md text-on-surface font-bold hover:text-primary transition-all" href="/admin">
                    Login
                </a>
                <a class="bg-primary text-on-primary px-7 py-3 rounded-xl font-body-md font-bold hover:bg-primary-container active:scale-95 transition-all shadow-lg shadow-primary/10" href="/admin/login">
                    Get Started
                </a>
            </div>
        </div>
    </header>
    <main class="pt-[80px]">
        <!-- 2. Hero Section -->
        <section class="relative max-w-[1440px] mx-auto px-gutter py-section-gap-md lg:py-section-gap-lg grid lg:grid-cols-2 gap-stack-lg items-center">
            <div class="scroll-reveal visible z-10">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-primary/5 border border-primary/10 text-primary font-label-sm uppercase tracking-widest mb-8">
                    <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                    Modern Agency Operating System
                </div>
                <h1 class="font-display-lg text-display-lg leading-[1.1] text-on-background mb-stack-md">
                    Manage Clients. <br />
                    <span class="text-gradient">Deliver Projects.</span> <br />
                    Get Paid.
                </h1>
                <p class="font-body-lg text-body-lg text-on-surface-variant mb-stack-lg max-w-xl leading-relaxed">
                    TamDan is the operating system for modern service businesses. Streamline the entire client lifecycle from initial lead to final payment in one unified, high-performance platform.
                </p>
                <div class="flex flex-col sm:flex-row gap-6 mb-12">
                    <a class="bg-primary text-on-primary px-10 py-5 rounded-2xl font-body-lg font-bold shadow-2xl shadow-primary/30 hover-lift active:scale-95 text-lg text-center" href="/admin/login">Get Started</a>
                    <a class="bg-white/50 backdrop-blur border border-outline-variant text-on-surface px-10 py-5 rounded-2xl font-body-lg font-bold hover:bg-white transition-colors active:scale-95 text-lg text-center" href="/admin">Open Dashboard</a>
                </div>
                <div class="flex items-center gap-4">
                    @if ($recentClients->isNotEmpty())
                        <div class="flex -space-x-3">
                            @foreach ($recentClients as $client)
                                <div class="w-10 h-10 rounded-full border-2 border-white bg-primary text-on-primary flex items-center justify-center text-xs font-black uppercase" title="{{ $client->name }}">
                                    {{ strtoupper(substr($client->name, 0, 1)) }}
                                </div>
                            @endforeach
                        </div>
                        <p class="font-label-sm text-label-sm text-on-surface-variant font-bold uppercase tracking-wider">
                            {{ $stats['clients'] }} {{ Str::plural('client', $stats['clients']) }} managed on TamDan
                        </p>
                    @else
                        <p class="font-label-sm text-label-sm text-on-surface-variant font-bold uppercase tracking-wider">
                            Start managing clients, projects, and invoices today
                        </p>
                    @endif
                </div>
            </div>
            <div class="relative scroll-reveal visible">
                <div class="absolute inset-0 bg-primary/10 blur-[120px] rounded-full scale-75"></div>
                <div class="glass-card rounded-[40px] p-8 shadow-[0_32px_80px_rgba(0,0,0,0.08)] border border-white/50 relative z-10 overflow-hidden group">
                    <div class="flex justify-between items-center mb-10">
                        <div class="font-title-md text-title-md text-on-background">Live Platform Snapshot</div>
                        <div class="flex gap-2.5">
                            <div class="w-3.5 h-3.5 rounded-full bg-red-400/20 border border-red-400/40"></div>
                            <div class="w-3.5 h-3.5 rounded-full bg-amber-400/20 border border-amber-400/40"></div>
                            <div class="w-3.5 h-3.5 rounded-full bg-emerald-400/20 border border-emerald-400/40"></div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-6 mb-10">
                        <div class="bg-white/40 border border-white/60 rounded-3xl p-6">
                            <div class="text-on-surface-variant font-label-sm mb-2 uppercase tracking-widest font-bold">Collected Revenue</div>
                            <div class="text-3xl text-primary font-black">{{ $formatted['totalRevenue'] }}</div>
                        </div>
                        <div class="bg-primary/5 border border-primary/10 rounded-3xl p-6">
                            <div class="text-primary/70 font-label-sm mb-2 uppercase tracking-widest font-bold">Projects</div>
                            <div class="text-3xl text-on-primary-fixed font-black">{{ $stats['activeProjects'] }} Active</div>
                        </div>
                    </div>
                    <div class="bg-white/50 backdrop-blur-sm rounded-3xl p-6 border border-white/40 h-56 flex items-end gap-3 px-8">
                        @foreach ($monthlyRevenue as $month)
                            @php
                                $barHeight = $maxMonthlyRevenue > 0
                                    ? max(12, (int) round(($month['total'] / $maxMonthlyRevenue) * 144))
                                    : 12;
                                $fillHeight = max(8, (int) round($barHeight * 0.65));
                            @endphp
                            <div class="w-full bg-primary/5 rounded-2xl relative overflow-hidden group-hover:opacity-90 transition-all duration-700" style="height: {{ $barHeight }}px" title="{{ $month['label'] }}: ${{ number_format($month['total'], 2) }}">
                                <div class="absolute bottom-0 w-full bg-gradient-to-t from-primary to-primary/80 rounded-t-xl" style="height: {{ $fillHeight }}px"></div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Floating Mini Card -->
                    <div class="absolute -bottom-4 -left-4 glass-card-dark rounded-3xl p-6 shadow-2xl z-20 flex items-center gap-5 border-white/10 group-hover:-translate-y-2 transition-transform duration-500">
                        <div class="w-14 h-14 bg-white/10 backdrop-blur text-white rounded-2xl flex items-center justify-center shadow-inner">
                            <span class="material-symbols-outlined text-3xl">payments</span>
                        </div>
                        <div>
                            <div class="font-label-sm text-white/60 uppercase tracking-widest font-bold">Latest Payment</div>
                            <div class="text-xl text-white font-black">{{ $formatted['latestPayment'] }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- 3. Stats Section -->
        <section class="bg-white border-y border-outline-variant/30 py-20 relative overflow-hidden">
            <div class="max-w-[1440px] mx-auto px-gutter grid grid-cols-2 md:grid-cols-4 gap-stack-lg text-center relative z-10">
                <div class="scroll-reveal visible">
                    <div class="text-5xl lg:text-6xl text-primary font-black mb-3">{{ $stats['users'] }}</div>
                    <div class="font-body-md text-on-surface-variant font-bold uppercase tracking-widest text-sm">Users</div>
                </div>
                <div class="scroll-reveal visible">
                    <div class="text-5xl lg:text-6xl text-primary font-black mb-3">{{ $formatted['clients'] }}</div>
                    <div class="font-body-md text-on-surface-variant font-bold uppercase tracking-widest text-sm">Clients</div>
                </div>
                <div class="scroll-reveal visible">
                    <div class="text-5xl lg:text-6xl text-primary font-black mb-3">{{ $formatted['completedProjects'] }}</div>
                    <div class="font-body-md text-on-surface-variant font-bold uppercase tracking-widest text-sm">Projects Completed</div>
                </div>
                <div class="scroll-reveal visible">
                    <div class="text-5xl lg:text-6xl text-primary font-black mb-3">{{ $formatted['totalRevenueCompact'] }}</div>
                    <div class="font-body-md text-on-surface-variant font-bold uppercase tracking-widest text-sm">Revenue Collected</div>
                </div>
                <!-- <div class="scroll-reveal visible">
                    <div class="text-5xl lg:text-6xl text-primary font-black mb-3">{{ $formatted['quotations'] }}</div>
                    <div class="font-body-md text-on-surface-variant font-bold uppercase tracking-widest text-sm">Quotations Sent</div>
                </div> -->
            </div>
        </section>
        <!-- 4. Workflow Section -->
        <section id="workflow" class="max-w-[1440px] mx-auto px-gutter py-section-gap-lg">
            <div class="text-center mb-24 scroll-reveal visible">
                <h2 class="font-headline-lg text-headline-lg text-on-background mb-6">The TamDan Lifecycle</h2>
                <p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl mx-auto leading-relaxed">Experience a seamless, high-fidelity flow from lead acquisition to project completion.</p>
            </div>
            <div class="relative scroll-reveal visible">
                <!-- Decorative Flow Line -->
                <div class="hidden lg:block absolute top-[44px] left-0 w-full flow-line z-0"></div>
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-y-12 lg:gap-x-4 relative z-10">
                    <!-- Workflow Steps -->
                    <div class="flex flex-col items-center group">
                        <div class="w-22 h-22 mb-6 flex flex-col items-center">
                            <div class="w-20 h-20 rounded-3xl bg-white border border-outline-variant/30 flex items-center justify-center shadow-xl shadow-black/5 group-hover:scale-110 group-hover:-translate-y-2 transition-all duration-500 bg-gradient-to-br from-white to-primary/5">
                                <span class="material-symbols-outlined text-primary text-4xl font-light">person_add</span>
                            </div>
                        </div>
                        <span class="font-label-sm font-black uppercase tracking-widest text-on-surface-variant text-xs mb-2">Lead</span>
                        <div class="w-1.5 h-1.5 rounded-full bg-primary/20 group-hover:bg-primary transition-colors"></div>
                    </div>
                    <div class="flex flex-col items-center group">
                        <div class="w-22 h-22 mb-6 flex flex-col items-center">
                            <div class="w-20 h-20 rounded-3xl bg-white border border-outline-variant/30 flex items-center justify-center shadow-xl shadow-black/5 group-hover:scale-110 group-hover:-translate-y-2 transition-all duration-500 bg-gradient-to-br from-white to-primary/5">
                                <span class="material-symbols-outlined text-primary text-4xl font-light">task_alt</span>
                            </div>
                        </div>
                        <span class="font-label-sm font-black uppercase tracking-widest text-on-surface-variant text-xs mb-2">Clients</span>
                        <div class="w-1.5 h-1.5 rounded-full bg-primary/20 group-hover:bg-primary transition-colors"></div>
                    </div>
                    <div class="flex flex-col items-center group">
                        <div class="w-22 h-22 mb-6 flex flex-col items-center">
                            <div class="w-20 h-20 rounded-3xl bg-white border border-outline-variant/30 flex items-center justify-center shadow-xl shadow-black/5 group-hover:scale-110 group-hover:-translate-y-2 transition-all duration-500 bg-gradient-to-br from-white to-primary/5">
                                <span class="material-symbols-outlined text-primary text-4xl font-light">assignment</span>
                            </div>
                        </div>
                        <span class="font-label-sm font-black uppercase tracking-widest text-on-surface-variant text-xs mb-2">Project</span>
                        <div class="w-1.5 h-1.5 rounded-full bg-primary/20 group-hover:bg-primary transition-colors"></div>
                    </div>
                    
                    <div class="flex flex-col items-center group">
                        <div class="w-22 h-22 mb-6 flex flex-col items-center">
                            <div class="w-20 h-20 rounded-3xl bg-white border border-outline-variant/30 flex items-center justify-center shadow-xl shadow-black/5 group-hover:scale-110 group-hover:-translate-y-2 transition-all duration-500 bg-gradient-to-br from-white to-primary/5">
                                <span class="material-symbols-outlined text-primary text-4xl font-light">request_quote</span>
                            </div>
                        </div>
                        <span class="font-label-sm font-black uppercase tracking-widest text-on-surface-variant text-xs mb-2">Quotation</span>
                        <div class="w-1.5 h-1.5 rounded-full bg-primary/20 group-hover:bg-primary transition-colors"></div>
                    </div>
                    <div class="flex flex-col items-center group">
                        <div class="w-22 h-22 mb-6 flex flex-col items-center">
                            <div class="w-20 h-20 rounded-3xl bg-white border border-outline-variant/30 flex items-center justify-center shadow-xl shadow-black/5 group-hover:scale-110 group-hover:-translate-y-2 transition-all duration-500 bg-gradient-to-br from-white to-primary/5">
                                <span class="material-symbols-outlined text-primary text-4xl font-light">receipt</span>
                            </div>
                        </div>
                        <span class="font-label-sm font-black uppercase tracking-widest text-on-surface-variant text-xs mb-2">Invoice</span>
                        <div class="w-1.5 h-1.5 rounded-full bg-primary/20 group-hover:bg-primary transition-colors"></div>
                    </div>
                    <div class="flex flex-col items-center group">
                        <div class="w-22 h-22 mb-6 flex flex-col items-center">
                            <div class="w-20 h-20 rounded-3xl bg-white border border-outline-variant/30 flex items-center justify-center shadow-xl shadow-black/5 group-hover:scale-110 group-hover:-translate-y-2 transition-all duration-500 bg-gradient-to-br from-white to-primary/5">
                                <span class="material-symbols-outlined text-primary text-4xl font-light">account_balance_wallet</span>
                            </div>
                        </div>
                        <span class="font-label-sm font-black uppercase tracking-widest text-on-surface-variant text-xs mb-2">Payment</span>
                        <div class="w-1.5 h-1.5 rounded-full bg-primary/20 group-hover:bg-primary transition-colors"></div>
                    </div>
                    <div class="flex flex-col items-center group">
                        <div class="w-22 h-22 mb-6 flex flex-col items-center">
                            <div class="w-20 h-20 rounded-3xl bg-primary flex items-center justify-center shadow-2xl shadow-primary/40 group-hover:scale-110 group-hover:-translate-y-2 transition-all duration-500">
                                <span class="material-symbols-outlined text-on-primary text-4xl font-light">celebration</span>
                            </div>
                        </div>
                        <span class="font-label-sm font-black uppercase tracking-widest text-on-surface text-xs mb-2">Done</span>
                        <div class="w-2 h-2 rounded-full bg-primary animate-ping"></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- 5. Features Section -->
        <section id="features" class="bg-[#001a41] py-section-gap-lg text-white relative overflow-hidden">
            <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-primary/10 blur-[150px] abstract-blob"></div>
            <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-tertiary/10 blur-[100px] abstract-blob"></div>
            <div class="max-w-[1440px] mx-auto px-gutter relative z-10">
                <div class="flex flex-col md:flex-row justify-between items-end mb-20 scroll-reveal visible">
                    <div class="max-w-2xl">
                        <h2 class="font-headline-lg text-headline-lg mb-6 leading-tight">Core Platform Capabilities</h2>
                        <p class="font-body-lg text-body-lg text-white/70">Precision-engineered tools designed for the world's highest growth service agencies.</p>
                    </div>
                    <a class="mt-8 md:mt-0 font-body-md font-bold text-primary hover:text-white transition-colors flex items-center gap-2 group" href="/admin">
                        Open admin dashboard <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </a>
                </div>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($features as $feature)
                        <div class="glass-card-dark p-10 rounded-[32px] hover-lift glow-border group scroll-reveal visible">
                            <div class="w-16 h-16 rounded-2xl bg-primary/10 border border-primary/20 text-primary flex items-center justify-center mb-8 group-hover:bg-primary group-hover:text-white transition-all duration-500">
                                <span class="material-symbols-outlined text-3xl">{{ $feature['icon'] }}</span>
                            </div>
                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 text-white/80 font-label-sm uppercase tracking-widest mb-4">
                                {{ number_format($feature['count']) }} {{ $feature['countLabel'] }}
                            </div>
                            <h3 class="font-title-md text-title-md mb-4 text-white">{{ $feature['title'] }}</h3>
                            <p class="font-body-md text-white/60 leading-relaxed">{{ $feature['description'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- 6. Industries Section - Marquee -->
        <section class="py-24 bg-white border-b border-outline-variant/30 overflow-hidden">
            <div class="max-w-[1440px] mx-auto px-gutter mb-12">
                <h3 class="font-headline-lg text-headline-lg text-center">Tailored for Every High-Growth Industry</h3>
            </div>
            <div class="relative flex overflow-hidden">
                <div class="marquee-track flex gap-6 px-4">
                    <!-- Set 1 -->
                    <div class="flex-shrink-0 flex items-center gap-4 bg-surface-container-low border border-outline-variant/40 px-8 py-5 rounded-2xl hover:border-primary transition-all cursor-pointer shadow-sm group">
                        <span class="material-symbols-outlined text-primary">code</span>
                        <span class="font-label-sm font-black uppercase tracking-widest text-on-surface">Web Dev</span>
                    </div>
                    <div class="flex-shrink-0 flex items-center gap-4 bg-surface-container-low border border-outline-variant/40 px-8 py-5 rounded-2xl hover:border-primary transition-all cursor-pointer shadow-sm group">
                        <span class="material-symbols-outlined text-primary">architecture</span>
                        <span class="font-label-sm font-black uppercase tracking-widest text-on-surface">Architects</span>
                    </div>
                    <div class="flex-shrink-0 flex items-center gap-4 bg-surface-container-low border border-outline-variant/40 px-8 py-5 rounded-2xl hover:border-primary transition-all cursor-pointer shadow-sm group">
                        <span class="material-symbols-outlined text-primary">campaign</span>
                        <span class="font-label-sm font-black uppercase tracking-widest text-on-surface">Marketing</span>
                    </div>
                    <div class="flex-shrink-0 flex items-center gap-4 bg-surface-container-low border border-outline-variant/40 px-8 py-5 rounded-2xl hover:border-primary transition-all cursor-pointer shadow-sm group">
                        <span class="material-symbols-outlined text-primary">brush</span>
                        <span class="font-label-sm font-black uppercase tracking-widest text-on-surface">Designers</span>
                    </div>
                    <div class="flex-shrink-0 flex items-center gap-4 bg-surface-container-low border border-outline-variant/40 px-8 py-5 rounded-2xl hover:border-primary transition-all cursor-pointer shadow-sm group">
                        <span class="material-symbols-outlined text-primary">engineering</span>
                        <span class="font-label-sm font-black uppercase tracking-widest text-on-surface">Construction</span>
                    </div>
                    <div class="flex-shrink-0 flex items-center gap-4 bg-surface-container-low border border-outline-variant/40 px-8 py-5 rounded-2xl hover:border-primary transition-all cursor-pointer shadow-sm group">
                        <span class="material-symbols-outlined text-primary">videocam</span>
                        <span class="font-label-sm font-black uppercase tracking-widest text-on-surface">Video Editors</span>
                    </div>
                    <div class="flex-shrink-0 flex items-center gap-4 bg-surface-container-low border border-outline-variant/40 px-8 py-5 rounded-2xl hover:border-primary transition-all cursor-pointer shadow-sm group">
                        <span class="material-symbols-outlined text-primary">handyman</span>
                        <span class="font-label-sm font-black uppercase tracking-widest text-on-surface">Repair</span>
                    </div>
                    <div class="flex-shrink-0 flex items-center gap-4 bg-surface-container-low border border-outline-variant/40 px-8 py-5 rounded-2xl hover:border-primary transition-all cursor-pointer shadow-sm group">
                        <span class="material-symbols-outlined text-primary">school</span>
                        <span class="font-label-sm font-black uppercase tracking-widest text-on-surface">Education</span>
                    </div>
                    <!-- Duplicate for Marquee -->
                    <div class="flex-shrink-0 flex items-center gap-4 bg-surface-container-low border border-outline-variant/40 px-8 py-5 rounded-2xl hover:border-primary transition-all cursor-pointer shadow-sm group">
                        <span class="material-symbols-outlined text-primary">code</span>
                        <span class="font-label-sm font-black uppercase tracking-widest text-on-surface">Web Dev</span>
                    </div>
                    <div class="flex-shrink-0 flex items-center gap-4 bg-surface-container-low border border-outline-variant/40 px-8 py-5 rounded-2xl hover:border-primary transition-all cursor-pointer shadow-sm group">
                        <span class="material-symbols-outlined text-primary">architecture</span>
                        <span class="font-label-sm font-black uppercase tracking-widest text-on-surface">Architects</span>
                    </div>
                    <div class="flex-shrink-0 flex items-center gap-4 bg-surface-container-low border border-outline-variant/40 px-8 py-5 rounded-2xl hover:border-primary transition-all cursor-pointer shadow-sm group">
                        <span class="material-symbols-outlined text-primary">campaign</span>
                        <span class="font-label-sm font-black uppercase tracking-widest text-on-surface">Marketing</span>
                    </div>
                    <div class="flex-shrink-0 flex items-center gap-4 bg-surface-container-low border border-outline-variant/40 px-8 py-5 rounded-2xl hover:border-primary transition-all cursor-pointer shadow-sm group">
                        <span class="material-symbols-outlined text-primary">brush</span>
                        <span class="font-label-sm font-black uppercase tracking-widest text-on-surface">Designers</span>
                    </div>
                    <div class="flex-shrink-0 flex items-center gap-4 bg-surface-container-low border border-outline-variant/40 px-8 py-5 rounded-2xl hover:border-primary transition-all cursor-pointer shadow-sm group">
                        <span class="material-symbols-outlined text-primary">engineering</span>
                        <span class="font-label-sm font-black uppercase tracking-widest text-on-surface">Construction</span>
                    </div>
                    <div class="flex-shrink-0 flex items-center gap-4 bg-surface-container-low border border-outline-variant/40 px-8 py-5 rounded-2xl hover:border-primary transition-all cursor-pointer shadow-sm group">
                        <span class="material-symbols-outlined text-primary">videocam</span>
                        <span class="font-label-sm font-black uppercase tracking-widest text-on-surface">Video Editors</span>
                    </div>
                </div>
            </div>
        </section>
        <!-- 7. Pricing Section -->
        <section id="pricing" class="max-w-[1440px] mx-auto px-gutter py-section-gap-lg">
            <div class="text-center mb-24 scroll-reveal visible">
                <h2 class="font-headline-lg text-headline-lg text-on-background mb-6">Scalable Plans for Every Stage</h2>
                <p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl mx-auto">
                    Choose a plan based on how many clients, projects, and invoices you need to manage in TamDan.
                </p>
            </div>
            <div class="grid md:grid-cols-3 gap-8 items-stretch">
                @foreach ($plans as $plan)
                    <div @class([
                        'p-12 rounded-[40px] hover-lift scroll-reveal shadow-sm flex flex-col visible relative',
                        'bg-on-primary-fixed text-on-primary border-[1.5px] border-primary shadow-[0_40px_80px_rgba(0,89,187,0.15)] lg:scale-105 z-10' => $plan['featured'],
                        'bg-white border border-outline-variant/30' => ! $plan['featured'],
                    ])>
                        @if ($plan['featured'] && ! empty($plan['badge']))
                            <div class="absolute -top-5 left-1/2 -translate-x-1/2 bg-primary text-on-primary px-6 py-2 rounded-full text-label-sm font-black tracking-widest uppercase shadow-xl">
                                {{ $plan['badge'] }}
                            </div>
                        @endif

                        <div class="font-title-md text-title-md mb-2 font-black">{{ $plan['name'] }}</div>
                        <p @class([
                            'font-body-md text-sm mb-6',
                            'opacity-70' => $plan['featured'],
                            'text-on-surface-variant' => ! $plan['featured'],
                        ])>{{ $plan['summary'] }}</p>

                        <div class="text-5xl font-black mb-10">
                            {{ $plan['price_label'] }}<span @class([
                                'text-body-lg font-bold ml-2',
                                'opacity-50' => $plan['featured'],
                                'text-on-surface-variant/60' => ! $plan['featured'],
                            ])>{{ $plan['period'] }}</span>
                        </div>

                        <ul class="space-y-6 mb-12 flex-grow">
                            @foreach ($plan['included'] as $feature)
                                <li @class([
                                    'flex items-center gap-4 font-semibold',
                                    'text-on-surface-variant' => ! $plan['featured'],
                                ])>
                                    <span @class([
                                        'material-symbols-outlined p-1 rounded-lg shrink-0',
                                        'text-primary-fixed-dim bg-white/10' => $plan['featured'],
                                        'text-primary bg-primary/5' => ! $plan['featured'],
                                    ])>check_circle</span>
                                    {{ $feature }}
                                </li>
                            @endforeach
                            @foreach ($plan['excluded'] as $feature)
                                <li class="flex items-center gap-4 font-semibold text-on-surface-variant/30">
                                    <span class="material-symbols-outlined shrink-0">cancel</span>
                                    {{ $feature }}
                                </li>
                            @endforeach
                        </ul>

                        <a @class([
                            'w-full py-5 rounded-2xl font-black text-center transition-all duration-300 block',
                            'bg-primary text-on-primary shadow-2xl shadow-primary/30 hover:scale-[1.02] active:scale-95 text-lg' => $plan['featured'],
                            'border border-outline-variant hover:bg-primary hover:text-white hover:border-primary' => ! $plan['featured'],
                        ]) href="/admin/login">
                            {{ $plan['cta'] }}
                        </a>
                    </div>
                @endforeach
            </div>
        </section>
        <!-- 8. FAQ Section -->
        <section id="faq" class="max-w-4xl mx-auto px-gutter py-section-gap-md scroll-reveal visible">
            <h2 class="font-headline-lg text-headline-lg text-center mb-20">Platform FAQs</h2>
            <div class="space-y-6">
                <details class="group bg-white border border-outline-variant/30 rounded-3xl overflow-hidden shadow-sm transition-all duration-300 open:shadow-md" open="">
                    <summary class="flex justify-between items-center p-8 cursor-pointer font-title-md font-black list-none hover:bg-surface-container transition-all">
                        Is there a free trial available?
                        <span class="material-symbols-outlined group-open:rotate-180 transition-transform text-primary font-black">expand_more</span>
                    </summary>
                    <div class="p-8 pt-0 text-on-surface-variant font-body-md leading-relaxed">
                        Sign in at the TamDan admin panel to manage clients, projects, quotations, invoices, and tasks from one dashboard. Contact your administrator if you need an account.
                    </div>
                </details>
                <details class="group bg-white border border-outline-variant/30 rounded-3xl overflow-hidden shadow-sm transition-all duration-300 open:shadow-md">
                    <summary class="flex justify-between items-center p-8 cursor-pointer font-title-md font-black list-none hover:bg-surface-container transition-all">
                        What can I manage inside TamDan?
                        <span class="material-symbols-outlined group-open:rotate-180 transition-transform text-primary font-black">expand_more</span>
                    </summary>
                    <div class="p-8 pt-0 text-on-surface-variant font-body-md leading-relaxed">
                        TamDan covers the full service workflow: clients, quotations, projects, tasks, invoices, and payment tracking. Each module is available in the admin panel with role-based access control.
                    </div>
                </details>
                <details class="group bg-white border border-outline-variant/30 rounded-3xl overflow-hidden shadow-sm transition-all duration-300 open:shadow-md">
                    <summary class="flex justify-between items-center p-8 cursor-pointer font-title-md font-black list-none hover:bg-surface-container transition-all">
                        How do I get started?
                        <span class="material-symbols-outlined group-open:rotate-180 transition-transform text-primary font-black">expand_more</span>
                    </summary>
                    <div class="p-8 pt-0 text-on-surface-variant font-body-md leading-relaxed">
                        Click Get Started to sign in at <a class="text-primary font-semibold hover:underline" href="/admin/login">/admin/login</a>. Add your first client, create a quotation, convert it to a project, and invoice when work is complete.
                    </div>
                </details>
            </div>
        </section>
        <!-- 9. Final CTA Section -->
        <section class="max-w-[1440px] mx-auto px-gutter py-section-gap-lg">
            <div class="bg-[#001a41] text-white rounded-[60px] p-16 lg:p-32 text-center relative overflow-hidden shadow-2xl scroll-reveal visible group">
                <!-- Decorative Elements -->
                <div class="absolute top-0 right-0 w-[800px] h-[800px] bg-primary/20 abstract-blob -translate-y-1/2 translate-x-1/2 group-hover:scale-110 transition-transform duration-1000"></div>
                <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-secondary-container/10 abstract-blob translate-y-1/2 -translate-x-1/2 group-hover:scale-110 transition-transform duration-1000"></div>
                <div class="relative z-10">
                    <h2 class="font-display-lg text-[48px] lg:text-[72px] leading-tight mb-10 max-w-4xl mx-auto">Empower Your Agency Performance Today</h2>
                    <p class="font-body-lg text-xl max-w-2xl mx-auto mb-16 opacity-70 leading-relaxed font-medium">Join thousands of professional service providers that trust TamDan to run their business operations every single day.</p>
                    <div class="flex flex-col sm:flex-row gap-8 justify-center items-center">
                        <a class="bg-white text-primary px-12 py-6 rounded-2xl font-black text-xl shadow-2xl shadow-white/5 hover-lift" href="/admin/login">Get Started Free</a>
                        <a class="border border-white/20 text-white px-12 py-6 rounded-2xl font-black text-xl hover:bg-white/10 transition-all backdrop-blur" href="/admin">Sign In</a>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- 10. Footer -->
    <footer class="bg-white pt-24 pb-12">
        <div class="max-w-[1440px] mx-auto px-gutter grid grid-cols-2 md:grid-cols-4 gap-y-16 lg:gap-x-12 mb-24">
            <div class="col-span-2 md:col-span-1">
                <div class="flex items-center gap-3 mb-8">
                    <img alt="TamDan Logo" class="h-10" src="{{ asset('images/tam_dan_logo.png') }}" />
                    <span class="font-display-lg text-title-md font-black tracking-tight text-on-primary-fixed">TamDan</span>
                </div>
                <p class="font-body-md text-on-surface-variant max-w-xs mb-8 leading-relaxed font-medium">The world-class platform for modern service providers. Scale your agency faster with TamDan.</p>
                <div class="flex gap-4">
                    <a class="w-12 h-12 rounded-2xl bg-surface-container-low flex items-center justify-center hover:bg-primary/10 transition-all border border-outline-variant/30 text-primary" href="#">
                        <span class="material-symbols-outlined text-2xl">public</span>
                    </a>
                    <a class="w-12 h-12 rounded-2xl bg-surface-container-low flex items-center justify-center hover:bg-primary/10 transition-all border border-outline-variant/30 text-primary" href="#">
                        <span class="material-symbols-outlined text-2xl">share</span>
                    </a>
                    <a class="w-12 h-12 rounded-2xl bg-surface-container-low flex items-center justify-center hover:bg-primary/10 transition-all border border-outline-variant/30 text-primary" href="#">
                        <span class="material-symbols-outlined text-2xl">chat</span>
                    </a>
                </div>
            </div>
            <div>
                <h4 class="font-label-sm font-black text-on-surface uppercase mb-8 tracking-[0.2em] text-xs">Product</h4>
                <ul class="space-y-5">
                    <li><a class="font-body-md text-on-surface-variant hover:text-primary transition-all font-semibold" href="#">Features</a></li>
                    <li><a class="font-body-md text-on-surface-variant hover:text-primary transition-all font-semibold" href="#">Workflow</a></li>
                    <li><a class="font-body-md text-on-surface-variant hover:text-primary transition-all font-semibold" href="#">Pricing</a></li>
                    <li><a class="font-body-md text-on-surface-variant hover:text-primary transition-all font-semibold" href="#">Security</a></li>
                </ul>
            </div>
            <div>
                <!-- <h4 class="font-label-sm font-black text-on-surface uppercase mb-8 tracking-[0.2em] text-xs">Company</h4>
                <ul class="space-y-5">
                    <li><a class="font-body-md text-on-surface-variant hover:text-primary transition-all font-semibold" href="#">About Us</a></li>
                    <li><a class="font-body-md text-on-surface-variant hover:text-primary transition-all font-semibold" href="#">Careers</a></li>
                    <li><a class="font-body-md text-on-surface-variant hover:text-primary transition-all font-semibold" href="#">Blog</a></li>
                    <li><a class="font-body-md text-on-surface-variant hover:text-primary transition-all font-semibold" href="#">Partners</a></li>
                </ul> -->
            </div>
            <div>
                <!-- <h4 class="font-label-sm font-black text-on-surface uppercase mb-8 tracking-[0.2em] text-xs">Support</h4>
                <ul class="space-y-5">
                    <li><a class="font-body-md text-on-surface-variant hover:text-primary transition-all font-semibold" href="#">Help Center</a></li>
                    <li><a class="font-body-md text-on-surface-variant hover:text-primary transition-all font-semibold" href="#">API Docs</a></li>
                    <li><a class="font-body-md text-on-surface-variant hover:text-primary transition-all font-semibold" href="#">Status</a></li>
                    <li><a class="font-body-md text-on-surface-variant hover:text-primary transition-all font-semibold" href="#">Contact Us</a></li>
                </ul> -->
            </div>
        </div>
        <div class="max-w-[1440px] mx-auto px-gutter pt-12 border-t border-outline-variant/30 flex flex-col md:flex-row justify-between items-center gap-6">
            <span class="font-body-md text-on-surface-variant/60 font-semibold">&copy; {{ date('Y') }} TamDan. All rights reserved.</span>
            <div class="flex gap-10">
                <a class="font-body-md text-on-surface-variant/60 hover:text-primary font-semibold" href="#">Terms of Service</a>
                <a class="font-body-md text-on-surface-variant/60 hover:text-primary font-semibold" href="#">Privacy Policy</a>
            </div>
        </div>
    </footer>
    <script>
        const observerOptions = {
            threshold: 0.15
        };
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);
        document.querySelectorAll('.scroll-reveal').forEach(el => observer.observe(el));
    </script>
</body>

</html>