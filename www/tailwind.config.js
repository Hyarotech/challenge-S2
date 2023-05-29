/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
      "app/Views/**/*.php",
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