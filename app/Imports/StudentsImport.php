<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class StudentsImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading, SkipsOnError, WithValidation, SkipsOnFailure
{
    use Importable, SkipsErrors, SkipsFailures;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function model(array $row)
    {
        return new Student([
            'DNI'  => $row['dni'],
            'name'  => $row['name'],
            'surname'  => $row['surname'],
            'email' => $row['email'],
            'number_phone' => $row['number_phone'],
            'is_active' => $row['is_active'],
            'tutors_id' => $row['tutors_id'],
        ]);
    }
    public function headingRow(): int
    {
        return 1;
    }

    public function batchSize(): int
    {
        return 4000;
    }

    public function chunkSize(): int
    {
        return 4000;
    }
    public function rules(): array
    {
        return [
            '*.dni' => ['numeric|digits:8|required|unique:students,dni'],
            '*.email' => ['email', 'unique:students,email'],
            '*.name' => ['required'],
            '*.surname' => ['required'],
            '*.number_phone' => ['numeric|required|digits:9'],
            '*.is_active' => ['boolean'],
            '*.tutors_id' => ['required|numeric'],

        ];
    }
}
