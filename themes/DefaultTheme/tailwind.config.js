const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
    content: [
        "./views/**/*.blade.php",
        "./js/**/*.{js,vue,ts}",
        "./node_modules/flowbite/**/*.js",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                danger: "#e3342f",
            },
        },
    },

    plugins: [
        require("@tailwindcss/forms")({
            strategy: "base",
        }),
        require("@tailwindcss/typography"),
        require("flowbite/plugin"),
    ],
};
