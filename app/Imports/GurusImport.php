<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class GurusImport implements ToModel, WithChunkReading, WithStartRow
{
    protected $roles = [
        'Admin', 'Siswa', 'Guru', 'Tenaga Kependidikan', 'Kepala Sekolah', 'Guru BK',
        'Wakasek Kurikulum', 'Wakasek Kesiswaan', 'Wakasek Hubin', 'Wakasek Sarpras',
        'Kaprog PPLG', 'Kaprog AKL', 'Kaprog MPLB', 'Kaprog PM',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $role = $this->validateRole((string) $row[2]);
        $pwd = rand(1000, 9999);
        $password = empty($row[3]) ? $pwd : (string) $row[3];

        return new User([
            'name' => (string) $row[0],
            'email' => (string) $row[1],
            'role' => $role,
            'kelas' => '-',
            'password' => Hash::make($password),
            'sandi' => $password,
        ]);
    }

    protected function validateRole($role)
    {
        $lowercasedRole = strtolower($role);
        $validRoles = array_map('strtolower', $this->roles);

        if (! in_array($lowercasedRole, $validRoles)) {
            throw ValidationException::withMessages(['role' => "Invalid role: $role"]);
        }

        // Return the original case role as per the valid roles array
        return $this->roles[array_search($lowercasedRole, $validRoles)];
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
