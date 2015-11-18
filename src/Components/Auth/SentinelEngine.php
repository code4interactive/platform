<?php

namespace Code4\Platform\Components\Auth;

use Cartalyst\Sentinel\Sentinel;
use Code4\Platform\Contracts\Auth as AuthContract;

class SentinelEngine implements AuthContract {

    /**
     * @var Sentinel
     */
    protected $sentinel;

    /**
     * @var \Activation
     */
    protected $activation;

    public function __constructor(Sentinel $sentinel, \Activation $activation) {
        $this->sentinel = $sentinel;
        $this->activation = $activation;
    }

    public function login($userId, $remember = false) {
        $user = \Sentinel::findById($userId);
        return \Sentinel::login($user, $remember) ? $userId : false;
    }

    public function logout($userId = null, $flushSessions = false) {
        if (!is_null($userId)) {
            $user = \Sentinel::findById($userId);
        } else {
            $user = $userId;
        }
        \Sentinel::logout($user, $flushSessions);
    }

    public function authenticate($credentials, $remember = false, $login = true) {
        $user = \Sentinel::authenticate($credentials, $remember, $login);
        return $user ? $user->getUserId() : false;
    }

    public function addUser($credentials, $activate) {
        $user = \Sentinel::register($credentials, $activate);
        return $user->getUserId();
    }

    public function editUser($userId, $credentials) {
        $user = \Sentinel::getUserRepository()->findById($userId);
        \Sentinel::update($user, $credentials);
    }

    public function activateUser($userId, $activate = true) {
        $user = $this->sentinel->getUserRepository()->findById($userId);
        if ($activate)
        {
            if (!$this->activation->completed($user)) {

                /*if ($this->activation->exists($user)) {
                    $activation = $this->activation->exists($user);
                } else {
                    $activation = $this->activation->create($user);
                }*/
                $activation = $this->activation->exists($user) ? : $activation = $this->activation->create($user);

                $code = $activation->code;
                $this->activation->complete($user, $code);
            }

        } else {
            $this->activation->remove($user);
        }
    }

    public function addUserPermissions($userId, $permissions) {
        $user = \Sentinel::getUserRepository()->findById($userId);
        $user->permissions = $permissions;
        return $user->save();
    }

    /**
     * Add user to role
     * @param int $userId
     * @param int $roleId
     */
    public function addUserToRole($userId, $roleId) {
        $role = \Sentinel::findRoleById($roleId);
        $user = \Sentinel::getUserRepository()->findById($userId);
        $role->users()->attach($user);
    }

    /**
     * Delete user from role
     * @param int $userId
     * @param int $roleId
     */
    public function removeUserFromRole($userId, $roleId) {
        $user = \Sentinel::getUserRepository()->findById($userId);
        $user->roles()->detach($roleId);
    }

    /**
     * Sync user roles
     * @param int $userId
     * @param array $roleIds
     */
    public function syncUserRoles($userId, $roleIds) {
        $user = \Sentinel::getUserRepository()->findById($userId);
        $user->roles()->sync($roleIds);
    }

    public function hasAccess($permissions) {
        return \Sentinel::hasAccess($permissions);
    }

    public function guest() {
        return \Sentinel::guest();
    }

    public function getUser($userId = null) {
        if (is_null($userId)) {
            return \Sentinel::getUser();
        } else {
            return \Sentinel::getUserRepository()->findById($userId);
        }
    }

    public function currentUserId() {
        if ($user = \Sentinel::getUser())
        {
            return $user->getUserId();
        }
        return null;
    }

    /** NOT CONTRACTED METHODS **/
    public function getRolesModel() {
        return \Sentinel::getRoleRepository()->createModel();
    }

}