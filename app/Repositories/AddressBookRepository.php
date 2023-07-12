<?php

namespace App\Repositories;

use App\Models\AddressBook;
use App\Interfaces\AddressBookRepositoryInterface;

class AddressBookRepository implements AddressBookRepositoryInterface
{
    public function getAllAddressBook ()
    {
        return AddressBook::all();
    }

    public function createAddressBook(array $addressbookDetails)
    {
        return AddressBook::create($addressbookDetails);
    }
}
