/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './app/Filament/**/*.php',
  ],
  theme: {
    extend: {
      fontFamily: {
        'playfair': ['"Playfair Display"', 'serif'],
        'nunito':   ['Nunito', 'sans-serif'],
      },
      colors: {
        'green-deep':   '#1e3a0f',
        'green-mid':    '#2f5c1a',
        'green-accent': '#4e8b2c',
        'green-light':  '#7ab648',
        'cream':        '#f4efe6',
        'cream-dark':   '#e8e0d0',
        'gold':         '#c8861a',
        'gold-light':   '#e8a832',
      },
      keyframes: {
        fadeUp: {
          from: { opacity: '0', transform: 'translateY(30px)' },
          to:   { opacity: '1', transform: 'translateY(0)' },
        },
        bounce: {
          '0%,100%': { transform: 'translateX(-50%) translateY(0)' },
          '50%':     { transform: 'translateX(-50%) translateY(8px)' },
        },
      },
      animation: {
        'fade-up': 'fadeUp 0.9s ease both',
        'bounce':  'bounce 2s infinite',
      },
    },
  },
  plugins: [],
};
