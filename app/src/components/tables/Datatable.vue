<template>
    <div>
        <table :id="id" class="table" v-bind:class="tableClass" style="width: 100%;">
            <thead>
                <tr>
                    <th
                        v-for="(column, index) in options"
                        :key="index"
                        :class="column.class"
                    >
                        <a @click="navigateSort(column.key)" v-if="sortableColumns && sortableColumns.includes(column.key)">
                            <div class="sort-option">
                                <span :class="{ 'active': sortColumn == column.key }">
                                    <i :class="isSortAscending && sortColumn == column.key ? 'fa-long-arrow-alt-up' : 'fa-long-arrow-alt-down'" class="fas"></i>
                                </span>
                                {{ column.label }}
                            </div>
                        </a>
                        <span v-else>{{ column.label }}</span>
                    </th>
                </tr>
            </thead>
            <tbody v-if="data && data.length > 0">
                <tr v-for="(row, i) in data" :key="i">
                    <td
                        v-for="(column, j) in options"
                        :key="j"
                        :class="column.class"
                    >
                        <slot
                            :name="column.key"
                            :row="row"
                            :rowi="i"
                            :index="i"
                        >
                            {{ row[column.key] }}
                        </slot>
                    </td>
                </tr>
            </tbody>
            <tbody v-else>
                <tr>
                    <td :colspan="options.length" class="text-center">No data available</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import { defineComponent, onMounted, ref } from 'vue'

export default defineComponent({
    props: {
        counter: {
            type: Boolean,
            default: true
        },
        options: { required: true, type: Array },
        data: {
            type: Array,
            required: true
        },
        sortableColumns: {
            type: Array,
            default: []
        },
        isSortAscending: {
            type: Boolean,
            default: true
        },
        tableClass: {
            type: String,
            default: 'table-striped'
        },
        id:{
            type: String,
            default: 'datatables-responsive'
        }
    },
    emits: ['navigateSort'],
    setup(props, { emit }) {
        const sortColumn = ref('');
        const navigateSort = (index) => {
            sortColumn.value = index;
            emit('navigateSort', index)
        }
        onMounted(() => {
            // get the first index of sortable columns
            sortColumn.value = props.sortableColumns[0] ?? '';
        });

        return {
            navigateSort,
            sortColumn
        }
    }
})
</script>
<style scoped>
    #datatables-responsive thead tr th:nth-last-child(1) {
        width: 10% !important;
    }
    span.sort-option {
        text-align: center;
        width: 14px;
        height: 20px;
        margin-left: 5px;
        font-size: 11px;
    }
    span.sort-option > span {
        float: left;
        height: 20px;
        width: 5px;
    }
    span.sort-option > span.active i {
        color: #4d5053;
    }
    span.sort-option > span i {
        display: inline-block;
        color: #bfbfbf;
    }

    .fa-long-arrow-alt-up, .fa-long-arrow-alt-down { font-size: 12px; }
    .sort-option { width: max-content; }
</style>