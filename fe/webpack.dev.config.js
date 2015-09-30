var path = require("path");
var webpack = require('webpack');
var node_modules = path.resolve(__dirname, 'node_modules');
var pkg = require(path.join(process.cwd(), 'package.json'));

module.exports = {
    entry: {
        index: ['webpack/hot/dev-server', pkg.entry.index],
        login: ['webpack/hot/dev-server', pkg.entry.login],
        adList: ['webpack/hot/dev-server', pkg.entry.adList],
        adEdit: ['webpack/hot/dev-server', pkg.entry.adEdit],
        wxMenu: ['webpack/hot/dev-server', pkg.entry.wxMenu]
    },

    resolve: {
        extensions: ['', '.js', '.jsx']
    },
    output: {
        path: path.join(process.cwd(), './dist/'),
        filename: '[name].js',
        chunkFilename: '[name].js'
    },

    devtool: '#source-map',

    module: {
        loaders: [
            {
                test: /\.jsx?$/,
                exclude: /node_modules/,
                loader: 'babel?stage=0'
            },

            // LESS
            {
                test: /\.less$/,
                loader: 'style!' +
                'css?sourceMap!' +
                'autoprefixer-loader!' +
                'less'
            },

            // CSS
            {
                test: /\.css$/,
                loader: 'style!' +
                'css!' +
                'autoprefixer-loader'
            },

            // Image
            {
                test: /\.(png|jpg)$/,
                loader: 'url?limit=25000&name=[path][hash].[ext]'
            },

            {test: /\.woff(\?v=\d+\.\d+\.\d+)?$/, loader: 'url?limit=10000&minetype=application/font-woff'},
            {test: /\.woff2(\?v=\d+\.\d+\.\d+)?$/, loader: 'url?limit=10000&minetype=application/font-woff'},
            {test: /\.ttf(\?v=\d+\.\d+\.\d+)?$/, loader: 'url?limit=10000&minetype=application/octet-stream'},
            {test: /\.eot(\?v=\d+\.\d+\.\d+)?$/, loader: 'file'},
            {test: /\.svg(\?v=\d+\.\d+\.\d+)?$/, loader: 'url?limit=10000&minetype=image/svg+xml'}
        ],
        plugins: [
            new webpack.optimize.OccurenceOrderPlugin(),
            new webpack.IgnorePlugin(/^xhr2$/)
        ]
    },
    externals: {
        react: 'window.React',
        'react/addons': 'window.React'
    }
};
