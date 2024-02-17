<?php

namespace App\Repositories;

use App\Models\Member;
use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 *
 */
class MemberRepository implements RepositoryInterface
{
    /**
     * @param int $id
     * @param array $with
     * @return Model|Collection|Builder|array|null
     */
    public function getMemberById(int $id, array $with = []): Model|Collection|Builder|array|null
    {
        return Member::query()
            ->with($with)
            ->find($id);
    }

    /**
     * @return Collection
     */
    public function getAllMembers(): Collection
    {
        return Member::all();
    }
}
