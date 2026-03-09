# Eye Clinic Management System (Laravel 12)

Production-ready Laravel 12 application for managing an eye clinic with patient workflows, invoices, appointments, checkups, sales reporting, delivery tracking, notifications, and RBAC.

## Core Modules

- Patient Management Dashboard
  - Add, edit, update, delete patients
  - Search/filter and pagination
  - Server-side and client-side form validation
  - Auto patient code generation

- Patient Invoice Generation
  - Auto invoice number generation
  - Doctor + patient billing details
  - Eye test, eyeglass, medicine charges
  - Total amount + payment status
  - Print-friendly invoice
  - Download invoice template (HTML export for PDF-ready workflow)

- Appointment Booking + Approval
  - Create appointment requests
  - Approve/reject by Admin/Doctor roles
  - Status tracking (Pending/Approved/Cancelled)
  - Calendar-style listing

- Sales Reports
  - Daily sales
  - Monthly sales
  - Eyeglass sales
  - Medicine sales
  - Total revenue
  - Date-range filter
  - Chart visualization (Chart.js)
  - CSV export (Excel compatible)

- Eyeglass Delivery Management
  - Track order and delivery status
  - Mark as delivered action

- Mobile Notification Logging
  - Log SMS/WhatsApp/Push reminder messages
  - Notification types: Eye checkup, Appointment, Eye camp

- Admin User & Role Management (RBAC)
  - Add/edit/delete users
  - Assign roles
  - Roles: Super Admin, Admin, Doctor, Staff, Receptionist

- Eye Checkup Form
  - Vision test fields
  - SPH/CYL/Axis
  - Eye condition
  - Notes, prescription, follow-up date

## Technical Highlights

- Laravel 12 MVC architecture
- Authentication (session-based)
- Role middleware authorization
- REST-ready API routes in `routes/api.php`
- Database relationships with foreign keys
- Seeded demo data for fast setup
- Bootstrap 5 responsive UI

## Database Entities

- `roles`
- `users` (linked to `roles`)
- `patients`
- `invoices`
- `appointments`
- `eyeglass_orders`
- `eye_checkups`
- `notification_logs`

## Installation

1. Install dependencies

```bash
composer install
```

2. Configure environment

```bash
cp .env.example .env
```

Update DB credentials in `.env`.

3. Generate app key

```bash
php artisan key:generate
```

4. Run migrations + seeders

```bash
php artisan migrate:fresh --seed
```

5. Start server

```bash
php artisan serve
```

Open `http://127.0.0.1:8000`.

## Default Demo Users

After seeding:

- Super Admin: `admin@eyeclinic.test` / `Password@123`
- Doctor: `doctor@eyeclinic.test` / `Password@123`
- Receptionist: `reception@eyeclinic.test` / `Password@123`

## API Endpoints (Sample)

- `GET /api/patients`
- `GET /api/patients/{id}`
- `POST /api/patients`
- `GET /api/appointments`
- `GET /api/invoices`

## Notes

- Invoice "Download PDF" action exports a print-ready HTML file that can be saved as PDF from browser print dialog.
- For direct binary PDF generation, integrate DomPDF (`barryvdh/laravel-dompdf`) in environments with package install access.
