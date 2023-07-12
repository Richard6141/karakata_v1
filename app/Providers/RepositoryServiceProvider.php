<?php

namespace App\Providers;
use App\Repositories\UserRepository;
use App\Repositories\OrderRepository;
use App\Repositories\PaquetRepository;
use App\Repositories\SourceRepository;
use App\Repositories\CompanyRepository;
use App\Repositories\DeliverRepository;
use App\Repositories\PaymentRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\ContenirRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\ParticularRepository;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\AddressBookRepository;
use App\Interfaces\OrderRepositoryInterface;
use App\Interfaces\PaquetRepositoryInterface;
use App\Interfaces\SourceRepositoryInterface;
use App\Interfaces\CompanyRepositoryInterface;
use App\Interfaces\DeliverRepositoryInterface;
use App\Interfaces\PaymentRepositoryInterface;
use App\Interfaces\ContenirRepositoryInterface;
use App\Interfaces\CustomerRepositoryInterface;
use App\Interfaces\ParticularRepositoryInterface;
use App\Interfaces\AddressBookRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(DeliverRepositoryInterface::class, DeliverRepository::class);
        $this->app->bind(CustomerRepositoryInterface::class, CustomerRepository::class);
        $this->app->bind(PaquetRepositoryInterface::class, PaquetRepository::class);
        $this->app->bind(SourceRepositoryInterface::class, SourceRepository::class);
        $this->app->bind(ParticularRepositoryInterface::class, ParticularRepository::class);
        $this->app->bind(CompanyRepositoryInterface::class, CompanyRepository::class);
        $this->app->bind(AddressBookRepositoryInterface::class, AddressBookRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class);
        $this->app->bind(ContenirRepositoryInterface::class, ContenirRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
