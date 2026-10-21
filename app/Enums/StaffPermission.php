<?php

namespace App\Enums;

enum StaffPermission: string
{
    case AccessBackend = 'backend.access';
    case ManageMasterData = 'master-data.manage';
    case ManageTransactions = 'transactions.manage';
    case ManageEmployees = 'employees.manage';
    case ViewReports = 'reports.view';
    case ManagePayroll = 'payroll.manage';
}
