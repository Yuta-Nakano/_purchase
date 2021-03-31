import { Context } from '@nuxt/types'

export default async ({ redirect, app: { $accessor }, from }: Context) => {
  if (!$accessor.user.id) {
    try {
      await $accessor.user.loggedin()
    } catch (error) {
      return redirect(`/login?redirect=${from.fullPath}`)
    }
  }
}
