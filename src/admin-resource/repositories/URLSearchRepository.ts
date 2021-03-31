export default () => ({
  single(name: string, value: string) {
    const usp = new URLSearchParams()
    usp.append(name, value)
    return usp
  },
  all(o: { [key: string]: string }) {
    const usp = new URLSearchParams()
    Object.keys(o).map((name: string) => usp.append(name, o[name]))
    return usp
  },
})
