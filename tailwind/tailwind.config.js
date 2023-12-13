// Set the Preflight flag based on the build target.
const includePreflight = 'editor' === process.env._TW_TARGET ? false : true;

module.exports = {
	presets: [
		// Manage Tailwind Typography's configuration in a separate file.
		require('./tailwind-typography.config.js'),
	],
	content: [
		// Ensure changes to PHP files and `theme.json` trigger a rebuild.
		'./theme/**/*.php',
	],
	darkMode: true,
	theme: {
		// Extend the default Tailwind theme.
		extend: {
			container: {
				//maxWidth: '1200px',
				center: true,
        		padding: '2rem',
			  },
		},
	},
	corePlugins: {
		// Disable Preflight base styles in builds targeting the editor.
		preflight: includePreflight,
	},
	plugins: [
		// Add Tailwind Typography (via _tw fork).
		require('@_tw/typography'),

		// Extract colors and widths from `theme.json`.
		require('@_tw/themejson'),

		// Uncomment below to add additional first-party Tailwind plugins.
		// require('@tailwindcss/forms'),
		// require('@tailwindcss/aspect-ratio'),
		// require('@tailwindcss/container-queries'),

		function ({ addComponents }) {
			addComponents({
			  '.container': {
				maxWidth: '100%',
				'@screen sm': {
				  maxWidth: '640px',
				},
				'@screen md': {
				  maxWidth: '768px',
				},
				'@screen lg': {
				  maxWidth: '1180px',
				},
				'@screen xl': {
				  maxWidth: '1200px',
				},
			  }
			})
		  }
	],
};
