const path = require('path');
const defaults = require('@wordpress/scripts/config/webpack.config.js');

module.exports = {
    ...defaults,
    entry: {
        'styles': path.resolve( process.cwd(), 'src', 'styles.ts' ),
        'tutorial': path.resolve( process.cwd(), 'src/scripts', 'tutorial.ts' ),
    },
    output: {
        filename: '[name].js',
        path: path.resolve( process.cwd(), 'dist' ),
    },
    module: {
        ...defaults.module,
        rules: [
            ...defaults.module.rules,
            {
                test: /\.tsx?$/,
                use: [
                    {
                        loader: 'ts-loader',
                        options: {
                            configFile: 'tsconfig.json',
                            transpileOnly: true,
                        }
                    }
                ]
            }
        ]
    },
    resolve: {
        extensions: [ '.ts', '.tsx', ...(defaults.resolve ? defaults.resolve.extensions || ['.js', '.jsx'] : [])]
    }
};