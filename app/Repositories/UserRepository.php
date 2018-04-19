<?php

namespace App\Repositories;

use App\User;

class UserRepository extends BaseRepository
{
    public function all()
    {
        $user = auth()->user();
        $q = User::orderBy($this->orderBy, $this->order);

        if ($user->isAdmin()) {
            if (!empty($user->cities)) {
                $q->whereRaw("cities::text LIKE '%\"{$user->cities[0]}\"%'");
            }
        }

        return $q;
    }

    /**
     * Save entity
     *
     * @param array $data
     * @param null $id
     * @return bool
     */
    public function save(array $data, $id = null)
    {
        $entity = User::findOrNew($id);
        $entity->name = $data['name'];
        $entity->email  = $data['email'];

        if (!empty($data['password'])) {
            $entity->password = bcrypt($data['password']);
        }
        $entity->roles  = [$data['roles']];
        $entity->cities  = [$data['cities']];

        return $entity->save();
    }
}