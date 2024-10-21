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
        'supaw_green' : '#31DB7A',
        'comp_orange' : '#FF934F',
      },
      spacing: {
        '18' : '4.5rem',
        '32' : '7.5rem',
        '110': '110vh'
      },
      screens: {
        '2xl' : '1920px'
      },
      fontFamily: {
        'dmsans': ['Dm Sans']
      }
    },
  },
  plugins: [
    require('flowbite/plugin')
  ],
}

