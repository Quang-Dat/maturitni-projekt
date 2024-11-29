import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Montserrat", ...defaultTheme.fontFamily.sans],
                playfair: ['"Playfair Display"', "serif"],
            },
            colors: {
                cerna: "#0E1111", // Přidání vlastní barvy
                bila: "#FAF8F5",
                hneda: "#583622",
                cervena: "#8B0000",
                zluta: "#FFD700",
                oranzova: "#F17F29",
            },
            screens: {
                lg: "1100px", // Nastavte vlastní hodnotu pro lg breakpoint
                "2xl": "1600px", // Nastavte vlastní hodnotu pro lg breakpoint
            },
        },
    },

    plugins: [forms],
};
