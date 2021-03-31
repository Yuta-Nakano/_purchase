<template>
  <div class="container">
    <div>
      <Logo />
      <h1 class="title">Admin</h1>
      <div class="links">
        <a
          href="https://nuxtjs.org/"
          target="_blank"
          rel="noopener noreferrer"
          class="button--green"
        >
          Documentation
        </a>
        <a
          href="https://github.com/nuxt/nuxt.js"
          target="_blank"
          rel="noopener noreferrer"
          class="button--grey"
        >
          GitHub
        </a>
        <span
          rel="noopener noreferrer"
          class="button--grey cursor-pointer"
          @click="logout"
        >
          Logout
        </span>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import {
  defineComponent,
  useContext,
  useRouter,
  onMounted,
} from '@nuxtjs/composition-api'

export default defineComponent({
  middleware: 'auth',
  setup() {
    const {
      app: { $accessor, $repo },
    } = useContext()
    const $router = useRouter()

    const logout = async () => {
      await $accessor.user.logout()
      $router.push('/login')
    }

    onMounted(() => {
      const paramSingle = $repo('url').single('do', 'something')
      const paramAll = $repo('url').all({
        do: 'something',
        everything: 'ok',
      })
      const fdSingle = $repo('fd').single('do', 'something')
      const fdAll = $repo('fd').all({ do: 'something', everything: 'ok' })

      console.log({
        paramSingle: [...paramSingle.entries()],
        paramAll: [...paramAll.entries()],
        fdSingle: [...fdSingle.entries()],
        fdAll: [...fdAll.entries()],
      })
    })

    return {
      logout,
    }
  },
})
</script>

<style lang="sass">
// Sample `apply` at-rules with Tailwind CSS
// .container
//   @apply min-h-screen flex justify-center items-center text-center mx-auto

.container
  margin: 0 auto
  min-height: 100vh
  display: flex
  justify-content: center
  align-items: center
  text-align: center

.title
  font-family: 'Quicksand', 'Source Sans Pro', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif
  display: block
  font-weight: 300
  font-size: 100px
  color: #35495e
  letter-spacing: 1px

.subtitle
  font-weight: 300
  font-size: 42px
  color: #526488
  word-spacing: 5px
  padding-bottom: 15px

.links
  padding-top: 15px
</style>
