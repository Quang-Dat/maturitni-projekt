import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                // nav
                "resources/js/nav.js",
                //welcome
                "resources/css/welcome.css",
                //kosik
                "resources/js/ls-kosik.js",
                "resources/js/kosik.js",
                "resources/js/uspech.js",
            ],
            refresh: true,
        }),
    ],
});
