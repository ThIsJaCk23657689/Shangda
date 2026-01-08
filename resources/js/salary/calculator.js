// 註冊薪資計算組件
Vue.component('salary-calculator', require('../components/Salary/SalaryCalculator.vue').default);

// 初始化 Vue 實例
const salaryCalculatorApp = new Vue({
    el: '#salary-calculator-app'
});


