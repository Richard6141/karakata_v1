<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use PhpParser\Node\Expr\Cast\Object_;

class UserRepository implements UserRepositoryInterface
{
    public function getAllUsers(): Object
    {
        return User::all();
    }

    public function getUserByDate(string $date): Object
    {
        return User::where(User::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"), $date)->get();
    }

    public function getUserById(string $userId): Object
    {
        return User::findOrFail($userId);
    }

    public function UserPerDate(): Object
    {
        $users = User::all();
        return $users->groupBy(function ($item) {
            return $item->created_at->format('Y-m-d');
        });
    }

    public function UserPerMonth(): Object
    {
        $users = User::all();
        return $users->groupBy(function ($item) {
            return $item->created_at->format('Y-m');
        });
    }

    public function getUsersByPeriod(Object $data): Object
    {
        $users = User::whereBetween('created_at', [$data->startDate, $data->endDate])->get();
        return $users = $users->groupBy(function ($item) {
            return $item->created_at->format('Y-m-d');
        });
    }
}
