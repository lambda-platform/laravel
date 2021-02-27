const mix = require('laravel-mix');
const path = require("path");
const fs = require('fs');
require("laravel-mix-merge-manifest");
// const lambdaRoot = "../../vue";
const lambdaRoot = "./node_modules/@lambda-platform";
const dataform_custom = "./dataform_custom/"

if (!fs.existsSync(dataform_custom)) {
    fs.mkdirSync(dataform_custom);
}

mix.webpackConfig({

    output: {
        chunkFilename: mix.inProduction()
            ? "assets/lambda/js/chunks/[name].[chunkhash].js"
            : "assets/lambda/js/chunks/[name].js"
    },
    resolve: {
        modules: [
            path.resolve(__dirname, './node_modules'),
            // path.resolve(`${lambdaRoot}/agent/`, 'node_modules'),
            // path.resolve(`${lambdaRoot}/dataform/`, 'node_modules'),
            // path.resolve(`${lambdaRoot}/datagrid/`, 'node_modules'),
            // path.resolve(`${lambdaRoot}/datasource/`, 'node_modules'),
            // path.resolve(`${lambdaRoot}/krud/`, 'node_modules'),
            // path.resolve(`${lambdaRoot}/moqup/`, 'node_modules'),
            // path.resolve(`${lambdaRoot}/page/`, 'node_modules'),
            // path.resolve(`${lambdaRoot}/puzzle/`, 'node_modules'),
            // path.resolve(`${lambdaRoot}/chart/`, 'node_modules'),
            // path.resolve(`${lambdaRoot}/notify/`, 'node_modules'),
            // path.resolve(`${lambdaRoot}/template/`, 'node_modules'),
        ],
        alias: {
            dataform_custom: path.resolve(__dirname, dataform_custom),
            vue$: "vue/dist/vue.common.js",
        },
        extensions: ["*", ".js", ".ts", ".vue", ".json"],
        symlinks: false
    }
});

mix.options({
    processCssUrls: false
}).setPublicPath("public");

mix.styles(
    [
        // `${lambdaRoot}/template/node_modules/` + "iview/dist/styles/iview.css",
        // `${lambdaRoot}/dataform/node_modules/` + "leaflet/dist/leaflet.css",
        // `${lambdaRoot}/dataform/node_modules/` + "leaflet-draw/dist/leaflet.draw.css",
        // `${lambdaRoot}/dataform/node_modules/`+"leaflet.fullscreen/Control.FullScreen.css",
        // `${lambdaRoot}/dataform/node_modules/`+"vue-multiselect/dist/vue-multiselect.min.css",
        // `${lambdaRoot}/datagrid/node_modules/`+"ag-grid-community/dist/styles/ag-grid.css",
        // `${lambdaRoot}/datagrid/node_modules/`+"ag-grid-community/dist/styles/ag-theme-balham.css",
        `./node_modules/` + "iview/dist/styles/iview.css",
        `./node_modules/` + "leaflet/dist/leaflet.css",
        `./node_modules/` + "leaflet-draw/dist/leaflet.draw.css",
        `./node_modules/`+"leaflet.fullscreen/Control.FullScreen.css",
        `./node_modules/`+"vue-multiselect/dist/vue-multiselect.min.css",
        `./node_modules/`+"ag-grid-community/dist/styles/ag-grid.css",
        `./node_modules/`+"ag-grid-community/dist/styles/ag-theme-balham.css",

    ],
    "public/assets/lambda/css/vendor.css"
);

mix.extract(
    ["ag-grid-community", "ag-grid-enterprise", "ag-grid-vue"],
    "public/assets/lambda/js/datagrid-vendor.js"
);

mix.extract(
    [
        "sql-formatter",
        "sql-parser",
        "jQuery-QueryBuilder",
        "axios",
        "iview",
        "leaflet",
        "esri-leaflet",
        "leaflet.fullscreen",
        "leaflet-draw",
        "leaflet-rotatedmarker",
        "leaflet.gridlayer.googlemutant",
        "lodash",
        "normalize.css",
        "vue",
        "vuex",
        "vue-router"
    ],
    "public/assets/lambda/js/vendor.js"
)
    .version()
    .mergeManifest();

const compileModules = () => {
    mix.js("resources/assets/admin/js/index.js", "public/assets/admin/js/app.js").vue();
    mix.sass("resources/assets/admin/scss/style.scss", "public/assets/admin/css/app.css");

    mix
        .js(`${lambdaRoot}/puzzle/src/index.js`, `public/assets/lambda/js/puzzle.js`).vue()
        .sass(`${lambdaRoot}/puzzle/src/scss/style.scss`, `public/assets/lambda/css/puzzle.css`)

        .js(`${lambdaRoot}/agent/src/index.js`, `public/assets/lambda/js/agent.js`).vue()
        .sass(`${lambdaRoot}/agent/src/scss/agent.scss`, `public/assets/lambda/css/agent.css`)

        .js(`${lambdaRoot}/agent/src/auth.js`, `public/assets/lambda/js/auth.js`).vue()
        .sass(`${lambdaRoot}/agent/src/scss/auth.scss`, `public/assets/lambda/css/auth.css`)

        .js(`${lambdaRoot}/krud/src/index.js`, "public/assets/lambda/js/krud.js").vue()
        .sass(`${lambdaRoot}/krud/src/scss/krud.scss`, `public/assets/lambda/css/krud.css`)

        .js(`${lambdaRoot}/datagrid/src/index.js`, `public/assets/lambda/js/datagrid.js`).vue()
        .js(`${lambdaRoot}/datagrid/src/index-builder.js`, `public/assets/lambda/js/datagrid-builder.js`).vue()
        .sass(`${lambdaRoot}/datagrid/src/scss/style.scss`, `public/assets/lambda/css/datagrid.css`)

        .js(`${lambdaRoot}/dataform/src/index.js`, `public/assets/lambda/js/dataform.js`).vue()
        .js(`${lambdaRoot}/dataform/src/index-builder.js`, `public/assets/lambda/js/dataform-builder.js`).vue()
        .sass(`${lambdaRoot}/dataform/src/scss/style.scss`, `public/assets/lambda/css/dataform.css`)

        .js(`${lambdaRoot}/datasource/src/index.js`, `public/assets/lambda/js/datasource.js`).vue()
        .sass(`${lambdaRoot}/datasource/src/scss/style.scss`, `public/assets/lambda/css/datasource.css`)

        .js(`${lambdaRoot}/page/src/index.js`, "public/assets/lambda/js/page.js").vue()
        .js(`${lambdaRoot}/page/src/page-nav.js`, "public/assets/lambda/js/page-nav.js").vue()

        .js(`${lambdaRoot}/moqup/src/index.js`, `public/assets/lambda/js/moqup.js`).vue()
        .sass(`${lambdaRoot}/moqup/src/scss/style.scss`, `public/assets/lambda/css/moqup.css`)

        .js(`${lambdaRoot}/chart/src/index.js`, "public/assets/lambda/js/chart.js").vue()
        .sass(`${lambdaRoot}/chart/src/scss/style.scss`, "public/assets/lambda/css/chart.css")

        .js(`${lambdaRoot}/notify/src/index.js`, `public/assets/lambda/js/notification.js`).vue()

        // .js("@lambda/logger/assets/index.js", "public/assets/lambda/logger.js")
        // .sass("@lambda/logger/assets/scss/logger.scss", "public/assets/lambda/logger.css")


        .sourceMaps()
};

const compileTemplate = () => {
    mix.js(`${lambdaRoot}/template/src/paper/index.js`, `public/assets/lambda/js/paper.js`).vue()
        .sass(`${lambdaRoot}/template/src/paper/scss/style.scss`, `public/assets/lambda/css/paper.css`);
};

console.log("COMPILING LAMBDA");
compileModules();
compileTemplate();
