import '../css/app.css';
import './bootstrap';

import { createInertiaApp } from '@inertiajs/vue3';
import axios from 'axios';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

function readCookie(name) {
    return document.cookie.split('; ').find((c) => c.startsWith(name + '=')) || '';
}

async function ensureCsrfCookie() {
    const hasCookie = Boolean(readCookie('XSRF-TOKEN'));
    if (!hasCookie) {
        try {
            await axios.get('/sanctum/csrf-cookie');
        } catch (e) {
        }
    }
}

(async () => {
await ensureCsrfCookie();

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue'),
        ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
})();
