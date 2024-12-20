module.exports = {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            keyframes: {
                fadeInUp: {
                    '0%': { opacity: '0', transform: 'translateY(20px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
            },
            animation: {
                'fade-in-up': 'fadeInUp 2s ease-out forwards',
            },
        },
    },
    plugins: [
        require('daisyui'),
        function ({ addUtilities }) {
            const newUtilities = {
                '.no-spinners': {
                    '-moz-appearance': 'textfield',
                    '-webkit-appearance': 'none',
                    '&::-webkit-inner-spin-button': {
                        '-webkit-appearance': 'none',
                        margin: '0',
                    },
                    '&::-webkit-outer-spin-button': {
                        '-webkit-appearance': 'none',
                        margin: '0',
                    },
                },
            };
            addUtilities(newUtilities, ['responsive', 'hover']);
        },
    ],
};
