import { RepositoryFactory } from '@/factories/RepositoryFactory'
import { Plugin } from '@nuxt/types'

declare module 'vue/types/vue' {
  interface Vue {
    $repo(
      name: string
    ): {
      [key: string]: any
    }
  }
}

declare module '@nuxt/types' {
  interface NuxtAppOptions {
    $repo(
      name: string
    ): {
      [key: string]: any
    }
  }
}

declare module 'vuex/types/index' {
  interface Store<S> {
    $repo(
      name: string
    ): {
      [key: string]: any
    }
  }
}

const repositories: Plugin = ({ app }, inject) => {
  inject('repo', (name: string) => {
    return RepositoryFactory.get(name)(app.$axios)
  })
}

export default repositories
