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
                hneda: "#4c311c",
                cervena: "#8B0000",
                zluta: "#FFD700",
                oranzova: "#F17F29",
            },
            screens: {
                lg: "1100px", // Nastavte vlastní hodnotu pro lg breakpoint
                "2xl": "1600px", // Nastavte vlastní hodnotu pro lg breakpoint
            },
            boxShadow: {
                xl: "0 20px 25px -5px rgba(0, 0, 0, 0.2), 0 10px 10px -5px rgba(0, 0, 0, 0.1)",
                "2xl": "0 25px 50px -12px rgba(0, 0, 0, 0.3)",
            },
        },
    },

    plugins: [forms],
};
