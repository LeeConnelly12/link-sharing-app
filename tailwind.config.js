import defaultTheme from 'tailwindcss/defaultTheme'
import forms from '@tailwindcss/forms'

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './resources/js/**/*.vue',
  ],

  theme: {
    extend: {
      fontFamily: {
        sans: ['Instrument Sans', ...defaultTheme.fontFamily.sans],
      },
      colors: {
        purple: '#633CFF',
        'purple-hover-color': '#BEADFF',
        'light-purple': '#EFEBFF',
        'normal-gray': '#737373',
        'dark-gray': '#333',
        'light-gray': '#FAFAFA',
        borders: '#D9D9D9',
        violet: {
          600: '#BEADFF',
        },
      },
    },
  },

  plugins: [forms],
}
