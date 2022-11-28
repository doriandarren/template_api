<?php

namespace Src\Api\Shared\Domain\Enums;

class EnumUserPermissions
{

    // Abilities
    const MODULE_ABILITIES_LIST = 'abilities' . EnumAbilitySuffix::LIST;
    const MODULE_ABILITIES_STORE = 'abilities' . EnumAbilitySuffix::STORE;
    const MODULE_ABILITIES_SHOW = 'abilities' . EnumAbilitySuffix::SHOW;
    const MODULE_ABILITIES_UPDATE = 'abilities' . EnumAbilitySuffix::UPDATE;
    const MODULE_ABILITIES_DESTROY = 'abilities' . EnumAbilitySuffix::DESTROY;


// Ability_user
    const MODULE_ABILITY_USER_LIST = 'ability_user' . EnumAbilitySuffix::LIST;
    const MODULE_ABILITY_USER_STORE = 'ability_user' . EnumAbilitySuffix::STORE;
    const MODULE_ABILITY_USER_SHOW = 'ability_user' . EnumAbilitySuffix::SHOW;
    const MODULE_ABILITY_USER_UPDATE = 'ability_user' . EnumAbilitySuffix::UPDATE;
    const MODULE_ABILITY_USER_DESTROY = 'ability_user' . EnumAbilitySuffix::DESTROY;


// Role_user
    const MODULE_ROLE_USER_LIST = 'role_user' . EnumAbilitySuffix::LIST;
    const MODULE_ROLE_USER_STORE = 'role_user' . EnumAbilitySuffix::STORE;
    const MODULE_ROLE_USER_SHOW = 'role_user' . EnumAbilitySuffix::SHOW;
    const MODULE_ROLE_USER_UPDATE = 'role_user' . EnumAbilitySuffix::UPDATE;
    const MODULE_ROLE_USER_DESTROY = 'role_user' . EnumAbilitySuffix::DESTROY;


// Roles
    const MODULE_ROLES_LIST = 'roles' . EnumAbilitySuffix::LIST;
    const MODULE_ROLES_STORE = 'roles' . EnumAbilitySuffix::STORE;
    const MODULE_ROLES_SHOW = 'roles' . EnumAbilitySuffix::SHOW;
    const MODULE_ROLES_UPDATE = 'roles' . EnumAbilitySuffix::UPDATE;
    const MODULE_ROLES_DESTROY = 'roles' . EnumAbilitySuffix::DESTROY;


// User_statuses
    const MODULE_USER_STATUSES_LIST = 'user_statuses' . EnumAbilitySuffix::LIST;
    const MODULE_USER_STATUSES_STORE = 'user_statuses' . EnumAbilitySuffix::STORE;
    const MODULE_USER_STATUSES_SHOW = 'user_statuses' . EnumAbilitySuffix::SHOW;
    const MODULE_USER_STATUSES_UPDATE = 'user_statuses' . EnumAbilitySuffix::UPDATE;
    const MODULE_USER_STATUSES_DESTROY = 'user_statuses' . EnumAbilitySuffix::DESTROY;


// Users
    const MODULE_USERS_LIST = 'users' . EnumAbilitySuffix::LIST;
    const MODULE_USERS_STORE = 'users' . EnumAbilitySuffix::STORE;
    const MODULE_USERS_SHOW = 'users' . EnumAbilitySuffix::SHOW;
    const MODULE_USERS_UPDATE = 'users' . EnumAbilitySuffix::UPDATE;
    const MODULE_USERS_DESTROY = 'users' . EnumAbilitySuffix::DESTROY;


    /**
     * @return string[]
     */
    public static function getModules(): array
    {
        return [
            self::MODULE_ABILITIES_LIST,
            self::MODULE_ABILITIES_STORE,
            self::MODULE_ABILITIES_SHOW,
            self::MODULE_ABILITIES_UPDATE,
            self::MODULE_ABILITIES_DESTROY,
            self::MODULE_ABILITY_USER_LIST,
            self::MODULE_ABILITY_USER_STORE,
            self::MODULE_ABILITY_USER_SHOW,
            self::MODULE_ABILITY_USER_UPDATE,
            self::MODULE_ABILITY_USER_DESTROY,
            self::MODULE_ROLE_USER_LIST,
            self::MODULE_ROLE_USER_STORE,
            self::MODULE_ROLE_USER_SHOW,
            self::MODULE_ROLE_USER_UPDATE,
            self::MODULE_ROLE_USER_DESTROY,
            self::MODULE_ROLES_LIST,
            self::MODULE_ROLES_STORE,
            self::MODULE_ROLES_SHOW,
            self::MODULE_ROLES_UPDATE,
            self::MODULE_ROLES_DESTROY,
            self::MODULE_USER_STATUSES_LIST,
            self::MODULE_USER_STATUSES_STORE,
            self::MODULE_USER_STATUSES_SHOW,
            self::MODULE_USER_STATUSES_UPDATE,
            self::MODULE_USER_STATUSES_DESTROY,
            self::MODULE_USERS_LIST,
            self::MODULE_USERS_STORE,
            self::MODULE_USERS_SHOW,
            self::MODULE_USERS_UPDATE,
            self::MODULE_USERS_DESTROY,
        ];
    }

}
