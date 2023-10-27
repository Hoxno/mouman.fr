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
        primary: "#004366",
        secondary: "#0081D5",
        "font-color": "#212121",
        dark__body: "#1A202C",          // Couleur d'arrière-plan du mode sombre
        dark__primary: "#00A5CF",       // Couleur principale en mode sombre
        dark__secondary: "#4299E1",     // Couleur secondaire en mode sombre
        "dark__font-color": "#ffffff",
        white: "#FFFFFF",
        black: "#000000",
        "red-50" : "rgb(254 242 242)",
        "red-100" : "rgb(254 226 226)",
        "red-200" : "rgb(254 202 202)",
        "red-300" : "rgb(252 165 165)",
        "red-400" : "rgb(248 113 113)",
        "red-500" : "rgb(239 68 68)",
        "red-600" : "rgb(220 38 38)",
        "red-700" : "rgb(185 28 28)",
        "red-800" : "rgb(153 27 27)",
        "red-900" : "rgb(127 29 29)",
        "red-950" : "rgb(69 10 10)é&",
        "gray-50" : "rgb(249 250 251)",
        "gray-100" : "rgb(243 244 246)",
        "gray-200" : "rgb(229 231 235)",
        "gray-300" : "rgb(209 213 219)",
        "gray-400" : "rgb(156 163 175)",
        "gray-500" : "rgb(107 114 128)",
        "gray-600" : "rgb(75 85 99)",
        "gray-700" : "rgb(55 65 81)",
        "gray-800" : "rgb(31 41 55)",
        "gray-900" : "rgb(17 24 39)",
        "indigo-100" : "rgb(224 231 255)",
        "indigo-200" : "rgb(199 210 254)",
        "indigo-300" : "rgb(165 180 252)",
        "indigo-400" : "rgb(129 140 248)",
        "indigo-500" : "rgb(99 102 241)",
        "indigo-600" : "rgb(79 70 229)",
        "indigo-700" : "rgb(67 56 202)",
        "indigo-800" : "rgb(55 48 163)",
        "indigo-900" : "rgb(49 46 129)",
        "indigo-950" : "rgb(30 27 75)",
        "green-600" : "rgb(22 163 74)",
        invalid: "#DB464B",
        footer: "#212121",
        HTML5: "#e34c26",
        CSS3: "#264de4",
        PHP: "#787cb5",
        javascript: "#eace2c",
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
