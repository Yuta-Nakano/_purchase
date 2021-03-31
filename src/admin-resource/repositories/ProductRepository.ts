import { NuxtAxiosInstance } from '@nuxtjs/axios'
const resource = '/product'

export default ($axios: NuxtAxiosInstance) => ({
  get(slug: string) {
    return $axios.$get(`${resource}/${slug}`)
  },
})
