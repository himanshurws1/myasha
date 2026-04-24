<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ $pageTitle ?? 'Myasha' }} | {{ $site['name'] }}</title>
        <meta
            name="description"
            content="{{ $site['name'] }} provides industrial process control and automation product information, contact details, and quote-ready category pages."
        >
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Rajdhani:wght@500;600;700&display=swap"
            rel="stylesheet"
        >
        <style>
            {!! file_get_contents(resource_path('css/app.css')) !!}
        </style>
    </head>
    <body>
        <div class="site-shell">
            <header class="topbar">
                <div class="container topbar__inner">
                    <span>{{ $site['address'] }}</span>
                    <div class="topbar__links">
                        <a href="{{ $site['phone_href'] }}">{{ $site['phone'] }}</a>
                        <a href="{{ $site['email_href'] }}">{{ $site['email'] }}</a>
                    </div>
                </div>
            </header>

            <nav class="navbar">
                <div class="container navbar__inner">
                    <div class="navbar__brand">
                        <a class="brand" href="{{ route('home') }}">
                            <span class="brand__mark">{{ $site['short_name'] }}</span>
                            <span class="brand__text">
                                <strong>{{ $site['name'] }}</strong>
                                <small>{{ $site['tagline'] }}</small>
                            </span>
                        </a>
                    </div>

                    <button
                        class="navbar__toggle"
                        type="button"
                        aria-expanded="false"
                        aria-controls="site-navigation"
                    >
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>

                    <div class="navbar__center" id="site-navigation">
                        <div class="navbar__links">
                            <a class="{{ request()->routeIs('home') ? 'is-active' : '' }}" href="{{ route('home') }}">Home</a>
                            <a class="{{ request()->routeIs('about') ? 'is-active' : '' }}" href="{{ route('about') }}">About</a>
                            <a class="{{ request()->routeIs('products.*') ? 'is-active' : '' }}" href="{{ route('products.index') }}">Products</a>
                            <div class="nav-dropdown {{ request()->routeIs('industries') ? 'is-active' : '' }}">
                                <a class="nav-dropdown__trigger" href="{{ route('industries') }}">
                                    <span>Industries & Applications</span>
                                    <span class="nav-dropdown__caret">+</span>
                                </a>

                                <div class="nav-dropdown__panel">
                                    <div class="nav-dropdown__intro">
                                        <p class="info-card__tag">Industries & Applications</p>
                                        <h3>Browse sectors directly from the menu.</h3>
                                        <p>
                                            This hover panel is added so the behavior feels much closer to the reference
                                            site, where cards show under the menu item.
                                        </p>
                                        <a class="text-link" href="{{ route('industries') }}">Open full page</a>
                                    </div>

                                    <div class="nav-dropdown__grid">
                                        @foreach ($site['industries_applications'] as $industry)
                                            <a class="nav-dropdown__card" href="{{ route('industries') }}#{{ $industry['slug'] }}">
                                                <span>{{ str_pad((string) ($loop->iteration), 2, '0', STR_PAD_LEFT) }}</span>
                                                <strong>{{ $industry['title'] }}</strong>
                                                <small>View application details</small>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <a class="{{ request()->routeIs('contact') ? 'is-active' : '' }}" href="{{ route('contact') }}">Contact</a>
                        </div>
                    </div>

                    <div class="navbar__cta">
                        <a class="button button--small" href="{{ route('contact') }}">Get a Quote</a>
                    </div>
                </div>
            </nav>

            <main>
                @yield('content')
            </main>

            <div class="chatbot" data-chatbot>
                <button class="chatbot__launcher" type="button" data-chatbot-toggle aria-expanded="false">
                    <span class="chatbot__launcher-badge">AI</span>
                    <span class="chatbot__launcher-text">Chat with Us</span>
                </button>

                <section class="chatbot__panel" data-chatbot-panel hidden>
                    <div class="chatbot__header">
                        <div>
                            <p class="info-card__tag">Live Assistant</p>
                            <h3>{{ $site['chatbot']['title'] }}</h3>
                            <p>{{ $site['chatbot']['subtitle'] }}</p>
                        </div>
                        <button class="chatbot__close" type="button" data-chatbot-close aria-label="Close chatbot">×</button>
                    </div>

                    <div class="chatbot__messages" data-chatbot-messages></div>

                    <div class="chatbot__prompts" data-chatbot-prompts>
                        @foreach ($site['chatbot']['quick_prompts'] as $prompt)
                            <button class="chatbot__prompt" type="button" data-chatbot-prompt="{{ $prompt }}">{{ $prompt }}</button>
                        @endforeach
                    </div>

                    <form class="chatbot__form" data-chatbot-form>
                        <textarea
                            class="chatbot__input"
                            name="message"
                            rows="1"
                            maxlength="2000"
                            placeholder="{{ $site['chatbot']['placeholder'] }}"
                        ></textarea>
                        <button class="button chatbot__send" type="submit">Send</button>
                    </form>
                </section>
            </div>

            <footer class="footer">
                <div class="container footer__grid">
                    <div>
                        <p class="section-tag">Myasha</p>
                        <h2>Industrial products, clear communication, and faster enquiries.</h2>
                        <p class="footer__copy">
                            This Laravel build keeps the industrial tone of the reference site while branding everything for {{ $site['name'] }}.
                        </p>
                    </div>

                    <div>
                        <h3>Quick Links</h3>
                        <ul class="footer__list">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('about') }}">About Us</a></li>
                            <li><a href="{{ route('products.index') }}">Products</a></li>
                            <li><a href="{{ route('industries') }}">Industries & Applications</a></li>
                            <li><a href="{{ route('contact') }}">Contact</a></li>
                        </ul>
                    </div>

                    <div>
                        <h3>Contact</h3>
                        <ul class="footer__list">
                            <li>{{ $site['address'] }}</li>
                            <li><a href="{{ $site['phone_href'] }}">{{ $site['phone'] }}</a></li>
                            <li><a href="{{ $site['email_href'] }}">{{ $site['email'] }}</a></li>
                        </ul>
                    </div>
                </div>
            </footer>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const nav = document.querySelector('.navbar');
                const toggle = document.querySelector('.navbar__toggle');
                const chatbot = document.querySelector('[data-chatbot]');
                const chatbotPanel = document.querySelector('[data-chatbot-panel]');
                const chatbotToggle = document.querySelector('[data-chatbot-toggle]');
                const chatbotClose = document.querySelector('[data-chatbot-close]');
                const chatbotMessages = document.querySelector('[data-chatbot-messages]');
                const chatbotForm = document.querySelector('[data-chatbot-form]');
                const chatbotInput = chatbotForm?.querySelector('textarea[name="message"]');
                const chatbotPromptButtons = document.querySelectorAll('[data-chatbot-prompt]');
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                const welcomeMessage = @json($site['chatbot']['welcome']);
                let chatHistory = [];

                if (!nav || !toggle) {
                    return;
                }

                toggle.addEventListener('click', () => {
                    const isOpen = nav.classList.toggle('is-open');
                    toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                });

                window.addEventListener('resize', () => {
                    if (window.innerWidth > 980) {
                        nav.classList.remove('is-open');
                        toggle.setAttribute('aria-expanded', 'false');
                    }
                });

                if (!chatbot || !chatbotPanel || !chatbotToggle || !chatbotMessages || !chatbotForm || !chatbotInput) {
                    return;
                }

                const createMessage = (role, text) => {
                    const item = document.createElement('div');
                    item.className = `chatbot__message chatbot__message--${role}`;
                    item.textContent = text;
                    chatbotMessages.appendChild(item);
                    chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
                };

                const renderMessages = () => {
                    chatbotMessages.innerHTML = '';

                    if (!chatHistory.length) {
                        createMessage('assistant', welcomeMessage);
                        return;
                    }

                    chatHistory.forEach((entry) => createMessage(entry.role, entry.content));
                };

                const setChatOpen = (isOpen) => {
                    chatbot.classList.toggle('is-open', isOpen);
                    chatbotPanel.hidden = !isOpen;
                    chatbotToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');

                    if (isOpen) {
                        renderMessages();
                        chatbotInput.focus();
                    }
                };

                const showTyping = () => {
                    const typing = document.createElement('div');
                    typing.className = 'chatbot__message chatbot__message--assistant chatbot__message--typing';
                    typing.textContent = 'Typing...';
                    typing.setAttribute('data-chatbot-typing', 'true');
                    chatbotMessages.appendChild(typing);
                    chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
                };

                const hideTyping = () => {
                    chatbotMessages.querySelector('[data-chatbot-typing="true"]')?.remove();
                };

                const submitMessage = async (text) => {
                    const trimmed = text.trim();

                    if (!trimmed) {
                        return;
                    }

                    const historyBeforeRequest = [...chatHistory];
                    chatHistory = [...chatHistory, { role: 'user', content: trimmed }].slice(-12);
                    renderMessages();
                    chatbotInput.value = '';
                    showTyping();

                    try {
                        const response = await fetch(@json(route('chatbot.message')), {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': csrfToken ?? '',
                            },
                            body: JSON.stringify({
                                message: trimmed,
                                history: historyBeforeRequest.slice(-10),
                            }),
                        });

                        const data = await response.json();
                        hideTyping();

                        if (!response.ok) {
                            const errorMessage = data.message || 'The chatbot is unavailable right now.';
                            chatHistory = [...chatHistory, { role: 'assistant', content: errorMessage }].slice(-12);
                            renderMessages();
                            return;
                        }

                        chatHistory = [...chatHistory, { role: 'assistant', content: data.reply }].slice(-12);
                        renderMessages();
                    } catch (error) {
                        hideTyping();
                        chatHistory = [
                            ...chatHistory,
                            { role: 'assistant', content: 'Connection issue. Please try again in a moment.' }
                        ].slice(-12);
                        renderMessages();
                    }
                };

                chatbotToggle.addEventListener('click', () => setChatOpen(!chatbot.classList.contains('is-open')));
                chatbotClose?.addEventListener('click', () => setChatOpen(false));

                chatbotForm.addEventListener('submit', (event) => {
                    event.preventDefault();
                    submitMessage(chatbotInput.value);
                });

                chatbotPromptButtons.forEach((button) => {
                    button.addEventListener('click', () => submitMessage(button.dataset.chatbotPrompt || ''));
                });

                renderMessages();
            });
        </script>
    </body>
</html>
