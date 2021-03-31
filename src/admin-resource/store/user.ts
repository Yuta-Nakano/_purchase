import { mutationTree, getterTree, actionTree } from 'typed-vuex'

export type UserState = {
  id: string
  name: string
}

const state = () => ({
  id: '',
  name: '',
})

export type RootState = ReturnType<typeof state>

export const getters = getterTree(state, {
  id: (state) => state.id,
})

export const mutations = mutationTree(state, {
  store(state, user: UserState) {
    state.id = user.id
    state.name = user.name
  },
  destroy(state) {
    state.id = ''
    state.name = ''
  },
})

export const actions = actionTree(
  { state, getters, mutations },
  {
    async login(
      { commit },
      payload: {
        email: string
        password: string
      }
    ) {
      const user = await this.$repo('auth').login(payload)
      commit('store', user)
    },
    async logout({ commit }) {
      await this.$repo('auth').logout()
      commit('destroy')
    },
    async loggedin({ commit }) {
      const user = await this.$repo('auth').loggedin()
      commit('store', user)
    },
  }
)
