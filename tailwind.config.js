/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "*.{php,js}",
    "../node_modules/flowbite/**/*.js",
    "views/*.{php,js}",
  ],
  theme: {
    extend: {},
  },
  plugins: [require("flowbite/plugin")],
};
