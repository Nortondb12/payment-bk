import react from "@vitejs/plugin-react";
import tailwindcss from "@tailwindcss/vite";
import laravel from "laravel-vite-plugin";
import path from "path";
import { defineConfig } from "vite";
import { viteStaticCopy } from "vite-plugin-static-copy";

export default defineConfig({
    plugins: [
        laravel({
            input: ["src/css/app.css", "src/app.tsx"],
            refresh: true,
            buildDirectory: "themes/nova",
        }),
        react(),
        tailwindcss(),
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
        outDir: path.resolve(__dirname, "../../public/themes/nova"),
        emptyOutDir: true,
    },
    resolve: {
        alias: {
            "@": path.resolve(__dirname, "src"),
        },
    },
});
