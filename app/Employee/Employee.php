<?php

namespace App\Employee;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    protected $table = 'employees';

    protected $fillable = [
        'name',
        'gender',
        'nationality',
        'id_type',
        'id_number',
        'birth_date',
        'phone',
        'address',
        'address_zipcode',
        'address_county',
        'address_district',
        'address_others',
        'base_salary',
        'health_insurance_dependents',
        'status',
        'hired_date',
        'resigned_date',
    ];

    protected $casts = [
        'birth_date'    => 'date',
        'hired_date'    => 'date',
        'resigned_date' => 'date',
        'gender'        => 'integer',
        'id_type'       => 'integer',
        'status'        => 'integer',
        'base_salary'   => 'float',
        'health_insurance_dependents' => 'integer',
    ];

    // ----------------------------------------
    // 常數定義
    // ----------------------------------------

    const GENDER_FEMALE = 0;
    const GENDER_MALE   = 1;

    const ID_TYPE_NATIONAL_ID   = 1; // 身分證
    const ID_TYPE_PASSPORT      = 2; // 護照
    const ID_TYPE_RESIDENT_CERT = 3; // 居留證

    const STATUS_RESIGNED = 0;
    const STATUS_ACTIVE   = 1;

    // ----------------------------------------
    // Accessor（方便顯示用的中文標籤）
    // ----------------------------------------

    public function getGenderLabelAttribute(): string
    {
        return $this->gender === self::GENDER_MALE ? '男' : '女';
    }

    public function getIdTypeLabelAttribute(): string
    {
        $map = [
            self::ID_TYPE_NATIONAL_ID   => '身分證',
            self::ID_TYPE_PASSPORT      => '護照',
            self::ID_TYPE_RESIDENT_CERT => '居留證',
        ];
        return $map[$this->id_type] ?? '未知';
    }

    public function getStatusLabelAttribute(): string
    {
        return $this->status === self::STATUS_ACTIVE ? '在職' : '離職';
    }

    // ----------------------------------------
    // 關聯
    // ----------------------------------------

    /**
     * 銀行帳號（可能有多筆）
     */
    public function bankAccounts()
    {
        return $this->hasMany(EmployeeBankAccount::class);
    }

    /**
     * 主要銀行帳號
     */
    public function primaryBankAccount()
    {
        return $this->hasOne(EmployeeBankAccount::class)->where('is_primary', 1);
    }

    /**
     * 緊急聯絡人（可能有多筆）
     */
    public function emergencyContacts()
    {
        return $this->hasMany(EmployeeEmergencyContact::class);
    }

    // ----------------------------------------
    // Scope（常用查詢條件）
    // ----------------------------------------

    /**
     * 只查在職員工
     */
    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    /**
     * 只查離職員工
     */
    public function scopeResigned($query)
    {
        return $query->where('status', self::STATUS_RESIGNED);
    }
}
