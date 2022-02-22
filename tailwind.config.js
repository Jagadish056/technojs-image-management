module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                default: "Poppins, Times New Roman, sans-serif",
            },
        },
    },
    plugins: [require("@tailwindcss/aspect-ratio")],
};
