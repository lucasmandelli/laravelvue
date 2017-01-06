var webpack = require('webpack');

module.exports = {
    entry: {
        admin: './resources/assets/admin/js/admin.js',
        spa: './resources/assets/spa/js/spa.js'
    },
    output: {
        path: __dirname + '/public/build', // diretório onde ficam os arquivos empacotados
        filename: '[name].bundle.js', // nome do arquivo final
        publicPath: '/build/' // diretório principal dos arquivos empacotados
    },
    plugins: [
        new webpack.ProvidePlugin({
            'window.$': 'jquery',
            'window.jQuery': 'jquery'
        })
    ],
    module: {
        loaders: [
            {
                test: /\.js$/,
                exclude: /(node_modules|bower_components)/,
                loader: 'babel'
            },
            {
                test: /\.vue$/,
                loader: 'vue',
            }
        ]
    }
};