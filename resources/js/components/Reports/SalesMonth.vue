<template>
    <div class="container py-2">
        <div class="row">

            <!-- Left Panel -->
            <div class="col-lg-4 mb-4">

                <!-- Option Section -->
                <div class="card p-4 mb-4">
                    <div class="card-body">
                        <div class="crypto-label mb-2">選擇年份</div>
                        <select id="yearSelect" class="custom-select bg-dark text-white mb-2" @change="changeYear">
                        </select>
                        <div class="crypto-label mb-2">選擇月份</div>
                        <select id="monthSelect" class="custom-select bg-dark text-white" @change="changeMonth">
                        </select>
                    </div>
                </div>

                <!-- Information Section -->
                <div class="card p-4 mb-4">
                    <div class="card-body">
                        <div class="crypto-label mb-3">資訊總覽</div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>總銷售額</span>
                            <strong id="totalSales" class="text-success">{{ formatCurrency(infos.totalSales) }}</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>總銷售數</span>
                            <strong id="productCount">{{ infos.totalSalesCount }}</strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>平均銷售</span>
                            <strong id="avgSales" class="text-info">{{ formatCurrency(infos.averageSales) }}</strong>
                        </div>
                    </div>
                </div>

                <!-- Chart Section -->
                <div class="card p-4">
                    <div class="card-body">
                        <div class="crypto-label mb-2">近三月總銷售趨勢圖</div>
                        <strong id="chartTitle">-</strong>
                        <canvas id="trendChart"></canvas>
                    </div>
                </div>

            </div>

            <!-- Right Panel -->
            <div class="col-lg-8">
                <div class="card p-4">
                    <div class="card-body">
                        <div class="crypto-label mb-3">商品銷售排行榜</div>
                        <input type="text" id="searchInput" class="form-control mb-3 bg-dark text-white" placeholder="搜尋商品..." @input="OnSearchInputChange" />

                        <div id="rankingList" class="list-group">
                            <div v-for="(product, index) in reports" :key="index" class="list-group-item list-group-item-action border-secondary hover-lift" @click="productItemClick(product.p_id, product.name)">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <span class="badge badge-secondary mr-2">{{ index + 1 }}</span>
                                        <strong>{{ product.name }}</strong>
                                        <div class="crypto-label">{{ product.category }}</div>
                                    </div>

                                    <div class="text-right">
                                        <div class="font-weight-bold">{{ formatCurrency( product.sales ) }}</div>
                                        <div v-if="product.change_percent > 0" class="badge badge-danger">
                                            ↗ {{ Math.abs( product.change_percent ) + '%' }}
                                        </div>
                                        <div v-else-if="product.change_percent < 0" class="badge badge-success">
                                            ↘ {{ Math.abs( product.change_percent ) + '%' }}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <nav class="mt-3">
                            <ul id="pagination" class="pagination pagination-sm justify-content-end"></ul>
                        </nav>
                    </div>
                </div>
            </div>

        </div>

        <div class="text-muted text-right mt-4">
            最後更新: {{ new Date().toLocaleString() }}
        </div>
    </div>
</template>

<script>
export default {
    props: [ 'reports', 'infos', 'queryArgs', 'chart' ],
    data(){
        return {
            chartObject: null,
            currentSelectProductName: '',
        }
    },
    watch: {
        chart(newVal) {
            if (newVal && newVal.length) {
                this.drawChart();
            }
        },
        reports(newVal) {
            this.$nextTick(() => {
                const input = document.getElementById('searchInput');
                this.filterRanking(input.value.toLowerCase());
            });
        },
    },
    methods: {
        fetchData() {
            this.$emit('fetch-data');
        },
        changeYear(e){
            this.queryArgs.year = e.target.value;
            this.$emit('fetch-data');
        },
        changeMonth(e){
            this.queryArgs.month = e.target.value;
            this.$emit('fetch-data');
        },
        productItemClick(productId, productName) {
            this.currentSelectProductName = productName;
            this.$emit('get-trend-data', productId);
        },
        formatCurrency(amount) {
            return "$" + amount.toLocaleString() + " TWD";
        },
        filterRanking(searchValue) {
            const rankingList = document.getElementById('rankingList');
            const items = rankingList.getElementsByClassName('list-group-item');

            Array.from(items).forEach(item => {
                const productName = item.querySelector('strong').textContent.toLowerCase();
                if (productName.includes(searchValue)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        },
        OnSearchInputChange(e) {
            const searchValue = e.target.value.toLowerCase();
            this.filterRanking(searchValue);
        },
        generateYearsOptions(currentYear) {
            const yearSelect = document.getElementById('yearSelect');
            for (let y = currentYear; y >= currentYear - 10; y--) {
                const option = document.createElement('option');
                option.value = y;
                option.textContent = y;
                if (y === currentYear) option.selected = true;
                yearSelect.appendChild(option);
            }
        },
        generateMonthOptions(currentMonth) {
            const monthSelect = document.getElementById('monthSelect');
            for (let m = 1; m <= 12; m++) {
                const option = document.createElement('option');
                option.value = m.toString().padStart(2, '0');
                option.textContent = m.toString().padStart(2, '0');
                if (m === currentMonth) option.selected = true;
                monthSelect.appendChild(option);
            }
        },
        generateDatesOptions() {
            this.generateYearsOptions(this.queryArgs.year);
            this.generateMonthOptions(this.queryArgs.month);
        },
        renderData() {
            this.generateDatesOptions();
        },
        drawChart() {
            if (this.chartObject) {
                this.chartObject.destroy();
            }
            const trendChartCtx = document.getElementById("trendChart").getContext("2d");
            const labels = this.chart.map(item => item.month);
            const data = this.chart.map(item => item.total_sales);

            this.chartObject = new Chart(trendChartCtx, {
                type: "line",
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: "Sales",
                            data: data,
                            borderColor: "#10B981",
                            backgroundColor: "rgba(16, 185, 129, 0.1)",
                            tension: 0.4,
                            fill: true,
                        },
                    ],
                },
                options: {
                    responsive: true,
                    plugins: { legend: { display: false } },
                },
            });
            document.getElementById("chartTitle").textContent = this.currentSelectProductName;
        },
    },
    created() {
    },
    mounted() {
        this.renderData();
    }
}
</script>

<style scoped>
.crypto-label {
    letter-spacing: 1px;
}
canvas {
    width: 100% !important;
    height: 200px !important;
}
</style>
