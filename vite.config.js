import { fileURLToPath, URL } from 'node:url'

import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import vueDevTools from 'vite-plugin-vue-devtools'

// https://vite.dev/config/
export default defineConfig({
  plugins: [
    vue(),
    vueDevTools(),
  ],
  resolve: {
    alias: {
      '@': fileURLToPath(new URL('./src', import.meta.url))
    },
  },
  preview: {
    port: 9120,
    strictPort: true,
  },
  server: {
    port: 9120,
    strictPort: true,
    host: true,
    origin: "http://127.0.0.1:9120",
    watch: {
      usePolling: true,
    },
  },
})
