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
                bgDark: '#0a0a0a',
                bgDarker: '#060606',
                cardGlass: 'rgba(255, 255, 255, 0.03)',
                cardBorder: 'rgba(255, 255, 255, 0.08)',
                brandGreen: '#22c55e',
                brandRed: '#ef4444',
                brandAccent: '#6366f1',
                brandAccentHover: '#4f46e5',
                textPrimary: '#f1f5f9',
                textMuted: '#64748b',
                sidebarBg: '#0f0f13',
                bgGlass: 'rgba(10, 10, 15, 0.5)',
                borderGlass: 'rgba(255, 255, 255, 0.08)',
                bloomIndigo: 'rgba(99, 102, 241, 0.15)',
                bloomGreen: 'rgba(34, 197, 94, 0.12)',
                goldReflect: 'rgba(234, 179, 8, 0.08)',
            },
            fontFamily: {
                sans: ['Inter', 'Plus Jakarta Sans', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
