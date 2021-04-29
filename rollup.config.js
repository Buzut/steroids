import commonjs from '@rollup/plugin-commonjs';
import noderesolve from '@rollup/plugin-node-resolve';
import babel from '@rollup/plugin-babel';
import { terser } from 'rollup-plugin-terser';

const esm = {
    input: 'scripts/main.js',
    preserveEntrySignatures: false,
    output: {
        format: 'es',
        sourcemap: true,
        entryFileNames: `[name]-${process.env.npm_package_version}.js`,
        dir: 'scripts/build/'
    },
    plugins: [
        commonjs(),
        noderesolve(),
        babel({ babelHelpers: 'bundled' }),
        terser()
    ]
};

const iife = {
    input: 'scripts/main.js',
    output: {
        format: 'iife',
        file: `scripts/build/main-${process.env.npm_package_version}.iife.min.js`,
        name: 'steroids'
    },
    plugins: [
        commonjs(),
        noderesolve(),
        babel({ babelHelpers: 'bundled', plugins: ['babel-plugin-transform-dynamic-imports-to-static-imports'] }),
        terser()
    ]
};

const conf = process.env.BABEL_ENV === 'esm' ? esm : iife;
export default conf;
