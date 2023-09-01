/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
      "app/Views/**/*.php",
      "public/assets/js/**/*.js",
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