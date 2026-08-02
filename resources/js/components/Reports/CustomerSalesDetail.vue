<template>
    <div>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-filter mr-2"></i>顧客銷售明細查詢
            </div>
            <div class="card-body">
                <form @submit.prevent="fetchData(1)">
                    <div class="form-row">
                        <div ref="consumerSearch" class="form-group col-lg-4 col-md-6 customer-search">
                            <label for="customer-sales-consumer">顧客</label>
                            <div class="input-group">
                                <input
                                    id="customer-sales-consumer"
                                    type="text"
                                    class="form-control"
                                    v-model="consumerSearchText"
                                    placeholder="輸入顧客名稱、簡稱或統編"
                                    autocomplete="off"
                                    aria-autocomplete="list"
                                    :aria-expanded="showConsumerResults ? 'true' : 'false'"
                                    aria-controls="customer-sales-consumer-results"
                                    @input="handleConsumerInput"
                                    @focus="openConsumerResults"
                                    @keydown.down.prevent="moveConsumerHighlight(1)"
                                    @keydown.up.prevent="moveConsumerHighlight(-1)"
                                    @keydown.enter.prevent="selectHighlightedConsumer"
                                    @keydown.esc.prevent="closeConsumerResults">
                                <div class="input-group-append" v-if="selectedConsumer">
                                    <button type="button" class="btn btn-outline-secondary" title="清除顧客" @click="clearConsumer">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>

                            <div
                                v-if="showConsumerResults"
                                id="customer-sales-consumer-results"
                                class="list-group customer-search-results"
                                role="listbox">
                                <button
                                    v-for="(consumer, index) in filteredConsumers"
                                    :key="consumer.id"
                                    type="button"
                                    class="list-group-item list-group-item-action py-2"
                                    :class="{active: index === highlightedConsumerIndex}"
                                    role="option"
                                    :aria-selected="index === highlightedConsumerIndex ? 'true' : 'false'"
                                    @mouseenter="highlightedConsumerIndex = index"
                                    @mousedown.prevent="selectConsumer(consumer)">
                                    <span class="font-weight-bold">{{ consumer.name }}</span>
                                    <span v-if="consumer.shortName" class="ml-1">（{{ consumer.shortName }}）</span>
                                    <small v-if="consumer.taxID" class="d-block" :class="index === highlightedConsumerIndex ? 'text-white' : 'text-muted'">統編：{{ consumer.taxID }}</small>
                                    <span v-if="consumer.deleted_at" class="badge badge-secondary ml-1">已停用</span>
                                </button>
                                <div v-if="filteredConsumers.length === 0" class="list-group-item text-muted text-center py-3">
                                    查無符合顧客
                                </div>
                            </div>

                            <small v-if="selectedConsumer" class="form-text text-success">
                                已選擇：{{ consumerLabel(selectedConsumer) }}
                            </small>
                            <small v-else class="form-text text-muted">請輸入文字後，從搜尋結果中選擇一位顧客。</small>
                        </div>
                        <div class="form-group col-lg-2 col-md-6">
                            <label for="customer-sales-date-type">日期依據</label>
                            <select id="customer-sales-date-type" class="form-control" v-model="filters.date_type">
                                <option value="transaction">交易日</option>
                                <option value="delivered">出貨日</option>
                                <option value="paid">付款日</option>
                                <option value="created">建立日</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-2 col-md-6">
                            <label for="customer-sales-start-date">起始日</label>
                            <input id="customer-sales-start-date" type="date" class="form-control" v-model="filters.start_date" required>
                        </div>
                        <div class="form-group col-lg-2 col-md-6">
                            <label for="customer-sales-end-date">截止日</label>
                            <input id="customer-sales-end-date" type="date" class="form-control" v-model="filters.end_date" required>
                        </div>
                        <div class="form-group col-lg-2 col-md-6">
                            <label for="customer-sales-status">訂單狀態</label>
                            <select id="customer-sales-status" class="form-control" v-model="filters.order_status">
                                <option value="all">全部</option>
                                <option value="unpaid">未付款</option>
                                <option value="paid">已付款</option>
                                <option value="undelivered">未出貨</option>
                                <option value="completed">已完成</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row align-items-end">
                        <div class="form-group col-lg-2 col-md-4">
                            <div class="custom-control custom-switch customer-sales-switch">
                                <input id="customer-sales-returns" type="checkbox" class="custom-control-input" v-model="filters.include_returns">
                                <label class="custom-control-label" for="customer-sales-returns">包含退貨</label>
                            </div>
                        </div>
                        <div class="form-group col-lg-2 col-md-4">
                            <div class="custom-control custom-switch customer-sales-switch">
                                <input id="customer-sales-details" type="checkbox" class="custom-control-input" v-model="showDetails">
                                <label class="custom-control-label" for="customer-sales-details">展開商品明細</label>
                            </div>
                        </div>
                        <div class="form-group col-lg-2 col-md-4">
                            <label for="customer-sales-per-page">每頁筆數</label>
                            <select id="customer-sales-per-page" class="form-control" v-model.number="filters.per_page">
                                <option :value="10">10</option>
                                <option :value="20">20</option>
                                <option :value="50">50</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-3 col-md-6">
                            <button type="submit" class="btn btn-primary btn-block" :disabled="loading || !canSearch">
                                <i class="fas fa-search mr-1"></i>{{ loading ? '查詢中...' : '查詢' }}
                            </button>
                        </div>
                        <div class="form-group col-lg-3 col-md-6">
                            <button type="button" class="btn btn-success btn-block" :disabled="!hasSearched || loading || !canSearch" @click="exportCsv">
                                <i class="fas fa-file-csv mr-1"></i>匯出 CSV
                            </button>
                        </div>
                    </div>
                </form>

                <div v-if="errorMessage" class="alert alert-danger mb-0" role="alert">{{ errorMessage }}</div>
                <div v-if="filters.date_type === 'paid'" class="alert alert-info mb-0">以付款日查詢時，尚未付款的訂單不會列入。</div>
                <div v-else-if="filters.date_type === 'delivered'" class="alert alert-info mb-0">以出貨日查詢時，尚未出貨的訂單不會列入。</div>
            </div>
        </div>

        <template v-if="hasSearched">
            <div class="card mb-3" v-if="consumer">
                <div class="card-header"><i class="fas fa-user mr-2"></i>顧客資訊</div>
                <div class="card-body py-3">
                    <div class="row">
                        <div class="col-md-3"><strong>名稱：</strong>{{ consumer.name }} <span v-if="consumer.is_deleted" class="badge badge-secondary">已停用</span></div>
                        <div class="col-md-2"><strong>統編：</strong>{{ consumer.tax_id || '無' }}</div>
                        <div class="col-md-3"><strong>聯絡人：</strong>{{ consumer.contact_name || '無' }}</div>
                        <div class="col-md-4"><strong>電話：</strong>{{ consumer.contact_phone || '無' }}</div>
                        <div class="col-12 mt-2"><strong>地址：</strong>{{ consumer.address }}</div>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-xl-2 col-md-4 col-sm-6 mb-2" v-for="card in summaryCards" :key="card.label">
                    <div class="card h-100" :class="card.className">
                        <div class="card-body py-3">
                            <div class="small">{{ card.label }}</div>
                            <div class="h5 mb-0">{{ card.value }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-table mr-2"></i>訂單明細</span>
                    <span class="small text-muted">共 {{ pagination.total }} 張訂單</span>
                </div>
                <div class="card-body p-0">
                    <div v-if="orders.length === 0" class="alert alert-light text-center m-3">查無符合條件的銷售紀錄。</div>
                    <div v-else class="table-responsive">
                        <table class="table table-bordered table-hover mb-0 customer-sales-table">
                            <thead class="thead-light">
                                <tr>
                                    <th>日期</th>
                                    <th>單別</th>
                                    <th>訂單編號</th>
                                    <th>付款</th>
                                    <th>出貨</th>
                                    <th class="text-right">未稅額</th>
                                    <th class="text-right">稅額</th>
                                    <th class="text-right">含稅總額</th>
                                    <th>備註</th>
                                    <th class="text-center">明細</th>
                                </tr>
                            </thead>
                            <tbody v-for="order in orders" :key="order.id">
                                <tr :class="{'table-danger': order.status == 2}">
                                    <td>{{ order.date_value }}</td>
                                    <td><span class="badge" :class="order.status == 2 ? 'badge-danger' : 'badge-primary'">{{ order.order_type }}</span></td>
                                    <td><a :href="order.show_url" target="_blank">{{ order.shown_id }}</a></td>
                                    <td>{{ order.payment_status }}</td>
                                    <td>{{ order.delivery_status }}</td>
                                    <td class="text-right">{{ money(order.signed_total_price) }}</td>
                                    <td class="text-right">{{ money(order.signed_tax_price) }}</td>
                                    <td class="text-right font-weight-bold">{{ money(order.signed_total_tax_price) }}</td>
                                    <td>{{ order.comment || '' }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-outline-secondary" @click="toggleOrder(order)">
                                            {{ isExpanded(order) ? '收合' : '展開' }}
                                        </button>
                                    </td>
                                </tr>
                                <tr v-if="isExpanded(order)">
                                    <td colspan="10" class="p-2 bg-light">
                                        <div v-if="order.details.length === 0" class="text-muted text-center py-2">此訂單沒有商品明細。</div>
                                        <div v-else class="table-responsive">
                                            <table class="table table-sm table-striped mb-0 bg-white">
                                                <thead>
                                                    <tr>
                                                        <th>商品編號</th><th>商品名稱</th><th>單位</th>
                                                        <th class="text-right">數量</th><th class="text-right">單價</th>
                                                        <th class="text-right">折數</th><th class="text-right">品項小計</th><th>備註</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="detail in order.details" :key="detail.id">
                                                        <td>{{ detail.product_shown_id }}</td>
                                                        <td>{{ detail.product_name }}</td>
                                                        <td>{{ detail.unit_label }}</td>
                                                        <td class="text-right">{{ number(detail.signed_quantity) }}</td>
                                                        <td class="text-right">{{ money(detail.price) }}</td>
                                                        <td class="text-right">{{ number(detail.discount) }}</td>
                                                        <td class="text-right">{{ money(detail.signed_subtotal) }}</td>
                                                        <td>{{ detail.comment || '' }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer d-flex flex-wrap justify-content-between align-items-center" v-if="pagination.last_page > 1">
                    <span class="small text-muted">顯示第 {{ pagination.from }} 至 {{ pagination.to }} 筆</span>
                    <nav aria-label="顧客銷售明細分頁">
                        <ul class="pagination pagination-sm mb-0">
                            <li class="page-item" :class="{disabled: pagination.current_page <= 1}">
                                <button class="page-link" type="button" @click="fetchData(pagination.current_page - 1)">上一頁</button>
                            </li>
                            <li class="page-item" v-for="page in visiblePages" :key="page" :class="{active: page === pagination.current_page}">
                                <button class="page-link" type="button" @click="fetchData(page)">{{ page }}</button>
                            </li>
                            <li class="page-item" :class="{disabled: pagination.current_page >= pagination.last_page}">
                                <button class="page-link" type="button" @click="fetchData(pagination.current_page + 1)">下一頁</button>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </template>
    </div>
</template>

<script>
function formatDate(date) {
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    return `${year}-${month}-${day}`;
}

export default {
    props: ['consumers', 'dataUrl', 'exportUrl'],
    data() {
        const today = new Date();
        return {
            loading: false,
            hasSearched: false,
            showDetails: true,
            consumerSearchText: '',
            selectedConsumer: null,
            showConsumerResults: false,
            highlightedConsumerIndex: -1,
            errorMessage: '',
            consumer: null,
            orders: [],
            summary: {},
            pagination: {current_page: 1, last_page: 1, total: 0, from: 0, to: 0},
            filters: {
                consumer_id: '',
                date_type: 'transaction',
                start_date: formatDate(new Date(today.getFullYear(), today.getMonth(), 1)),
                end_date: formatDate(today),
                include_returns: false,
                order_status: 'all',
                per_page: 20,
            },
        };
    },
    computed: {
        canSearch() {
            return this.selectedConsumer !== null
                && Number(this.filters.consumer_id) === Number(this.selectedConsumer.id)
                && this.filters.start_date
                && this.filters.end_date;
        },
        filteredConsumers() {
            const keyword = this.normalizeConsumerSearch(this.consumerSearchText);
            if (!keyword) return [];

            return this.consumers.filter(consumer => {
                return [consumer.name, consumer.shortName, consumer.taxID].some(value => {
                    return this.normalizeConsumerSearch(value).includes(keyword);
                });
            }).slice(0, 10);
        },
        visiblePages() {
            const pages = [];
            const start = Math.max(1, this.pagination.current_page - 2);
            const end = Math.min(this.pagination.last_page, this.pagination.current_page + 2);
            for (let page = start; page <= end; page++) pages.push(page);
            return pages;
        },
        summaryCards() {
            return [
                {label: '訂單數', value: `${this.summary.order_count || 0} 張`, className: 'border-left-primary'},
                {label: '銷貨總額', value: this.money(this.summary.sales_total), className: 'border-left-success'},
                {label: '退貨總額', value: this.money(this.summary.return_total), className: 'border-left-danger'},
                {label: '淨銷售額', value: this.money(this.summary.net_total), className: 'border-left-primary'},
                {label: '已收淨額', value: this.money(this.summary.paid_total), className: 'border-left-info'},
                {label: '未收淨額', value: this.money(this.summary.unpaid_total), className: 'border-left-warning'},
            ];
        },
    },
    methods: {
        normalizeConsumerSearch(value) {
            return String(value || '').trim().toLocaleLowerCase();
        },
        handleConsumerInput() {
            if (this.selectedConsumer && this.consumerSearchText !== this.consumerLabel(this.selectedConsumer)) {
                this.selectedConsumer = null;
                this.filters.consumer_id = '';
                this.invalidateReport();
            }

            this.highlightedConsumerIndex = -1;
            this.showConsumerResults = this.normalizeConsumerSearch(this.consumerSearchText) !== '';
        },
        openConsumerResults() {
            if (!this.selectedConsumer && this.normalizeConsumerSearch(this.consumerSearchText)) {
                this.showConsumerResults = true;
            }
        },
        closeConsumerResults() {
            this.showConsumerResults = false;
            this.highlightedConsumerIndex = -1;
        },
        moveConsumerHighlight(direction) {
            if (!this.showConsumerResults) this.openConsumerResults();
            if (this.filteredConsumers.length === 0) return;

            const lastIndex = this.filteredConsumers.length - 1;
            if (this.highlightedConsumerIndex < 0) {
                this.highlightedConsumerIndex = direction > 0 ? 0 : lastIndex;
            } else {
                this.highlightedConsumerIndex = (this.highlightedConsumerIndex + direction + this.filteredConsumers.length) % this.filteredConsumers.length;
            }
        },
        selectHighlightedConsumer() {
            if (!this.showConsumerResults || this.filteredConsumers.length === 0) return;
            const index = this.highlightedConsumerIndex >= 0 ? this.highlightedConsumerIndex : 0;
            this.selectConsumer(this.filteredConsumers[index]);
        },
        selectConsumer(consumer) {
            this.selectedConsumer = consumer;
            this.filters.consumer_id = consumer.id;
            this.consumerSearchText = this.consumerLabel(consumer);
            this.closeConsumerResults();
            this.invalidateReport();
        },
        clearConsumer() {
            this.selectedConsumer = null;
            this.filters.consumer_id = '';
            this.consumerSearchText = '';
            this.closeConsumerResults();
            this.invalidateReport();
            this.$nextTick(() => document.getElementById('customer-sales-consumer').focus());
        },
        invalidateReport() {
            this.hasSearched = false;
            this.consumer = null;
            this.orders = [];
            this.summary = {};
            this.pagination = {current_page: 1, last_page: 1, total: 0, from: 0, to: 0};
        },
        handleOutsideConsumerClick(event) {
            if (this.$refs.consumerSearch && !this.$refs.consumerSearch.contains(event.target)) {
                this.closeConsumerResults();
            }
        },
        fetchData(page) {
            if (!this.canSearch || page < 1 || page > this.pagination.last_page && this.hasSearched) return;
            this.loading = true;
            this.errorMessage = '';

            axios.post(this.dataUrl, Object.assign({}, this.filters, {
                include_returns: this.filters.include_returns ? 1 : 0,
                page: page,
            })).then(response => {
                this.consumer = response.data.consumer;
                this.orders = response.data.orders;
                this.summary = response.data.summary;
                this.pagination = response.data.pagination;
                this.hasSearched = true;
                if (this.showDetails) this.orders.forEach(order => this.$set(order, 'expanded', true));
            }).catch(error => {
                const errors = error.response && error.response.data && error.response.data.errors;
                this.errorMessage = errors ? Object.values(errors)[0][0] : '產生報表時發生錯誤，請稍後再試。';
            }).finally(() => {
                this.loading = false;
            });
        },
        exportCsv() {
            const params = Object.assign({}, this.filters, {
                include_returns: this.filters.include_returns ? 1 : 0,
            });
            delete params.per_page;
            const query = Object.keys(params)
                .map(key => encodeURIComponent(key) + '=' + encodeURIComponent(params[key]))
                .join('&');
            window.location.href = this.exportUrl + '?' + query;
        },
        toggleOrder(order) {
            this.$set(order, 'expanded', !this.isExpanded(order));
        },
        isExpanded(order) {
            return order.expanded === true;
        },
        consumerLabel(consumer) {
            let label = consumer.name;
            if (consumer.shortName) label += `（${consumer.shortName}）`;
            if (consumer.taxID) label += `－${consumer.taxID}`;
            if (consumer.deleted_at) label += '［已停用］';
            return label;
        },
        money(value) {
            return Number(value || 0).toLocaleString('zh-TW', {minimumFractionDigits: 2, maximumFractionDigits: 2});
        },
        number(value) {
            return Number(value || 0).toLocaleString('zh-TW', {maximumFractionDigits: 4});
        },
    },
    watch: {
        showDetails(value) {
            this.orders.forEach(order => this.$set(order, 'expanded', value));
        },
    },
    mounted() {
        document.addEventListener('click', this.handleOutsideConsumerClick);
    },
    beforeDestroy() {
        document.removeEventListener('click', this.handleOutsideConsumerClick);
    },
};
</script>

<style scoped>
.customer-search { position: relative; }
.customer-search-results {
    position: absolute;
    z-index: 1050;
    top: calc(100% - 1rem);
    left: 5px;
    right: 5px;
    max-height: 360px;
    overflow-y: auto;
    box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15);
}
.customer-sales-switch { padding-top: .5rem; padding-bottom: .5rem; }
.customer-sales-table { min-width: 1050px; }
.border-left-primary { border-left: .25rem solid #4e73df !important; }
.border-left-success { border-left: .25rem solid #1cc88a !important; }
.border-left-danger { border-left: .25rem solid #e74a3b !important; }
.border-left-info { border-left: .25rem solid #36b9cc !important; }
.border-left-warning { border-left: .25rem solid #f6c23e !important; }
</style>
