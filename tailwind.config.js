/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {
      colors: {
        'darkgreen' : '#052E16',
        'supaw-green' : '#31DB7A',
        'comp-orange' : '#FF934F',
      },
      spacing: {
        '18' : '4.5rem'
      }
    },
  },
  plugins: [
    require('flowbite/plugin')
  ],
}

