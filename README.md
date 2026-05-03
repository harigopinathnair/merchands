# Merchands.com Lead-Gen System

### Local setup (XAMPP / MAMP / Laragon)
1. Clone/copy project into htdocs or www folder
2. Start Apache + MySQL
3. Create database: open phpMyAdmin, create database named `nqatsxqe_merchands2026`
4. Import schema: run `database/schema.sql` in phpMyAdmin
5. Run `composer install` in project root (installs PHPMailer)
6. Copy `.env.example` to `.env` and fill in SMTP details
7. Visit `http://localhost/[project-folder]/` — landing page should load
8. Visit `http://localhost/[project-folder]/admin/login.php`
9. Default login: username `admin` / password `changeme123`
10. CHANGE THE DEFAULT PASSWORD immediately (see below)

### Live server (cPanel shared hosting)
1. Upload all files to public_html (or subdirectory)
2. Create MySQL database in cPanel:
   - Database name: `nqatsxqe_merchands2026`
   - Username: `nqatsxqe_2026merchands`
   - Password: `Rankmonk_123@`
   - Assign user to database with ALL PRIVILEGES
3. Import `database/schema.sql` via phpMyAdmin
4. Run `composer install` via SSH or upload vendor/ folder
5. Copy `.env.example` to `.env` and fill in values
6. Ensure HTTPS is enabled (required for secure session cookies)

### Changing the default admin password
```bash
php -r "echo password_hash('your_new_secure_password', PASSWORD_BCRYPT, ['cost'=>12]);"
```
Then in phpMyAdmin run:
```sql
UPDATE admin_users SET password_hash='[output from above]' WHERE username='admin';
```

### Adding additional admin users
```sql
INSERT INTO admin_users (username, password_hash, full_name, email)
VALUES ('newuser', '[bcrypt hash]', 'New User Name', 'email@example.com');
```

### Testing the form locally
- Submit the landing page form
- Check phpMyAdmin → leads table for the new row
- Check that rankmonk@gmail.com received the notification email
- Confirm redirect to thankyou.php shows the correct details

### A/B testing headlines
Append ?v=1, ?v=2, or ?v=3 to the URL to test headline variants.
Set up Google Ads URL parameters: {lpurl}?v=1 for each ad variant.
