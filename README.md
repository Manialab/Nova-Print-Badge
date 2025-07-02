# ManiaLab/ManiaPrintLab

**ManiaPrintLab** is a drop-in Laravel Nova package that provides:


* **Badge Details** resource to define layout settings for all badge elements
* **Printing Records** resource with shortcode generation and one-click print buttons
* **Print Badges** menu tool that loads your legacy print page via an external route
* Publishable migrations for the `maniaprintlab_configurations`, `badges_details`, and `printing` tables

## Requirements

* PHP ^8.0
* Laravel Nova ^4.0

## Installation

```bash
# 1. Pull in the stable release
composer require manialab/maniaprintlab:^1.0

# 2. Publish the migrations
php artisan vendor:publish --tag=maniaprintlab-migrations

# 3. Run the migrations (creates configurations, badges_details, and printing tables)
php artisan migrate

# 4. Link storage for file uploads
php artisan storage:link

# 5. Clear & rebuild caches (optional but recommended)
php artisan optimize:clear
```

## Manual Integration (if using a custom Nova menu)

If you maintain your own `NovaServiceProvider` with a custom `mainMenu`, add:

```php
// app/Providers/NovaServiceProvider.php
use ManiaLab\ManiaPrintLab\Nova\BadgeDetail;
use ManiaLab\ManiaPrintLab\Nova\PrintingRecord;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Menu\MenuItem;

Nova::mainMenu(function () {
    return [
        // … existing sections …

        MenuSection::make(('PrintLab'), [
            MenuItem::resource(BadgeDetail::class)->name(('Badge Details')),
            MenuItem::resource(PrintingRecord::class)->name(('Print Records')),
        ])->icon('printer')->collapsable(),
    ];
});
```

## Usage

1. **Open Nova**
   You will see a **PrintLab** section with:

   * **Badge Details**: define field positions, sizes, and display flags
   * **Printing Records**: view history, copy a `[maniaprint ...]` shortcode, or click **Print**
   * **Print Badges** menu tool: opens your legacy `index.php` print page

2. **Create** a Configuration profile, then add one or more Badge Details entries.

3. **Generate or import** Printing Records. On the index:

   * **Shortcode** column: copy and embed the badge link elsewhere
   * **Print** column: click the button to open the print page in a new tab

### Adding Print Button to Visitor Nova Resource

To add a **Print** button to your custom `Visitor` Nova resource, edit `app/Nova/Visitor.php`:

1. **Import the `Text` field** at the top:

   ```php
   use Laravel\Nova\Fields\Text;
   ```
2. **Append the Print button** to `fields()`:

   ```php
   Text::make('Print', function () {
       $url = route('maniaprintlab.print', [
           $this->token_key,w
           $this->id,
       ]);
       return "<a href=\"{$url}\" target=\"_blank\" class=\"btn btn-primary btn-sm\">Print</a>";
   })
       ->onlyOnIndex()
       ->asHtml()
       ->help('Click to open the badge print page in a new tab.'),
   ```
3. **Clear & rebuild caches**:

   ```bash
   php artisan optimize:clear
   ```

## Contributing

Pull requests welcome! Please adhere to PSR-12 standards and add tests for new features.

## License

This package is open-source under the MIT License.
