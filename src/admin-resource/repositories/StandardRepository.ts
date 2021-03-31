import { NuxtAxiosInstance } from '@nuxtjs/axios'
const resource = '/standard'

export default ($axios: NuxtAxiosInstance) => ({
  index() {
    return $axios.$get(`${resource}`)
  },
})
