# 1. Pull in the stable release
composer require manialab/maniaprintlab:^1.0

# 2. Publish the migrations
php artisan vendor:publish --tag=maniaprintlab-migrations

# 3. Run the migrations (creates configurations, badges_details, and printing tables)
php artisan migrate

# 4. (If you haven’t already) link your storage for file uploads
php artisan storage:link

# 5. Clear & rebuild caches (optional but recommended)
php artisan optimize:clear


Configurations resource

Badge Details resource

Printing Records resource

Print Badges menu tool

You’re then ready to create configuration profiles, badge layouts, and start printing via the shortcode or button.
