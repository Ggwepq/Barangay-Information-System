<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        parent::boot();

        // Listen for the BuildingMenu event
        Event::listen(BuildingMenu::class, function (BuildingMenu $event) {
            $user = Auth::user();

            if ($user->userRole == 1) {  // Admin Menu
                $this->adminMenu($event);
            }

            if ($user->userRole == 3) {  // Resident Menu
                $this->userMenu($event);
            }
        });
    }

    public function userMenu(BuildingMenu $event)
    {
        $this->userNavbar($event);

        $event->menu->add('Home');
        $event->menu->add(
            [
                'text' => 'Dashboard',
                'icon' => 'fas fa-fw fa-chart-line',
                'url' => '/user/home',
            ],
        );
        $event->menu->add('Document');
        $event->menu->add(
            [
                'text' => 'Document Request',
                'icon' => 'fas fa-fw fa-chart-line',
                'submenu' => [
                    [
                        'text' => 'Request List',
                        'icon' => 'fas fa-list',
                        'url' => '/user/document',
                    ],
                    [
                        'text' => 'Request Document',
                        'icon' => 'fas fa-plus',
                        'url' => '/user/document/create',
                    ],
                ]
            ],
        );
        $event->menu->add('Utility');
        $event->menu->add(
            [
                'text' => 'Profile',
                'icon' => 'fas fa-fw fa-chart-line',
                'url' => '',
            ],
        );
    }

    public function userNavbar(BuildingMenu $event)
    {
        $event->menu->add(
            [
                'text' => 'Home',
                'topnav' => true,
                'url' => '/user/home',
            ],
            [
                'type' => 'navbar-search',
                'text' => 'search',
                'topnav_right' => true,
            ],
            [
                'type' => 'fullscreen-widget',
                'topnav_right' => true,
            ],
            [
                'type' => 'darkmode-widget',
                'topnav_right' => true,
            ],
        );
    }

    public function adminMenu(BuildingMenu $event)
    {
        $this->adminNavbar($event);

        $event->menu->add(
            [
                'text' => 'Dashboard',
                'url' => '/admin',
                'icon' => 'fas fa-fw fa-chart-line',
            ],
        );

        // Sidebar Items
        $event->menu->add('Resident');
        $event->menu->add(
            [
                'text' => 'Residents',
                'icon' => 'fas fa-fw fa-users',
                'active' => ['regex:@^/admin/Resident/Edit/[0-9]+$@'],
                'submenu' => [
                    [
                        'text' => 'Resident List',
                        'icon' => 'fas fa-list',
                        'url' => '/admin/Resident',
                    ],
                    [
                        'text' => 'New Resident',
                        'icon' => 'fas fa-plus',
                        'url' => '/admin/Resident/Create',
                    ],
                    [
                        'text' => 'Deactivated Resident',
                        'icon' => 'fas fa-trash',
                        'url' => '/admin/Resident/Soft',
                    ],
                    [
                        'text' => 'Resident Accounts',
                        'icon' => 'fas fa-fw fa-users',
                        'url' => '/admin/Resident/Account',
                    ],
                ]
            ],
            [
                'text' => 'Document Requests',
                'icon' => 'fas fa-list',
                'url' => '/admin/document',
            ],
        );
        $event->menu->add('Barangay Issues');
        $event->menu->add(
            [
                'text' => 'Blotter',
                'icon' => 'fas fa-fw fa-scroll',
                'submenu' => [
                    [
                        'text' => 'Blotter List',
                        'icon' => 'fas fa-list',
                        'url' => '/admin/Blotter',
                    ],
                    [
                        'text' => 'New Blotter',
                        'icon' => 'fas fa-plus',
                        'url' => '/admin/Blotter/Create',
                    ],
                    [
                        'text' => 'Deactivated Blotter',
                        'icon' => 'fas fa-trash',
                        'url' => '/admin/Blotter/Soft',
                    ],
                ]
            ],
        );
        $event->menu->add('Management');
        $event->menu->add(
            [
                'text' => 'Projects',
                'icon' => 'fas fa-fw fa-tasks',
                'submenu' => [
                    [
                        'text' => 'Project List',
                        'icon' => 'fas fa-list',
                        'url' => '/admin/Project',
                    ],
                    [
                        'text' => 'New Project',
                        'icon' => 'fas fa-plus',
                        'url' => '/admin/Project/Create',
                    ],
                    [
                        'text' => 'Deactivated Project',
                        'icon' => 'fas fa-trash',
                        'url' => '/admin/Project/Soft',
                    ],
                ]
            ],
            [
                'text' => 'Court Schedules',
                'url' => '/admin/Schedule',
                'icon' => 'fas fa-fw fa-calendar-day',
                'submenu' => [
                    [
                        'text' => 'Schedule List',
                        'icon' => 'fas fa-list',
                        'url' => '/admin/Schedule',
                    ],
                    [
                        'text' => 'New Schedule',
                        'icon' => 'fas fa-plus',
                        'url' => '/admin/Schedule/Create',
                    ],
                    [
                        'text' => 'Deactivated Schedule',
                        'icon' => 'fas fa-trash',
                        'url' => '/admin/Schedule/Soft',
                    ],
                ]
            ],
            [
                'text' => 'Announcements',
                'icon' => 'fas fa-fw fa-bullhorn',
                'submenu' => [
                    [
                        'text' => 'Officer List',
                        'icon' => 'fas fa-list',
                        'url' => '/admin/Officer',
                    ],
                    [
                        'text' => 'New Officer',
                        'icon' => 'fas fa-plus',
                        'url' => '/admin/Officer/Create',
                    ],
                    [
                        'text' => 'Deactivated Officer',
                        'icon' => 'fas fa-trash',
                        'url' => '/admin/Officer/Soft',
                    ],
                ]
            ],
        );
        $event->menu->add('Reports');
        $event->menu->add(
            [
                'text' => 'Reports',
                'url' => '/admin/Report',
                'icon' => 'fas fa-fw fa-print',
            ],
        );

        $event->menu->add('Utilities');
        $event->menu->add(
            [
                'text' => 'Officers',
                'icon' => 'fas fa-fw fa-user-tie',
                'submenu' => [
                    [
                        'text' => 'Officer List',
                        'icon' => 'fas fa-list',
                        'url' => '/admin/Officer',
                    ],
                    [
                        'text' => 'New Officer',
                        'icon' => 'fas fa-plus',
                        'url' => '/admin/Officer/Create',
                    ],
                    [
                        'text' => 'Deactivated Officer',
                        'icon' => 'fas fa-trash',
                        'url' => '/admin/Officer/Soft',
                    ],
                ]
            ],
            [
                'text' => 'Positions',
                'url' => '/admin/Position',
                'icon' => 'fas fa-fw fa-sitemap',
                'submenu' => [
                    [
                        'text' => 'Position List',
                        'icon' => 'fas fa-list',
                        'url' => '/admin/Position',
                    ],
                    [
                        'text' => 'Deactivated Positions',
                        'icon' => 'fas fa-trash',
                        'url' => '/admin/Position/Soft',
                    ],
                ]
            ],
            [
                'text' => 'Workspace',
                'url' => '/admin/Workspace',
                'icon' => 'fas fa-fw fa-briefcase',
            ],
            [
                'text' => 'Settings',
                'icon' => 'fas fa-fw fa-cog',
                'url' => '/admin/Workspace',
            ],
        );
    }

    public function adminNavbar(BuildingMenu $event)
    {
        $event->menu->add(
            [
                'text' => 'Home',
                'topnav' => true,
                'url' => '/admin',
            ],
            [
                'type' => 'navbar-search',
                'text' => 'search',
                'topnav_right' => true,
            ],
            [
                'type' => 'fullscreen-widget',
                'topnav_right' => true,
            ],
            [
                'type' => 'darkmode-widget',
                'topnav_right' => true,
            ],
        );
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
