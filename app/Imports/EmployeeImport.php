<?php

namespace App\Imports;

use App\Mail\EmployeeMail;
use App\Models\Employee;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class EmployeeImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            $employee = Employee::create([
                'date' => $row['date'],
                'first_name' => $row['firstname'],
                'last_name' => $row['lastname'],
                'gender' => $row['gender'],
                'phone' => $row['phone_number'],
                'email' => $row['email_address'],
                'role' => $row['role'],
                'salary_level' => $row['salary_level'],
            ]);
        }
    }
}
