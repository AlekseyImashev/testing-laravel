<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['name', 'size'];

    /**
     * Add members to the team.
     *
     * @param string $users
     */
    public function add($users)
    {
        $this->guardAgainstTooManyMembers($users);

        $method = $users instanceof User ? 'save' : 'saveMany';

        $this->members()->$method($users);
    }

    /**
     * Remove member from the team.
     *
     * @param string $users
     */
    public function remove($users = null)
    {
        if ($users instanceof User) {
            return $users->leaveTeam();
        }

        return $this->removeMany($users);
    }

    /**
     * Remove many members from the team.
     *
     * @param string $users
     */
    public function removeMany($users)
    {
        $this->members()
             ->whereIn('id', $users->pluck('id'))
             ->update(['team_id' => null]);
    }

    /**
     * Remove all members from the team.
     */
    public function restart()
    {
        $this->members()->update(['team_id' => null]);
    }

    /**
     * Get all members for the team.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function members()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Count team members.
     *
     * @return int
     */
    public function count()
    {
        return $this->members()->count();
    }

    /**
     * Maximum size of team members.
     *
     * @return int
     */
    public function maximumSize()
    {
        return $this->size;
    }

    /**
     * Protection from the maximum number of team members.
     *
     * @param string $users
     */
    public function guardAgainstTooManyMembers($users)
    {
        $numUsersToAdd = ($users instanceof User) ? 1 : count($users);

        $newTeamCount = $this->count() + $numUsersToAdd;

        if ($newTeamCount > $this->maximumSize()) {
            throw new \Exception;
        }
    }
}
