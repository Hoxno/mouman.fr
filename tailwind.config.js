const defaultTheme = require('tailwindcss/defaultTheme')
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Inter var', ...defaultTheme.fontFamily.sans],
      },
      clipPath: {
        mypolygon: "polygon(0 0, 100% 0%, 100% 100%, 0 90%)",
    },
    },
    colors: {
      primary: "#004366",
      secondary: "#0081D5",
    }
  },
  plugins: [
    require('@tailwindcss/forms'),
    require("@tailwindcss/forms")({
      strategy: 'class', // only generate classes
    }),
    require('tailwind-clip-path'),
  ],
}

