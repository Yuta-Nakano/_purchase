import AuthRepository from '~/repositories/AuthRepository'
import ProductRepository from '~/repositories/ProductRepository'
import StandardRepository from '~/repositories/StandardRepository'

import URLSearchRepository from '~/repositories/URLSearchRepository'
import FormDataRepository from '~/repositories/FormDataRepository'

const repositories = {
  auth: AuthRepository,
  product: ProductRepository,
  standard: StandardRepository,
  url: URLSearchRepository,
  fd: FormDataRepository,
} as {
  [key: string]: any
}

export const RepositoryFactory = {
  get: (name: string) => repositories[name],
}
