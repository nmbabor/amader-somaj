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
// Neutral ramp spanning surface (#efefef) → dark (#1f201b).
const neutral = {
    50: '#efefef', 100: '#e6e6e5', 200: '#d6d6d4', 300: '#b9b9b5', 400: '#8e8e89',
    500: '#6a6a65', 600: '#4d4e49', 700: '#3a3b36', 800: '#2a2b26', 900: '#1f201b', 950: '#141510',
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
                // Primary green
                brand: green,
                primary: green,
                green: green,
                // Secondary blue (links, accents). Re-route info-ish hues to it.
                secondary: blue,
                blue: blue,
                sky: blue,
                indigo: blue,
                purple: blue,
                // Accent yellow (badges, warnings). Re-route warm hues to it.
                accent: yellow,
                amber: yellow,
                yellow: yellow,
                orange: yellow,
                rose: yellow,
                // Neutrals tuned to the palette (surface … dark)
                gray: neutral,
                // Explicit palette tokens
                surface: '#efefef',
                dark: '#1f201b',
            },
        },
    },

    plugins: [forms],
};
