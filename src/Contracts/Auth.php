<?php

namespace Code4\Platform\Contracts;

interface Auth {

    /**
     * @param $userId
     * @param $remember
     * @return bool|int UserId or false
     */
    public function login($userId, $remember);

    /**
     * @param int|null $userId
     * @param bool $flushSessions
     */
    public function logout($userId, $flushSessions);

    /**
     * @param array $credentials
     * @param bool $remember
     * @param bool $login
     * @return bool|int User Id or false
     */
    public function authenticate($credentials, $remember, $login = true);

    /**
     * @param array $data
     * @param mixed|null $activate
     * @return int User ID
     */
    public function addUser($data, $activate);

    /**
     * @param int $userId
     * @param array $data
     * @return bool
     */
    public function editUser($userId, $data);

    /**
     * Activates user
     * @param int $userId
     * @param bool $activate
     */
    public function activateUser($userId, $activate);

    /**
     * Adds permissions to user
     * @param int $userId
     * @param array $permissions
     * @return bool
     */
    public function addUserPermissions($userId, $permissions);

    /**
     * Checks if user is logged in
     * @return bool
     */
    public function check();

    //public function deleteUser($userId);

    //public function addRole($roleName, $permissions);

    //public function modifyRole($roleId, $permissions);

    //public function deleteRole($roleId);

    /**
     * @param int $userId
     * @param int $roleId
     */
    public function addUserToRole($userId, $roleId);

    /**
     * @param int $userId
     * @param int $roleId
     */
    public function removeUserFromRole($userId, $roleId);

    /**
     * Sync user roles
     * @param int $userId
     * @param array $roleIds
     */
    public function syncUserRoles($userId, $roleIds);

    /**
     * Checks user permissions
     * @param int $userId
     * @param array|string $permissions
     * @return bool
     */
    public function hasAccess($permissions);

    /**
     * Gets current user id
     * @return int|false
     */
    public function currentUserId();

    /**
     * Check if request is from guest (not logged in)
     * @return bool
     */
    public function guest();


}