import commonjs from 'rollup-plugin-commonjs';
import resolve from 'rollup-plugin-node-resolve';
import babel from 'rollup-plugin-babel';
import { terser } from 'rollup-plugin-terser';

const esm = {
    input: 'scripts/main.js',
    output: {
        format: 'es',
        sourcemap: true,
        file: `scripts/main-${process.env.npm_package_version}.esm.min.js`
    },
    plugins: [
        commonjs(),
        resolve(),
        babel(),
        terser()
    ]
};

const iife = {
    input: 'scripts/main.js',
    output: {
        format: 'iife',
        file: `scripts/main-${process.env.npm_package_version}.iife.min.js`,
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
