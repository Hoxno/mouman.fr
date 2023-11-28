const defaultTheme = require('tailwindcss/defaultTheme')
import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    darkMode: [
      'class',
    ],

    theme: {
      extend: {
        fontFamily: {
          sans: ['Inter var', ...defaultTheme.fontFamily.sans],
        },
        width: {
          '80': '80%',
        },
        boxShadow: {
          '4xl': '0 4px 25px rgba(0, 36, 49, 0.15)',
          '3xl': '0 1px 4px rgba(146,161,176,0.15)',
        },
        clipPath: {
          mypolygon: "polygon(0 0, 100% 0%, 100% 100%, 0 90%)",
        },
      },
      colors: {
        body: "#f8f7fa",
        primary: {
          50: "#eef9ff",
          100: "#dcf4ff",
          200: "#b2ebff",
          300: "#6dddff",
          400: "#20cbff",
          500: "#00b5ff",
          600: "#0091df",
          700: "#0073b4",
          800: "#006294",
          900: "#004366",
          950: "#003351",
        },
        primary__dark: {
          50: "#eef9ff",
          100: "#dcf4ff",
          200: "#b2ebff",
          300: "#6dddff",
          400: "#20cbff",
          500: "#00b5ff",
          600: "#0091df",
          700: "#0073b4",
          800: "#006294",
          900: "#004366",
          950: "#0A2647",
        },
        secondary: "#0081D5",
        "font-color": "#212121",
        dark__body: "#1A202C",          // Couleur d'arrière-plan du mode sombre
        dark__primary: "#00A5CF",       // Couleur principale en mode sombre
        dark__secondary: "#4299E1",     // Couleur secondaire en mode sombre
        "dark__font-color": "#ffffff",
        white: "#FFFFFF",
        black: "#000000",
        'red': {
            '50': '#fef2f2',
            '100': '#fee2e2',
            '200': '#fecaca',
            '300': '#fca5a5',
            '400': '#f87171',
            '500': '#ef4444',
            '600': '#dc2626',
            '700': '#b91c1c',
            '800': '#991b1b',
            '900': '#7f1d1d',
            '950': '#450a0a',
        },
        'gray': {
            '50': '#f9fafb',
            '100': '#f3f4f6',
            '200': '#e5e7eb',
            '300': '#d1d5db',
            '400': '#9ca3af',
            '500': '#6b7280',
            '600': '#4b5563',
            '700': '#374151',
            '800': '#1f2937',
            '900': '#111827',
            '950': '#030712',
        },
        'indigo': {
            '50': '#eef2ff',
            '100': '#e0e7ff',
            '200': '#c7d2fe',
            '300': '#a5b4fc',
            '400': '#818cf8',
            '500': '#6366f1',
            '600': '#4f46e5',
            '700': '#4338ca',
            '800': '#3730a3',
            '900': '#312e81',
            '950': '#1e1b4b',
        },
        'green' : {
            '50': '#f0fdf4',
            '100': '#dcfce7',
            '200': '#bbf7d0',
            '300': '#86efac',
            '400': '#4ade80',
            '500': '#22c55e',
            '600': '#16a34a',
            '700': '#15803d',
            '800': '#166534',
            '900': '#14532d',
            '950': '#052e16',
        },
        invalid: "#DB464B",
        footer: "#212121",
        HTML5: "#e34c26",
        CSS3: "#264de4",
        PHP: "#787cb5",
        JAVASCRIPT: "#eace2c",
      },
    },
    plugins: [
      require('@tailwindcss/forms'),
      require("@tailwindcss/forms")({
        strategy: 'class', // only generate classes
      }),
      require('tailwind-clip-path'),
    ],

    plugins: [forms],
};
