<?php

return [
    'features' => [
        'dashboard' => 'Dashboard',
        'patients' => 'Patients',
        'appointments' => 'Appointments',
        'invoices' => 'Invoices',
        'eyeglass-orders' => 'Eyeglass Delivery',
        'checkups' => 'Eye Checkups',
        'reports' => 'Sales Reports',
        'users' => 'User Management',
        'notifications' => 'Notifications',
        'branding' => 'Branding',
        'permissions' => 'Permissions / Access',
    ],
    'defaults' => [
        'Super Admin' => ['*'],
        'Admin' => ['dashboard', 'patients', 'appointments', 'invoices', 'reports', 'users', 'notifications', 'eyeglass-orders', 'branding', 'permissions', 'checkups'],
        'Doctor' => ['dashboard', 'patients', 'appointments', 'checkups'],
        'Staff' => ['dashboard', 'patients', 'eyeglass-orders', 'invoices'],
        'Receptionist' => ['dashboard', 'patients', 'appointments'],
    ],
];
