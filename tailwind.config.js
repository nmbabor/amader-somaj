import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/*
 | Brand palette (exact values requested):
 |   primary   #0ca85e  green   — buttons, CTAs, highlights
 |   secondary #0061fe  blue    — links, accents
 |   accent    #ffd101  yellow  — badges, warnings, hover states
 |   dark      #1f201b  near-black — text, dark backgrounds
 |   white     #ffffff  — main background
 |   surface   #efefef  light gray — cards, sections
 |
 | Tints/shades below are derived from those anchors so existing utility
 | classes (e.g. bg-brand-700, text-gray-500) resolve onto the palette.
 */
const green = {
    50: '#e9f9f1', 100: '#c8f0db', 200: '#93e2bb', 300: '#56cf95', 400: '#1fb974',
    500: '#0ca85e', 600: '#0a9351', 700: '#098044', 800: '#0a6638', 900: '#0a5430', 950: '#04311b',
};
const blue = {
    50: '#eaf1ff', 100: '#d6e4ff', 200: '#b3ccff', 300: '#80a8ff', 400: '#4d83ff',
    500: '#1a78ff', 600: '#0061fe', 700: '#0052d6', 800: '#0043ad', 900: '#003a91', 950: '#00214d',
};
const yellow = {
    50: '#fffbe6', 100: '#fff6c2', 200: '#ffec85', 300: '#ffe14d', 400: '#ffd827',
    500: '#ffd101', 600: '#e0b300', 700: '#b88c00', 800: '#946f00', 900: '#7a5c00', 950: '#463300',
};

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './app/Http/Controllers/**/*.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                // Bengali-first font stack (Hind Siliguri + Noto Sans Bengali)
                sans: ['"Hind Siliguri"', '"Noto Sans Bengali"', ...defaultTheme.fontFamily.sans],
                bangla: ['"Hind Siliguri"', '"Noto Sans Bengali"', 'sans-serif'],
            },
            colors: {
                // Palette tokens used by the PUBLIC frontend. The admin panel
                // keeps Tailwind's default green/blue/amber/gray, so it is left
                // visually unchanged (per request: frontend only).
                brand: green,        // primary green — frontend buttons/CTAs/nav/hero/footer
                primary: green,
                secondary: blue,     // links, accents
                accent: yellow,      // badges, highlights
                surface: '#efefef',  // cards, sections
                dark: '#1f201b',     // text, dark backgrounds
            },
        },
    },

    plugins: [forms],
};
