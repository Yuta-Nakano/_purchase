<template>
  <div class="bg-white overflow-y-auto">
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <slot name="thead">
          <tr>
            <th
              v-for="(header, headIdx) in headers"
              :key="`thead-${_uid}-${headIdx}`"
              scope="col"
              class="p-2 md:px-4 text-left text-xs lg:text-sm font-medium text-gray-500 uppercase whitespace-nowrap tracking-wider"
              :class="header.class"
            >
              <slot :name="`thead-${header.content}`">
                {{ header.label || null }}
              </slot>
            </th>
          </tr>
        </slot>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        <slot name="tbody" :rows="rows">
          <tr
            v-for="(row, rowIdx) in rows"
            :key="`tbody-${_uid}-row-${rowIdx}`"
          >
            <td
              v-for="(header, headIdx) in headers"
              :key="`tbody-${_uid}-${headIdx}`"
              class="p-2 md:px-4 text-xs lg:text-sm text-gray-500 whitespace-nowrap"
              :class="header.class"
            >
              <slot :name="`tbody-${header.content}`" :item="row">
                {{ getContent(row[header.content], header.prop) }}
              </slot>
            </td>
          </tr>
        </slot>
      </tbody>
      <!-- <tbody v-else>
        <tr>
          <td
            :colspan="headers.length"
            class="p-2 md:px-4 lg:text-sm text-xs text-center text-gray-500 whitespace-nowrap"
          >
            Loading
          </td>
        </tr>
      </tbody> -->
    </table>
  </div>
</template>

<script>
export default {
  props: {
    headers: {
      type: Array,
      default: () => [],
    },
    rows: {
      type: Array,
      default: () => [],
    },
  },
  methods: {
    getContent(contents, prop = null) {
      return prop ? contents[prop] : contents
    },
  },
}
</script>
