import colors from 'tailwindcss/colors'
import forms from '@tailwindcss/forms'
import typography from '@tailwindcss/typography'
const defaultTheme = require('tailwindcss/defaultTheme');

export default {
  content: ['./resources/**/*.blade.php', './vendor/filament/**/*.blade.php'],
  theme: {
    extend: {
      colors: {
        danger: colors.rose,
        primary: { ...colors.orange, DEFAULT: colors.orange[600] },
        'primary-foreground': colors.gray[50],
        bg: colors.white,
        success: colors.green,
        warning: colors.yellow,
        foreground: colors.gray[50],

        'clrprimary': '#E65728',
        'clraccent': '#2E2E2E',
      },
      fontFamily: {
          sans: ['Golos Text', ...defaultTheme.fontFamily.sans],
          'GoldMan': 'Goldman'
      }
    },
  },
  plugins: [forms, typography],
}
