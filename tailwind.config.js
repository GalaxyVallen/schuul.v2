/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: "class",
  content: [
    "./public/**/*.{html,php,js}",
    "./public/*.{html,php,js}",
    "./node_modules/flowbite/**/*.js",
  ],
  theme: {
    extend: {
      fontFamily: {
        display: ["system-ui", "-apple-system", "BlinkMacSystemFont"],
      },
    },
  },
  plugins: [require("flowbite/plugin")],
};
