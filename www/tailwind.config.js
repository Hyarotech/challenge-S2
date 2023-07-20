/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
      "app/Views/**/*.php",
      "public/assets/js/**/pages/*.js",
  ],
  theme: {
    extend: {
      container:{
        center: true,
      }
    },
  },
  plugins: [require("daisyui")],
}