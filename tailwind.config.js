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
                primary: { ...colors.green, DEFAULT: colors.green[600] },
                bg: colors.white,
                success: colors.green,
                warning: colors.yellow,

                'clrprimary': '#E65728',
                'clraccent': '#2E2E2E',
            },
            // fontFamily: {
            //     sans: ['Roboto', ...defaultTheme.fontFamily.sans],
            //     'GoldMan': 'Goldman'
            // }
        },
    },
    plugins: [forms, typography],
}
