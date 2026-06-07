const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                bgDark: 'var(--bg-dark)',
                bgDarker: 'var(--bg-darker)',
                cardGlass: 'var(--card-glass)',
                cardBorder: 'var(--card-border)',
                brandGreen: '#22c55e',
                brandRed: '#ef4444',
                brandAccent: '#6366f1',
                brandAccentHover: '#4f46e5',
                textPrimary: 'var(--text-primary)',
                textMuted: 'var(--text-muted)',
                sidebarBg: 'var(--sidebar-bg)',
                bgGlass: 'var(--bg-glass)',
                borderGlass: 'var(--border-glass)',
                bloomIndigo: 'var(--bloom-indigo)',
                bloomGreen: 'var(--bloom-green)',
                goldReflect: 'var(--gold-reflect)',
            },
            fontFamily: {
                sans: ['Inter', 'Plus Jakarta Sans', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
