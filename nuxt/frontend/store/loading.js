export const state = () => ({
    loaded: false
})

export const mutations = {
    setTrue(state) {
        state.loaded = true
    }
}