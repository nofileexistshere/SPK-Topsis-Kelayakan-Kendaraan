import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                lato: ['Lato'],
                handjet: ['Handjet'],
            },
            colors: {
                greenPrimary: "#000000",
                greenSecondary: "#CD5656",
                backgroundPrimary: "#E55050 ",
                backgroundSecondary: "#AF3E3E",
                dark: "#1B1B1B",
            }
        },
    },

    plugins: [
        forms,
        require("daisyui"),
        require('tailwind-scrollbar')({ nocompatible: true }),
    ],
};
