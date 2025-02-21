import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/welcome.css",
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/js/index.js",
                "resources/js/kosik.js",
                "resources/js/ls-kosik.js",
                "resources/js/nav.js",
                "resources/js/uspech.js",
                "resources/js/welcome.js",
            ],
            refresh: true,
        }),
    ],
});
