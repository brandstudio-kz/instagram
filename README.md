# Usage
### 1. Create facebook app (developers.facebook.kz)
### 2. Configure Instagram Basic Display
### 3. Add FB_APP_ID, FB_APP_SECRET to .env
### 4. Add tester to your app
### 5. Generate short-lived access_token for your tester
### 6. Run php artisan instagram:token
### 7. Add following lines to your console kernel
```
$schedule->command('instagram:fetch')->everyTwoMinutes();
$schedule->command('instagram:refresh')->monthly();
```
