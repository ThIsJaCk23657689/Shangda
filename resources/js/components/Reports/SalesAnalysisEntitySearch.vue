<template>
    <div class="position-relative">
        <div v-if="value" class="input-group">
            <input class="form-control" :value="displayName(value)" readonly>
            <div class="input-group-append"><button type="button" class="btn btn-outline-secondary" @click="clear">清除</button></div>
        </div>
        <input v-else ref="input" v-model="query" class="form-control" :placeholder="placeholder"
               autocomplete="off" @focus="search(false)" @keydown.down.prevent="move(1)"
               @keydown.up.prevent="move(-1)" @keydown.enter.prevent="chooseActive" @keydown.esc="open=false">
        <div v-if="open && !value" class="list-group position-absolute w-100 shadow-sm entity-results">
            <button v-for="(item,index) in items" :key="item.id" type="button"
                    class="list-group-item list-group-item-action" :class="{'active': index===active}"
                    @mousedown.prevent="choose(item)">
                <div>{{ item.name }} <span v-if="item.is_deleted" class="badge badge-secondary">已停用</span></div>
                <small :class="index===active ? 'text-white' : 'text-muted'">{{ [item.code, item.secondary].filter(Boolean).join('｜') }}</small>
            </button>
            <div v-if="loading" class="list-group-item text-muted">搜尋中…</div>
            <div v-else-if="!items.length" class="list-group-item text-muted">查無符合資料</div>
            <button v-if="page < lastPage" type="button" class="list-group-item list-group-item-action text-center text-primary" @mousedown.prevent="loadMore">載入更多</button>
        </div>
    </div>
</template>

<script>
export default {
    props: { value: Object, dimension: String, url: String },
    data() { return { query: '', items: [], page: 1, lastPage: 1, active: -1, open: false, loading: false, timer: null }; },
    computed: { placeholder() { return this.dimension === 'customer' ? '輸入顧客名稱、簡稱或統編' : '輸入商品名稱、編號或規格'; } },
    watch: {
        query() { clearTimeout(this.timer); this.timer = setTimeout(() => this.search(false), 300); },
        dimension() { this.query = ''; this.items = []; this.open = false; }
    },
    beforeDestroy() { clearTimeout(this.timer); },
    methods: {
        displayName(item) { return item.name + (item.code ? '（' + item.code + '）' : '') + (item.is_deleted ? '［已停用］' : ''); },
        search() {
            if (!this.query.trim()) { this.items = []; this.open = false; return; }
            this.page = 1; this.fetch(false);
        },
        loadMore() { this.page++; this.fetch(true); },
        fetch(append) {
            this.loading = true; this.open = true;
            axios.get(this.url, { params: { dimension: this.dimension, query: this.query.trim(), page: this.page, per_page: 20 } })
                .then(({data}) => { this.items = append ? this.items.concat(data.data) : data.data; this.lastPage = data.pagination.last_page; this.active = this.items.length ? 0 : -1; })
                .catch(() => { this.items = []; })
                .finally(() => { this.loading = false; });
        },
        move(step) { if (!this.open) this.search(); if (this.items.length) this.active = (this.active + step + this.items.length) % this.items.length; },
        chooseActive() { if (this.active >= 0) this.choose(this.items[this.active]); },
        choose(item) { this.$emit('input', item); this.query = ''; this.open = false; },
        clear() { this.$emit('input', null); this.$nextTick(() => this.$refs.input && this.$refs.input.focus()); }
    }
};
</script>

<style scoped>
.entity-results { z-index: 1050; max-height: 360px; overflow-y: auto; }
</style>
