import { accessorType } from '@/store'

declare module 'vue/types/vue' {
  interface Vue {
    $accessor: typeof accessorType
  }
}

declare module '@nuxt/types' {
  interface NuxtAppOptions {
    $accessor: typeof accessorType
  }
}

declare module 'vuex/types/index' {
  interface Store<S> {
    $accessor: typeof accessorType
  }
}
