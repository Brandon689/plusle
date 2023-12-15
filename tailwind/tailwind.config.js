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
	darkMode: false,
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
		require("daisyui"),
		// Add Tailwind Typography (via _tw fork).
		require('@_tw/typography'),
		// Extract colors and widths from `theme.json`.
		require('@_tw/themejson'),
		require('@tailwindcss/aspect-ratio'),
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
				  maxWidth: '1280px',
				},
				'@screen xl': {
				  maxWidth: '1440px',
				},
			  }
			})
		  }
	],

	daisyui: {
		themes: [
			"light",
			"dark",
			"cupcake",
			"bumblebee",
			"emerald",
			"corporate",
			"synthwave",
			"retro",
			"cyberpunk",
			"valentine",
			"halloween",
			"garden",
			"forest",
			"aqua",
			"lofi",
			"pastel",
			"fantasy",
			"wireframe",
			"black",
			"luxury",
			"dracula",
			"cmyk",
			"autumn",
			"business",
			"acid",
			"lemonade",
			"night",
			"coffee",
			"winter",
			"dim",
			"nord",
			"sunset",
		  ],
		darkTheme: "halloween", // name of one of the included themes for dark mode
		base: true, // applies background color and foreground color for root element by default
		styled: true, // include daisyUI colors and design decisions for all components
		utils: true, // adds responsive and modifier utility classes
		prefix: "", // prefix for daisyUI classnames (components, modifiers and responsive class names. Not colors)
		logs: true, // Shows info about daisyUI version and used config in the console when building your CSS
		themeRoot: ":root", // The element that receives theme color CSS variables
	  },
};
