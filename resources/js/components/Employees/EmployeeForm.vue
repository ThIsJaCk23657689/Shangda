<template>
    <div class="card mb-3">

        <div class="card-header">
            <i class="fas fa-id-card"></i>
            {{ isEdit ? '編輯員工' : '新增員工' }}
        </div>
        
        <div class="card-body">
            <form @submit.prevent="submitForm">

                <h5 class="mb-3">基本資料</h5>
                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label><span class="text-danger mr-1">*</span>姓名</label>
                        <input v-model="form.name" type="text" class="form-control" :class="inputClass('name')">
                        <div class="invalid-feedback">{{ firstError('name') }}</div>
                    </div>

                    <div class="form-group col-md-4">
                        <label>國籍</label>
                        <select v-model="form.nationality" class="form-control" :class="inputClass('nationality')">
                            <option value="">請選擇</option>
                            <option v-for="item in nationalityOptions" :key="item" :value="item">{{ item }}</option>
                            <option value="__OTHER__">其他</option>
                        </select>
                        <div class="invalid-feedback">{{ firstError('nationality') }}</div>
                    </div>

                    <div class="form-group col-md-4" v-if="form.nationality === '__OTHER__'">
                        <label>其他國籍</label>
                        <input v-model="form.other_nationality" type="text" class="form-control" :class="inputClass('other_nationality')">
                        <div class="invalid-feedback">{{ firstError('other_nationality') }}</div>
                    </div>

                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label>性別</label>
                        <select v-model="form.gender" class="form-control" :class="inputClass('gender')">
                            <option :value="0">女</option>
                            <option :value="1">男</option>
                        </select>
                        <div class="invalid-feedback">{{ firstError('gender') }}</div>
                    </div>

                    <div class="form-group col-md-3">
                        <label>狀態</label>
                        <select v-model="form.status" class="form-control" :class="inputClass('status')">
                            <option :value="1">在職</option>
                            <option :value="0">離職</option>
                        </select>
                        <div class="invalid-feedback">{{ firstError('status') }}</div>
                    </div>

                    <div class="form-group col-md-3">
                        <label>證件類型</label>
                        <select v-model="form.id_type" class="form-control" :class="inputClass('id_type')">
                            <option :value="1">身分證</option>
                            <option :value="2">護照</option>
                            <option :value="3">居留證</option>
                        </select>
                        <div class="invalid-feedback">{{ firstError('id_type') }}</div>
                    </div>

                    <div class="form-group col-md-3">
                        <label>證件號碼</label>
                        <input v-model="form.id_number" type="text" class="form-control" :class="inputClass('id_number')">
                        <div class="invalid-feedback">{{ firstError('id_number') }}</div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label>出生年月日</label>
                        <input v-model="form.birth_date" type="text" id="birth_date" class="form-control" :class="inputClass('birth_date')">
                        <div class="invalid-feedback">{{ firstError('birth_date') }}</div>
                    </div>

                    <div class="form-group col-md-3">
                        <label>手機</label>
                        <input v-model="form.phone" type="text" class="form-control" :class="inputClass('phone')">
                        <div class="invalid-feedback">{{ firstError('phone') }}</div>
                    </div>

                    <div class="form-group col-md-3">
                        <label>基本月薪</label>
                        <input v-model="form.base_salary" type="number" min="0" step="0.01" class="form-control" :class="inputClass('base_salary')">
                        <div class="invalid-feedback">{{ firstError('base_salary') }}</div>
                    </div>

                    <div class="form-group col-md-3">
                        <label>健保眷屬數</label>
                        <select v-model.number="form.health_insurance_dependents" class="form-control" :class="inputClass('health_insurance_dependents')">
                            <option :value="0">本人</option>
                            <option :value="1">本人+1</option>
                            <option :value="2">本人+2</option>
                            <option :value="3">本人+3</option>
                        </select>
                        <div class="invalid-feedback">{{ firstError('health_insurance_dependents') }}</div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>到職日</label>
                        <input v-model="form.hired_date" type="text" id="hired_date" name="hired_date" class="form-control" :class="inputClass('hired_date')">
                        <div class="invalid-feedback">{{ firstError('hired_date') }}</div>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label>離職日</label>
                        <input v-model="form.resigned_date" type="text" id="resigned_date" name="resigned_date" class="form-control" :class="inputClass('resigned_date')">
                        <div class="invalid-feedback">{{ firstError('resigned_date') }}</div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-12">

                        <div id="address_twzipcode" class="form-group">
                            <label>地址</label>
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <twzipcode-county v-model="form.address_county" class="form-control" :class="inputClass('address_county')"></twzipcode-county>
                                    <div class="invalid-feedback">{{ firstError('address_county') }}</div>
                                </div>
                                <div class="col-md-4">
                                    <twzipcode-zipcode id="twzipcode_zipcode" text-template=":city" value-template=":city" :filter-by-county="form.address_county" v-model="form.address_district" class="form-control" :class="inputClass('address_district')" @input="updateZipcode(form)"></twzipcode-zipcode>
                                    <div class="invalid-feedback">{{ firstError('address_district') }}</div>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" v-model="form.address_zipcode" :class="inputClass('address_zipcode')" readonly>
                                    <div class="invalid-feedback">{{ firstError('address_zipcode') }}</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input v-model="form.address_others" id="address_others" type="text" class="form-control" :class="inputClass('address_others')" name="address_others" autocomplete="off">
                                    <div class="invalid-feedback">{{ firstError('address_others') }}</div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <hr>

                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5 class="mb-0"><span class="text-danger mr-1">*</span>銀行帳號</h5>
                    <button type="button" class="btn btn-sm btn-outline-primary" @click="addBankAccount">新增銀行帳號</button>
                </div>
                <div v-if="firstError('bank_accounts')" class="text-danger mb-2">{{ firstError('bank_accounts') }}</div>
                <div v-for="(account, index) in form.bank_accounts" :key="`bank-${index}`" class="border rounded p-3 mb-2">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label><span class="text-danger mr-1">*</span>銀行</label>
                            <select class="form-control" :value="bankValue(account)" @change="onBankChange(index, $event.target.value)">
                                <option value="">請選擇銀行</option>
                                <option v-for="bank in bankOptions" :key="bank.code" :value="bank.code">{{ bank.code }} {{ bank.name }}</option>
                            </select>
                            <div class="small text-danger" v-if="firstError(`bank_accounts.${index}.bank_code`)">{{ firstError(`bank_accounts.${index}.bank_code`) }}</div>
                        </div>
                        <div class="form-group col-md-3">
                            <label>銀行代碼</label>
                            <input :value="account.bank_code" type="text" class="form-control" readonly>
                        </div>
                        <div class="form-group col-md-3">
                            <label>銀行名稱</label>
                            <input :value="account.bank_name" type="text" class="form-control" readonly>
                        </div>
                        <div class="form-group col-md-2 d-flex align-items-center">
                            <div class="form-check mt-4">
                                <input :id="`is-primary-${index}`" class="form-check-input" type="radio" name="is_primary" :checked="Number(account.is_primary) === 1" @change="setPrimary(index)">
                                <label class="form-check-label" :for="`is-primary-${index}`">主要</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label><span class="text-danger mr-1">*</span>帳號</label>
                            <input v-model="account.account_number" type="text" class="form-control" :class="inputClass(`bank_accounts.${index}.account_number`)">
                            <div class="invalid-feedback">{{ firstError(`bank_accounts.${index}.account_number`) }}</div>
                        </div>
                        <div class="form-group col-md-4 d-flex align-items-end justify-content-end">
                            <button type="button" class="btn btn-sm btn-outline-danger" :disabled="form.bank_accounts.length === 1" @click="removeBankAccount(index)">刪除銀行帳號</button>
                        </div>
                    </div>
                </div>
                <hr>

                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5 class="mb-0">緊急聯絡人（選填）</h5>
                    <button type="button" class="btn btn-sm btn-outline-primary" @click="addEmergencyContact">新增聯絡人</button>
                </div>
                <div v-for="(contact, index) in form.emergency_contacts" :key="`contact-${index}`" class="border rounded p-3 mb-2">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label>關係</label>
                            <input v-model="contact.relationship" type="text" class="form-control" :class="inputClass(`emergency_contacts.${index}.relationship`)">
                            <div class="invalid-feedback">{{ firstError(`emergency_contacts.${index}.relationship`) }}</div>
                        </div>

                        <div class="form-group col-md-3">
                            <label>姓名</label>
                            <input v-model="contact.name" type="text" class="form-control" :class="inputClass(`emergency_contacts.${index}.name`)">
                            <div class="invalid-feedback">{{ firstError(`emergency_contacts.${index}.name`) }}</div>
                        </div>

                        <div class="form-group col-md-3">
                            <label>電話</label>
                            <input v-model="contact.phone" type="text" class="form-control" :class="inputClass(`emergency_contacts.${index}.phone`)">
                            <div class="invalid-feedback">{{ firstError(`emergency_contacts.${index}.phone`) }}</div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-danger" @click="removeEmergencyContact(index)">刪除聯絡人</button>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary mr-2" :disabled="submitting">{{ submitting ? '處理中...' : '送出' }}</button>
                    <a href="/backend/employees" class="btn btn-secondary">返回列表</a>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import twzipcode from 'twzipcode-data'
export default {
    name: 'EmployeeFormPage',
    props: {
        mode: {
            type: String,
            default: 'create',
        },
        employeeId: {
            type: Number,
            default: null,
        },
    },
    data() {
        return {
            submitting: false,
            errors: {},
            nationalityOptions: ['中華民國(臺灣)', '日本', '韓國', '越南', '印尼', '菲律賓', '泰國', '馬來西亞', '美國', '加拿大'],
            bankOptions: [
                { code: '004', name: '臺灣銀行' },
                { code: '005', name: '土地銀行' },
                { code: '006', name: '合作金庫' },
                { code: '007', name: '第一銀行' },
                { code: '008', name: '華南銀行' },
                { code: '009', name: '彰化銀行' },
                { code: '011', name: '上海商業儲蓄銀行' },
                { code: '012', name: '台北富邦銀行' },
                { code: '013', name: '國泰世華銀行' },
                { code: '017', name: '兆豐國際商業銀行' },
                { code: '048', name: '王道銀行' },
                { code: '050', name: '臺灣中小企業銀行' },
                { code: '052', name: '渣打國際商業銀行' },
                { code: '053', name: '台中商業銀行' },
                { code: '054', name: '京城商業銀行' },
                { code: '081', name: '滙豐(台灣)商業銀行' },
                { code: '103', name: '新光銀行' },
                { code: '108', name: '陽信銀行' },
                { code: '118', name: '板信商業銀行' },
                { code: '147', name: '三信商業銀行' },
                { code: '700', name: '中華郵政' },
                { code: '803', name: '聯邦銀行' },
                { code: '805', name: '遠東國際商業銀行' },
                { code: '806', name: '元大商業銀行' },
                { code: '807', name: '永豐商業銀行' },
                { code: '808', name: '玉山商業銀行' },
                { code: '809', name: '凱基商業銀行' },
                { code: '810', name: '星展(台灣)商業銀行' },
                { code: '812', name: '台新國際商業銀行' },
                { code: '822', name: '中國信託商業銀行' },
            ],
            form: {
                name: '',
                gender: 0,
                nationality: '',
                other_nationality: '',
                id_type: 1,
                id_number: '',
                birth_date: '',
                phone: '',
                address_zipcode: '',
                address_county: '',
                address_district: '',
                address_others: '',
                base_salary: 29500,
                health_insurance_dependents: 0,
                status: 1,
                hired_date: '',
                resigned_date: '',
                bank_accounts: [this.emptyBankAccount(true)],
                emergency_contacts: [],
            },
        };
    },
    computed: {
        isEdit() {
            return this.mode === 'edit';
        }
    },
    created() {
        if (this.isEdit && this.employeeId) {
            this.fetchEmployee();
        }
    },
    mounted() {
        // 生日
        $("#birth_date").datepicker({
            dateFormat: 'yy-mm-dd',
            changeYear: true,
            changeMonth: true,
            yearRange: "-80:+0",
            maxDate: '-15y',
            onSelect: function(dateText) {
                this.value = dateText;
                this.dispatchEvent(new Event('input'));
            }
        });

        // 到職日
        $("#hired_date").datepicker({
            dateFormat: 'yy-mm-dd',
            changeYear: true,
            changeMonth: true,
            yearRange: "-80:+5",
            onSelect: function(dateText) {
                this.value = dateText;
                this.dispatchEvent(new Event('input'));
            }
        });

        // 離職日
        $("#resigned_date").datepicker({
            dateFormat: 'yy-mm-dd',
            changeYear: true,
            changeMonth: true,
            yearRange: "-80:+5",
            onSelect: function(dateText) {
                this.value = dateText;
                this.dispatchEvent(new Event('input'));
            }
        });
    },
    methods: {
        updateZipcode(addressObj) {
            const data = twzipcode();
            const found = data.zipcodes.find(item => 
                item.county === addressObj.address_county && 
                item.city === addressObj.address_district
            );
            addressObj.address_zipcode = found ? found.zipcode.toString() : '';
        },
        emptyBankAccount(primary) {
            return { bank_code: '', bank_name: '', account_number: '', is_primary: primary ? 1 : 0 };
        },
        emptyEmergencyContact() {
            return {
                relationship: '',
                name: '',
                phone: '',
            };
        },
        fetchEmployee() {
            axios.get(`/backend/employees/${this.employeeId}`).then((response) => {
                const data = response.data.data;
                this.form = {
                    name: data.name || '',
                    gender: data.gender === null ? 0 : Number(data.gender),
                    nationality: data.nationality && this.nationalityOptions.includes(data.nationality) ? data.nationality : (data.nationality ? '__OTHER__' : ''),
                    other_nationality: data.nationality && !this.nationalityOptions.includes(data.nationality) ? data.nationality : '',
                    id_type: data.id_type === null ? null : Number(data.id_type),
                    id_number: data.id_number || '',
                    birth_date: this.normalizeDate(data.birth_date),
                    phone: data.phone || '',
                    address_zipcode: data.address_zipcode || '',
                    address_county: data.address_county || '',
                    address_district: data.address_district || '',
                    address_others: data.address_others || '',
                    base_salary: Number(data.base_salary || 29500),
                    health_insurance_dependents: Number(data.health_insurance_dependents || 0),
                    status: Number(data.status || 1),
                    hired_date: this.normalizeDate(data.hired_date),
                    resigned_date: this.normalizeDate(data.resigned_date),
                    bank_accounts: this.normalizeBankAccounts(data.bank_accounts || []),
                    emergency_contacts: this.normalizeEmergencyContacts(data.emergency_contacts || []),
                };
            }).catch(() => {
                if (window.$ && $.showErrorModalWithoutError) {
                    $.showErrorModalWithoutError('讀取員工資料失敗');
                }
            });
        },
        normalizeDate(value) {
            return value ? String(value).slice(0, 10) : '';
        },
        normalizeBankAccounts(accounts) {
            if (!accounts.length) return [this.emptyBankAccount(true)];
            let hasPrimary = false;
            const normalized = accounts.map((item) => {
                const isPrimary = Number(item.is_primary) === 1;
                if (isPrimary) hasPrimary = true;
                return {
                    bank_code: item.bank_code || '',
                    bank_name: item.bank_name || '',
                    account_number: item.account_number || '',
                    is_primary: isPrimary ? 1 : 0,
                };
            });
            if (!hasPrimary) normalized[0].is_primary = 1;
            return normalized;
        },
        normalizeEmergencyContacts(contacts) {
            return (contacts || []).map((item) => {
                return {
                    relationship: item.relationship || '',
                    name: item.name || '',
                    phone: item.phone || '',
                };
            });
        },
        isEmergencyContactFilled(contact) {
            return Boolean(
                (contact.relationship || '').trim() ||
                (contact.name || '').trim() ||
                (contact.phone || '').trim()
            );
        },
        bankValue(account) {
            if (!account.bank_code) return '';
            return account.bank_code;
        },
        onBankChange(index, bankCode) {
            const bank = this.bankOptions.find((item) => item.code === bankCode);
            if (!bank) {
                this.form.bank_accounts[index].bank_code = '';
                this.form.bank_accounts[index].bank_name = '';
                return;
            }
            this.form.bank_accounts[index].bank_code = bank.code;
            this.form.bank_accounts[index].bank_name = bank.name;
        },
        addBankAccount() {
            this.form.bank_accounts.push(this.emptyBankAccount(false));
        },
        removeBankAccount(index) {
            if (this.form.bank_accounts.length === 1) return;
            const removed = this.form.bank_accounts[index];
            this.form.bank_accounts.splice(index, 1);
            if (Number(removed.is_primary) === 1) this.form.bank_accounts[0].is_primary = 1;
        },
        setPrimary(index) {
            this.form.bank_accounts = this.form.bank_accounts.map((item, idx) => ({ ...item, is_primary: idx === index ? 1 : 0 }));
        },
        addEmergencyContact() {
            this.form.emergency_contacts.push(this.emptyEmergencyContact());
        },
        removeEmergencyContact(index) {
            this.form.emergency_contacts.splice(index, 1);
        },
        inputClass(field) {
            return this.errors[field] ? 'is-invalid' : '';
        },
        firstError(field) {
            const value = this.errors[field];
            return Array.isArray(value) ? value[0] : (value || '');
        },
        validateFront() {
            const errors = {};
            if (!this.form.name) errors.name = ['姓名為必填'];
            if (this.form.nationality === '__OTHER__' && !this.form.other_nationality.trim()) {
                errors.other_nationality = ['請填寫其他國籍'];
            }
            if (Number(this.form.status) === 0 && !this.form.resigned_date) {
                errors.resigned_date = ['狀態為離職時，離職日為必填'];
            }
            if (this.form.hired_date && this.form.resigned_date && this.form.resigned_date < this.form.hired_date) {
                errors.resigned_date = ['離職日不能比到職日早'];
            }
            if (!this.form.bank_accounts.length) errors.bank_accounts = ['至少需要一筆銀行帳號'];

            let hasPrimary = false;
            this.form.bank_accounts.forEach((account, index) => {
                if (!account.bank_code) errors[`bank_accounts.${index}.bank_code`] = ['銀行為必填'];
                if (!account.account_number) errors[`bank_accounts.${index}.account_number`] = ['帳號為必填'];
                if (Number(account.is_primary) === 1) hasPrimary = true;
            });
            if (this.form.bank_accounts.length && !hasPrimary) errors.bank_accounts = ['請至少設定一筆主要帳號'];

            this.form.emergency_contacts.forEach((contact, index) => {
                if (!this.isEmergencyContactFilled(contact)) return;
            });

            this.errors = errors;
            return Object.keys(errors).length === 0;
        },
        payload() {
            const nationality = this.form.nationality === '__OTHER__' ? this.form.other_nationality : this.form.nationality;
            return {
                name: this.form.name,
                gender: this.form.gender,
                nationality: nationality || null,
                id_type: this.form.id_type,
                id_number: this.form.id_number || null,
                birth_date: this.form.birth_date || null,
                phone: this.form.phone || null,
                address_zipcode: this.form.address_zipcode || null,
                address_county: this.form.address_county || null,
                address_district: this.form.address_district || null,
                address_others: this.form.address_others || null,
                base_salary: this.form.base_salary === '' ? null : Number(this.form.base_salary),
                health_insurance_dependents: Number(this.form.health_insurance_dependents || 0),
                status: this.form.status,
                hired_date: this.form.hired_date || null,
                resigned_date: this.form.resigned_date || null,
                bank_accounts: this.form.bank_accounts.map((item) => ({
                    bank_code: item.bank_code,
                    bank_name: item.bank_name,
                    account_number: item.account_number,
                    is_primary: Number(item.is_primary),
                })),
                emergency_contacts: this.form.emergency_contacts.map((item) => ({
                    relationship: item.relationship || null,
                    name: item.name || null,
                    phone: item.phone || null,
                })).filter((item, index) => {
                    const source = this.form.emergency_contacts[index];
                    return this.isEmergencyContactFilled(source);
                }),
            };
        },
        submitForm() {
            if (!this.validateFront()) return;

            this.submitting = true;
            this.errors = {};
            const requestConfig = this.isEdit ? { method: 'put', url: `/backend/employees/${this.employeeId}` } : { method: 'post', url: '/backend/employees' };

            axios({ method: requestConfig.method, url: requestConfig.url, data: this.payload() })
                .then((response) => {
                    if (response.data && response.data.success) {
                        window.location.href = '/backend/employees';
                    }
                })
                .catch((error) => {
                    const response = error.response ? error.response.data : null;
                    if (response && response.errors) this.errors = response.errors;
                    if (window.$ && $.showErrorModalWithoutError) {
                        $.showErrorModalWithoutError((response && response.message) || '送出失敗');
                    }
                })
                .finally(() => {
                    this.submitting = false;
                });
        },
    },
};
</script>
