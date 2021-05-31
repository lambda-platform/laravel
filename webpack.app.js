let mix = require("laravel-mix");
const path = require("path");

require("laravel-mix-merge-manifest");

mix.webpackConfig({
    output: {
        chunkFilename: mix.inProduction()
            ? "assets/mcud/js/chunks/[name].[chunkhash].js"
            : "assets/mcud/js/chunks/[name].js"
    },

    resolve: {
        alias: {
            modules: path.resolve(__dirname, "./node_modules"),
            vue$: "vue/dist/vue.common.js"
        },
        extensions: ["*", ".js", ".ts", ".vue", ".json"],
        symlinks: false
    }
});

mix.options({
    processCssUrls: false
}).setPublicPath("public");

console.log("Compiling - client only app");
mix.js("resources/assets/web/js/index.js", "public/assets/mcud/js/app.js").vue();
mix.sass("resources/assets/web/scss/style.scss", "public/assets/mcud/css/app.css");
mix.sass("resources/assets/web/scss/theme.scss", "public/assets/mcud/css/theme.css");
mix.extract(
    [
        "axios",
        "vue",
        "vue-router"
    ],
    "public/assets/mcud/js/vendor.js"
);

if (mix.inProduction()) {
    mix.version();
}

mix.mergeManifest();
