<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class SiswasImport implements ToModel, WithChunkReading, WithStartRow
{
    private $currentRow = 2; // Start from 2 as startRow returns 2

    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Skip entirely empty rows
        if (empty($row[0]) && empty($row[1]) && empty($row[2]) && empty($row[3]) && empty($row[4])) {
            return null;
        }

        // Validate that name, email, and kelas are not empty
        if (empty($row[0]) || empty($row[1]) || empty($row[3])) {
            throw ValidationException::withMessages([
                'row' => "Error: Kolom nama, email, dan kelas tidak boleh kosong pada baris {$this->currentRow}.",
            ]);
        }

        $pwd = rand(1000, 9999);
        $password = empty($row[2]) ? $pwd : (string) $row[2];

        // Increment the current row counter after processing
        $this->currentRow++;

        return new User([
            'name' => (string) $row[0],
            'email' => (string) $row[1],
            'role' => 'Siswa',
            'kelas' => (string) $row[3],
            'password' => Hash::make($password),
            'sandi' => $password,
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }

    public function chunkSize(): int
    {
        return 100;
    }
}
