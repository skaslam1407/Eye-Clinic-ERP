<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\EyeCheckup;
use App\Models\EyeglassOrder;
use App\Models\Invoice;
use App\Models\Patient;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $roles = collect([
            ['name' => 'Super Admin', 'permissions' => ['*']],
            ['name' => 'Admin', 'permissions' => ['patients', 'appointments', 'invoices', 'reports', 'users', 'notifications']],
            ['name' => 'Doctor', 'permissions' => ['patients', 'appointments', 'checkups']],
            ['name' => 'Staff', 'permissions' => ['patients', 'deliveries', 'invoices']],
            ['name' => 'Receptionist', 'permissions' => ['patients', 'appointments']],
        ])->mapWithKeys(fn ($role) => [$role['name'] => Role::updateOrCreate(['name' => $role['name']], $role)]);

        $superAdmin = User::updateOrCreate([
            'email' => 'admin@eyeclinic.test',
        ], [
            'name' => 'Super Admin',
            'phone' => '9999999999',
            'password' => Hash::make('Password@123'),
            'role_id' => $roles['Super Admin']->id,
        ]);

        $doctor = User::updateOrCreate([
            'email' => 'doctor@eyeclinic.test',
        ], [
            'name' => 'Dr. Rahul Sen',
            'phone' => '8888888888',
            'password' => Hash::make('Password@123'),
            'role_id' => $roles['Doctor']->id,
        ]);

        $reception = User::updateOrCreate([
            'email' => 'reception@eyeclinic.test',
        ], [
            'name' => 'Reception User',
            'phone' => '7777777777',
            'password' => Hash::make('Password@123'),
            'role_id' => $roles['Receptionist']->id,
        ]);

        for ($i = 1; $i <= 20; $i++) {
            $patient = Patient::create([
                'patient_code' => 'PAT-' . str_pad((string) $i, 5, '0', STR_PAD_LEFT),
                'name' => "Patient {$i}",
                'age' => rand(18, 70),
                'gender' => ['Male', 'Female', 'Other'][array_rand(['Male', 'Female', 'Other'])],
                'phone' => '98' . rand(10000000, 99999999),
                'address' => "Address {$i}",
                'email' => "patient{$i}@mail.test",
                'eye_problem' => ['Blurred vision', 'Dry eye', 'Headache', 'Routine checkup'][array_rand(['a', 'b', 'c', 'd'])],
                'registration_date' => now()->subDays(rand(1, 120))->toDateString(),
            ]);

            Appointment::create([
                'patient_id' => $patient->id,
                'doctor_id' => $doctor->id,
                'appointment_date' => now()->addDays(rand(0, 20))->toDateString(),
                'appointment_time' => now()->setTime(rand(9, 18), [0, 30][rand(0, 1)])->format('H:i:s'),
                'status' => ['Pending', 'Approved', 'Cancelled'][rand(0, 2)],
                'notes' => 'Follow regular checkup.',
            ]);

            $invoice = Invoice::create([
                'invoice_number' => 'INV-' . now()->format('Y') . '-' . str_pad((string) $i, 5, '0', STR_PAD_LEFT),
                'patient_id' => $patient->id,
                'doctor_id' => $doctor->id,
                'eye_test_charges' => rand(200, 800),
                'eyeglass_charges' => rand(500, 2500),
                'medicine_charges' => rand(100, 900),
                'total_amount' => 0,
                'payment_status' => rand(0, 1) ? 'Paid' : 'Pending',
                'invoice_date' => now()->subDays(rand(0, 60))->toDateString(),
            ]);
            $invoice->update([
                'total_amount' => $invoice->eye_test_charges + $invoice->eyeglass_charges + $invoice->medicine_charges,
            ]);

            EyeglassOrder::create([
                'patient_id' => $patient->id,
                'eyeglass_type' => ['Single Vision', 'Progressive', 'Blue Cut'][rand(0, 2)],
                'lens_power' => ['-1.25', '-2.00', '+0.75', '-0.50'][rand(0, 3)],
                'order_date' => now()->subDays(rand(1, 25))->toDateString(),
                'delivery_date' => rand(0, 1) ? now()->toDateString() : null,
                'delivery_status' => rand(0, 1) ? 'Delivered' : 'Pending',
            ]);

            EyeCheckup::create([
                'patient_id' => $patient->id,
                'doctor_id' => $doctor->id,
                'vision_test' => 'Snellen',
                'right_eye_vision' => '6/6',
                'left_eye_vision' => '6/9',
                'lens_power' => '-1.25',
                'sph' => '-1.00',
                'cyl' => '-0.50',
                'axis' => '90',
                'eye_condition' => ['Cataract', 'Glaucoma', 'Dry Eye', 'Normal'][rand(0, 3)],
                'doctor_notes' => 'Monitor symptoms and follow-up.',
                'prescription' => 'Use drops twice daily.',
                'recommended_glasses' => 'Blue light filter lenses',
                'follow_up_date' => now()->addDays(rand(15, 45))->toDateString(),
            ]);
        }
    }
}
