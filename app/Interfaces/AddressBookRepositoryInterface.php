<?php

namespace App\Interfaces;

interface AddressBookRepositoryInterface
{
    public function getAllAddressBook();
    public function createAddressBook(array $addressbookDetails);
}
