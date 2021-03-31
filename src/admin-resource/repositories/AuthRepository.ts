import { NuxtAxiosInstance } from '@nuxtjs/axios'

export default ($axios: NuxtAxiosInstance) => ({
  async login(payload: { email: string; password: string }) {
    await $axios.get('/sanctum/csrf-cookie')
    return await $axios.$post('/login', payload)
  },
  async logout() {
    return await $axios.$get('/logout')
  },
  async loggedin() {
    return await $axios.$get('/loggedin')
  },
})
