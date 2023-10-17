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
      boxShadow: {
        '4xl': '0 4px 25px rgba(0, 36, 49, 0.15)',
        '3xl': '0 1px 4px rgba(146,161,176,0.15)',
      },
      clipPath: {
        mypolygon: "polygon(0 0, 100% 0%, 100% 100%, 0 90%)",
    },
    },
    colors: {
      body: "#f5f5f5",
      primary: "#004366",
      secondary: "#0081D5",
      footer: "#212121",
      html5: "#e34c26",
      css3: "#0081D5",
      php: "#787cb5",
      javascript: "#eace2c",
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

