var path = require("path");
var webpack = require('webpack');
var node_modules = path.resolve(__dirname, 'node_modules');
var pkg = require(path.join(process.cwd(), 'package.json'));

module.exports = {
    entry: pkg.entry,

    resolve: {
        root: path.join(__dirname, '../node_modules'),
        extensions: ['', '.js', '.jsx']
    },

    resolveLoader: {
        root: path.join(__dirname, '../node_modules')
    },

    output: {
        path: path.join(process.cwd(), './dist/'),
        filename: '[name].js',
        chunkFilename: '[name].js'
    },

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
            new webpack.optimize.CommonsChunkPlugin('vendors', 'vendors.js'),
            new webpack.optimize.OccurenceOrderPlugin(),
            new webpack.IgnorePlugin(/^xhr2$/),
            new webpack.optimize.UglifyJsPlugin({
                output: {
                    ascii_only: true
                }
            })
        ]
    },
    externals: {
        react: 'window.React',
        'react/addons': 'window.React'
    }
};
