import { getterTree, mutationTree, actionTree } from 'typed-vuex'

export const state = () => ({
  title: 'hoge' as string,
})

export type RootState = ReturnType<typeof state>

export const getters = getterTree(state, {
  title: (state) => state.title,
})

export const mutations = mutationTree(state, {
  setTitle(state, title: string): void {
    state.title = title
  },
})

export const actions = actionTree(
  { state, getters, mutations },
  {
    async fetchStandard() {
      const prd = await this.$repo('standard').index()
      console.log(prd)
    },
  }
)
