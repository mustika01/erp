const colors = require('tailwindcss/colors')
const plugin = require('tailwindcss/plugin')
const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
    content: [
        './resources/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
        './packages/kumi/tobira-kyoka-kensa/views/**/*.blade.php',
        './packages/kumi/jinzai-kiosk/views/**/*.blade.php',
        './packages/kumi/kanri/views/**/*.blade.php',
        './packages/kumi/norikumi/views/**/*.blade.php',
        './packages/kumi/sousa/views/**/*.blade.php',
        './packages/kumi/senzou/views/**/*.blade.php',
        './node_modules/flowbite/**/*.js',
    ],

    darkMode: 'class',

    theme: {
        extend: {
            colors: {
                danger: colors.rose,
                primary: colors.blue,
                success: colors.green,
                warning: colors.yellow,
            },

            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                mono: ['JetBrains Mono', ...defaultTheme.fontFamily.mono],
            },
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        require('flowbite/plugin'),
        plugin(function ({ addUtilities }) {
            addUtilities({
                '.checked-group': {},
            })
        }),
    ],
}
