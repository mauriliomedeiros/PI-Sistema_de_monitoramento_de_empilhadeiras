const Encore = require('@symfony/webpack-encore');

// Manually configure the runtime environment if not already configured yet by the "encore" command.
// It's useful when you use tools that rely on webpack.config.js file.
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    // directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // public path used by the web server to access the output path
    .setPublicPath('/build')

    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    // enables Sass/SCSS support
    .enableSassLoader()
    .splitEntryChunks()
    .enableSingleRuntimeChunk()
    .addEntry('app', './assets/app.js') // Arquivo principal JS
    .addStyleEntry('style', './assets/styles/app.scss')

    .configureBabel((config) => {
        config.plugins.push('@babel/plugin-proposal-class-properties');
    })

    // enables @babel/preset-env polyfills
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = 3;
    })

    .autoProvidejQuery()
    .enableLessLoader()
    .autoProvideVariables({
        moment: 'moment',
        bootbox: 'bootbox',
    })


; // Arquivo principal CSS


var config = Encore.getWebpackConfig();
var path = require('path');
config.resolve.alias = {
    // Force all modules to use the same jquery version.
    'jquery': path.join(__dirname, 'node_modules/jquery/dist/jquery')
};

module.exports = {
    module: {
        loaders: [
            {test: /jquery-mousewheel/, loader: "imports?define=>false&this=>window"},
            {test: /malihu-custom-scrollbar-plugin/, loader: "imports?define=>false&this=>window"}
        ]
    }
};

module.exports = {
    plugins: [
        new webpack.ProvidePlugin({
            $: 'jquery',
            jQuery: 'jquery',
            'window.$': 'jquery',
            'window.jQuery': 'jquery',
            'top.$': 'jquery', // Se necessário
            'top.jQuery': 'jquery', // Se necessário
            'bootbox': 'bootbox', // Se necessário
            'moment': 'moment' // Se necessário
        })
    ]
};


module.exports = Encore.getWebpackConfig();
