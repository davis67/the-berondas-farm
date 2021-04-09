const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
    theme: {
        extend: {
            fontFamily: {
                sans: ["Inter var", ...defaultTheme.fontFamily.sans],
            },
            spacing: {
                44: "11rem",
                70: "17.5rem",
                76: "19rem",
                104: "26rem",
                175: "43.75rem",
            },
            boxShadow: {
                card: "4px 4px 15px 0 rgba(36, 37, 38, 0.08)",
                dialog: "3px 4px 15px 0 rgba(36, 37, 38, 0.22)",
            },
        },
    },
    variants: {
        extend: {
            backgroundColor: ["active"],
        },
    },
    purge: {
        content: [
            "./app/**/*.php",
            "./resources/**/*.html",
            "./resources/**/*.js",
            "./resources/**/*.jsx",
            "./resources/**/*.ts",
            "./resources/**/*.tsx",
            "./resources/**/*.php",
            "./resources/**/*.vue",
            "./resources/**/*.twig",
        ],
        options: {
            defaultExtractor: (content) =>
                content.match(/[\w-/.:]+(?<!:)/g) || [],
            whitelistPatterns: [/-active$/, /-enter$/, /-leave-to$/, /show$/],
        },
    },
    plugins: [
        require("@tailwindcss/ui"),
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
    ],
};
