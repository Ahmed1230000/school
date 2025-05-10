<?php

namespace App\Providers;

use App\Contracts\LogErrorInterface;
use App\Service\MessageService;
use App\Contracts\RepositoryInterface;
use App\Contracts\CustomeMessageInterface;
use App\Repositories\ClassRoomRepository;
use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use App\Repositories\StudentRepository;
use App\Repositories\TeacherRepository;
use App\Service\ClassRoomService;
use App\Service\LogErrorService;
use App\Service\PermissionService;
use App\Service\RoleService;
use App\Service\StudentService;
use App\Service\TeacherService;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Binding repository interfaces to their implementations
        $this->app->when(RoleService::class)
            ->needs(RepositoryInterface::class)
            ->give(RoleRepository::class);

        $this->app->when(PermissionService::class)
            ->needs(RepositoryInterface::class)
            ->give(PermissionRepository::class);

        $this->app->when(StudentService::class)
            ->needs(RepositoryInterface::class)
            ->give(StudentRepository::class);

            
        $this->app->when(TeacherService::class)
            ->needs(RepositoryInterface::class)
            ->give(TeacherRepository::class);

            $this->app->when(ClassRoomService::class)
            ->needs(RepositoryInterface::class)
            ->give(ClassRoomRepository::class);

        // Binding service interfaces to their implementations
        $this->app->bind(LogErrorInterface::class, LogErrorService::class);
        $this->app->bind(CustomeMessageInterface::class, MessageService::class);

        // Binding RoleService and PermissionService
        // $this->app->bind(RoleService::class, RoleService::class);
        // $this->app->bind(PermissionService::class, PermissionService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
