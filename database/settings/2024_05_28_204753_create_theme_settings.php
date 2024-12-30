<?php

use Illuminate\Support\Facades\Storage;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $themeSettings = [
            'title' => 'Dilamco',
            'default_image' => $this->storePublicFile('/images/default/slider.jpg'),
            'home_page_id' => 1,
            'blog_page_id' => 2,
            'service_page_id' => 3,
            'project_page_id' => 4,
            'career_page_id' => 5,
            'team_page_id' => 6,
            'tag_line' => 'Transform your Montreal home with Dilamco’s expert residential construction and renovation services. Quality craftsmanship you can trust.',
            'favicon' => $this->storePublicFile('/images/default/favicon.png'),
            'header_logo' => $this->storePublicFile('/images/default/logo-minimal.svg'),
            'footer_logo' => $this->storePublicFile('/images/default/logo.svg'),
            'header_menu_id' => 1,
            'header_top_bar_enabled' => true,
            'header_top_bar_social_links_enabled' => true,
            'header_top_bar_action' => [
            ],
            'footer_menu_id' => 1,
            'country' => 'Canada',
            'state' => 'Québec',
            'city' => 'Pierrefonds',
            'address' => '18625 Rue Larocque, H9K 1P1',
            'email' => 'mireya.inbox@mail.com',
            'phone' => '514-820-0773',
            'social_links' => [
                'FA' => 'https://www.facebook.com/dilamco',
                'LI' => 'https://ca.linkedin.com/in/sean-diffley-aaa8a749?original_referer=https%3A%2F%2Fwww.google.com%2F',
                'TW' => 'https://twitter.com/Dilamco',
            ],
        ];

        // Add Theme Settings
        foreach ($themeSettings as $key => $value) {
            $this->migrator->add("theme.$key", $value);
        }
    }

    /**
     * Helper function to store a file in the public disk.
     */
    private function storePublicFile(string $path): string
    {
        return Storage::disk('public')->putFile(public_path($path));
    }
};
