import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './app/Filament/**/*.php',
    './resources/views/filament/**/*.blade.php',
    './vendor/filament/**/*.blade.php',
  ],
  
  theme: {
    extend: {
      fontFamily: {
        sans: [...defaultTheme.fontFamily.sans],
      },
      typography: {
        DEFAULT: {
          css: {
            maxWidth: '100%', // wider than default
            color: 'var(--tw-prose-body)',
            lineHeight: '1.75',
            p: {
              marginTop: 'unset',
              marginBottom: 'unset',
              lineHeight: '2',
            },
            'h2, h3, h4': {
              marginTop: '1.75em',
              marginBottom: '0.75em',
              fontWeight: '600',
            },
            img: {
              marginTop: '1.5em',
              marginBottom: '1.5em',
            },
            a: {
              textDecoration: 'none',
              fontWeight: '500',
              '&:hover': {
                textDecoration: 'underline',
              },
            },
            ul: {
              listStyleType: 'disc',
              marginTop: '1.25em',
              marginBottom: '1.25em',
              paddingLeft: '1.625em',
            },
            ol: {
              listStyleType: 'decimal',
              marginTop: '1.25em',
              marginBottom: '1.25em',
              paddingLeft: '1.625em',
            },
            blockquote: {
              fontWeight: '400',
              fontStyle: 'italic',
              borderLeftWidth: '0.25rem',
              paddingLeft: '1rem',
              quotes: '"\\201C""\\201D""\\2018""\\2019"',
            },
            code: {
              color: 'var(--tw-prose-code)',
              fontWeight: '500',
              padding: '0.25rem 0.375rem',
              borderRadius: '0.25rem',
              backgroundColor: 'var(--tw-prose-code-bg)',
            },
            pre: {
              backgroundColor: 'var(--tw-prose-pre-bg)',
              overflowX: 'auto',
              fontWeight: '400',
              fontSize: '0.875em',
              lineHeight: '1.7142857',
              marginTop: '1.7142857em',
              marginBottom: '1.7142857em',
              borderRadius: '0.375rem',
              paddingTop: '0.8571429em',
              paddingRight: '1.1428571em',
              paddingBottom: '0.8571429em',
              paddingLeft: '1.1428571em',
            },
            figure: {
              marginTop: '2em',
              marginBottom: '2em',
            },
            figcaption: {
              color: 'var(--tw-prose-captions)',
              fontSize: '0.875em',
              lineHeight: '1.4285714',
              marginTop: '0.8571429em',
              textAlign: 'center',
            },
            hr: {
              marginTop: '3em',
              marginBottom: '3em',
            },
            table: {
              fontSize: '0.875em',
              lineHeight: '1.7142857',
              marginTop: '2em',
              marginBottom: '2em',
              borderCollapse: 'collapse',
              width: '100%',
            },
            thead: {
              borderBottomWidth: '1px',
              borderBottomColor: 'var(--tw-prose-th-borders)',
            },
            'thead th': {
              color: 'var(--tw-prose-headings)',
              fontWeight: '600',
              verticalAlign: 'bottom',
              paddingRight: '0.5714286em',
              paddingBottom: '0.5714286em',
              paddingLeft: '0.5714286em',
              textAlign: 'left',
            },
            'tbody tr': {
              borderBottomWidth: '1px',
              borderBottomColor: 'var(--tw-prose-td-borders)',
            },
            'tbody tr:last-child': {
              borderBottomWidth: '0',
            },
            'tbody td': {
              verticalAlign: 'baseline',
              paddingTop: '0.5714286em',
              paddingRight: '0.5714286em',
              paddingBottom: '0.5714286em',
              paddingLeft: '0.5714286em',
            },
          },
        },
        
        // Extra small size
        xs: {
          css: {
            fontSize: '0.75rem',
            lineHeight: '1.6',
            p: {
              marginTop: '1em',
              marginBottom: '1em',
            },
            h1: {
              fontSize: '1.5em',
              marginTop: '0',
              marginBottom: '0.8333333em',
              lineHeight: '1.2',
            },
            h2: {
              fontSize: '1.25em',
              marginTop: '1.6em',
              marginBottom: '0.6em',
              lineHeight: '1.3',
            },
            h3: {
              fontSize: '1.125em',
              marginTop: '1.5em',
              marginBottom: '0.6em',
              lineHeight: '1.3',
            },
            'h4, blockquote, ul, ol': {
              marginTop: '1.1428571em',
              marginBottom: '1.1428571em',
            },
            img: {
              marginTop: '1.3333333em',
              marginBottom: '1.3333333em',
            },
            table: {
              fontSize: '0.75em',
            },
          },
        },
        
        // Small size
        sm: {
          css: {
            fontSize: '0.875rem',
            lineHeight: '1.7142857',
            p: {
              marginTop: '1.1428571em',
              marginBottom: '1.1428571em',
            },
            h1: {
              fontSize: '2em',
              marginTop: '0',
              marginBottom: '0.8571429em',
              lineHeight: '1.2',
            },
            h2: {
              fontSize: '1.4285714em',
              marginTop: '1.6em',
              marginBottom: '0.8em',
              lineHeight: '1.3',
            },
            h3: {
              fontSize: '1.2857143em',
              marginTop: '1.5em',
              marginBottom: '0.7em',
              lineHeight: '1.3',
            },
            'h4, blockquote, ul, ol': {
              marginTop: '1.1428571em',
              marginBottom: '1.1428571em',
            },
          },
        },
        
        // Medium (Base) - use DEFAULT
        
        // Large size
        lg: {
          css: {
            fontSize: '1.125rem',
            lineHeight: '1.7777778',
            p: {
              marginTop: '1.3333333em',
              marginBottom: '1.3333333em',
            },
            h1: {
              fontSize: '2.1111111em',
              marginTop: '0',
              marginBottom: '0.8em',
              lineHeight: '1.1',
            },
            h2: {
              fontSize: '1.6666667em',
              marginTop: '1.8666667em',
              marginBottom: '0.8666667em',
              lineHeight: '1.2',
            },
            h3: {
              fontSize: '1.3333333em',
              marginTop: '1.6666667em',
              marginBottom: '0.6666667em',
              lineHeight: '1.2',
            },
            'h4, blockquote, ul, ol': {
              marginTop: '1.2222222em',
              marginBottom: '1.2222222em',
            },
            table: {
              fontSize: '0.9em',
            },
          },
        },
        
        // Extra large size
        xl: {
          css: {
            fontSize: '1.25rem',
            lineHeight: '1.8',
            p: {
              marginTop: '1.2em',
              marginBottom: '1.2em',
            },
            h1: {
              fontSize: '2.375em',
              marginTop: '0',
              marginBottom: '0.8em',
              lineHeight: '1',
            },
            h2: {
              fontSize: '1.875em',
              marginTop: '1.5em',
              marginBottom: '0.8em',
              lineHeight: '1.1',
            },
            h3: {
              fontSize: '1.5em',
              marginTop: '1.5333333em',
              marginBottom: '0.6666667em',
              lineHeight: '1.1',
            },
            'h4, blockquote, ul, ol': {
              marginTop: '1.2em',
              marginBottom: '1.2em',
            },
            table: {
              fontSize: '0.9em',
            },
          },
        },
        
        // 2xl size
        '2xl': {
          css: {
            fontSize: '1.5rem',
            lineHeight: '1.6666667',
            p: {
              marginTop: '1.3333333em',
              marginBottom: '1.3333333em',
            },
            h1: {
              fontSize: '2.6666667em',
              marginTop: '0',
              marginBottom: '0.8333333em',
              lineHeight: '1',
            },
            h2: {
              fontSize: '2em',
              marginTop: '1.5em',
              marginBottom: '0.8333333em',
              lineHeight: '1.0833333',
            },
            h3: {
              fontSize: '1.5em',
              marginTop: '1.5em',
              marginBottom: '0.6666667em',
              lineHeight: '1.0833333',
            },
            'h4, blockquote, ul, ol': {
              marginTop: '1.3333333em',
              marginBottom: '1.3333333em',
            },
            table: {
              fontSize: '0.9em',
            },
          },
        },
      },
    },
  },
  
  plugins: [forms, typography],
}; 