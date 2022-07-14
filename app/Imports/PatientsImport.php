<?php

namespace App\Imports;

use App\Models\PatientManagement;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class PatientsImport implements ToCollection,WithHeadingRow,WithValidation
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach($rows as $row) {
            $data = [
                'patient_code' =>$row['patient_code'],
                'case_status' =>$row['case_status'],
                'age' =>$row['age'],
                'pat_location_name' =>$row['pat_location_name'],
                'province' =>$row['province'],
                'inputted_by' =>$row['inputted_by'],
                'updated_by' =>$row['updated_by'],
            ];
            PatientManagement::create($data);
        }
    }

    public function rules(): array
    {
        return[
            'patient_code'=>'required|unique:patients,patient_code',
            'case_status'=>'required',
            'age'=>'required',
            'pat_location_name'=>'required',
            'province'=>'required',
            'inputted_by' => 'required'
        ];
    }
}