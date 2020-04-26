import commonjs from 'rollup-plugin-commonjs';
import resolve from 'rollup-plugin-node-resolve';
import babel from 'rollup-plugin-babel';
import { terser } from 'rollup-plugin-terser';

const esm = {
    input: 'js/main.js',
    output: {
        format: 'es',
        sourcemap: true,
        file: `js/main-${process.env.npm_package_version}.esm.min.js`
    },
    plugins: [
        commonjs(),
        resolve(),
        babel(),
        terser()
    ]
};

const iife = {
    input: 'js/main.js',
    output: {
        format: 'iife',
        file: `js/main-${process.env.npm_package_version}.iife.min.js`,
        name: 'steroids'
    },
    plugins: [
        commonjs(),
        resolve(),
        babel(),
        terser()
    ]
};

const conf = process.env.BABEL_ENV === 'esm' ? esm : iife;
export default conf;
