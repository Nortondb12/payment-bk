import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import path from "path";
import tailwindcss from "tailwindcss";
import { viteStaticCopy } from "vite-plugin-static-copy";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "css/app.css",
                "js/app.js",
                "js/jquery.js",
                "js/flowbite.js",
                "js/toastr.js",
            ],
            refresh: true,
            buildDirectory: "themes/defaulttheme",
        }),
        viteStaticCopy({
            targets: [
                {
                    src: "assets",
                    dest: ".",
                },
            ],
        }),
    ],
    root: path.resolve(__dirname, "."),
    build: {
        outDir: path.resolve(__dirname, "../../public/themes/defaulttheme"),
        emptyOutDir: true,
    },
    resolve: {
        alias: {
            "@": path.resolve(__dirname, "js"),
            $: "jQuery",
        },
    },
    css: {
        postcss: {
            plugins: [
                tailwindcss({
                    config: path.resolve(__dirname, "tailwind.config.js"),
                }),
            ],
        },
    },
});
