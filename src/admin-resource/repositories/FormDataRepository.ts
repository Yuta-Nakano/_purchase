export default () => ({
  single(name: string, value: string | Blob) {
    const fd = new FormData()
    fd.append(name, value)
    return fd
  },
  all(o: { [key: string]: string | Blob }) {
    const fd = new FormData()
    Object.keys(o).map((name: string) => fd.append(name, o[name]))
    return fd
  },
})
