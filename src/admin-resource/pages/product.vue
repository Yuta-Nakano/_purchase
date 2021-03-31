<template>
  <div class="min-h-screen bg-gray-100">
    <Navigation />

    <header>
      <div class="page-header">
        <h1 class="page-title">pt</h1>
      </div>
    </header>

    <main>
      <div class="page-content">
        <div class="sm:px-0 shadow overflow-hidden rounded-md">
          <DataTable />
        </div>
      </div>
    </main>
  </div>
</template>

<script lang="ts">
import {
  defineComponent,
  ref,
  useContext,
  useFetch,
} from '@nuxtjs/composition-api'

interface IResource {
  resource: number[]
  pagenate: {
    currentPage: number
    lastPage: number
    total: number
    from: number
    to: number
  }
}

export default defineComponent({
  middleware: 'auth',
  setup() {
    const {
      app: { $repo },
    } = useContext()

    // const search = ref<string>('')
    // console.log(search)

    // const data = ref<IResource>([])
    // const headers = ref<number[]>([])
    // console.log(headers)
    // const pagenate = ref<{ [key: string]: number }>({
    //   currentPage: 1,
    //   lastPage: 1,
    //   total: 1,
    //   from: 0,
    //   to: 0,
    // })
    const pagenate = ref<{ [key: string]: number }>({})
    console.log(pagenate)

    useFetch(async () => {
      const r = await $repo('standard').index()
      console.log(r)
    })

    return {}
  },
})
</script>

<style lang="sass">
.page-header
  @apply max-w-7xl mx-auto flex flex-wrap items-center justify-between
  @apply px-4 py-4
  @apply sm:px-6
  @apply lg:p-8

.page-content
  @apply max-w-7xl mx-auto p-4
  @apply md:p-8
</style>
