import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import react from '@vitejs/plugin-react'
import path from 'path'
import fs from 'fs'

// Función para obtener todos los archivos con ciertas extensiones
function getAllFiles(dir, exts = ['.js'], files = []) {
    fs.readdirSync(dir).forEach(file => {
        const filePath = path.join(dir, file)
        if (fs.statSync(filePath).isDirectory()) {
            getAllFiles(filePath, exts, files)
        } else if (exts.some(ext => file.endsWith(ext))) {
            files.push(filePath)
        }
    })
    return files
}

const jsFiles = getAllFiles('resources/js', ['.js', '.jsx', '.ts', '.tsx'])
const cssFiles = getAllFiles('resources/css', ['.css'])

export default defineConfig({
    plugins: [
        laravel({
            input: [
                ...jsFiles,
                ...cssFiles,
            ],
            refresh: true,
        }),
        react(),
    ],
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources/js'),
        },
    },
})
