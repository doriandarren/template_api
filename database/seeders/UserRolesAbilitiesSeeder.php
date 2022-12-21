<?php

namespace Database\Seeders;


use App\Models\Abilities\Ability;
use App\Models\AbilityUsers\AbilityUser;
use App\Models\Roles\Role;
use App\Models\User;
use App\Models\UserStatuses\UserStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Src\Api\Shared\Domain\Enums\EnumAbilitySuffix;
use Src\Api\Shared\Domain\Enums\EnumUserPermissions;

class UserRolesAbilitiesSeeder extends Seeder
{

    /**************************
     * Setup
     **************************/

    // Admin
    const ADMIN_NAME = 'Admin';
    const ADMIN_EMAIL = 'webmaster@globalfleet.es';
    const ADMIN_PASSWORD = 'Fleet2022';

    // Manager
    const MANAGER_NAME = 'Artur';
    const MANAGER_EMAIL = 'artur@globaltank.eu';
    const MANAGER_PASSWORD = 'Fleet2022';

    // User
    const USER_NAME = 'Dorian';
    const USER_EMAIL = 'dorian.gonzalez@globaltank.eu';
    const USER_PASSWORD = 'Fleet2022';










    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /**
         * Create UserStatus
         */
        $this->createUserStatuses();


        /**
         * Create Roles
         */
        $this->createRoles();


        /**
         * Create Abilities
         */
        $this->createAbilities();


        /**
         * Create User
         */
        $this->createUser(self::ADMIN_NAME, self::ADMIN_EMAIL, self::ADMIN_PASSWORD,Role::ADMIN);

        $this->createUser(self::MANAGER_NAME, self::MANAGER_EMAIL, self::MANAGER_PASSWORD, Role::MANAGER);

        $this->createUser(self::USER_NAME, self::USER_EMAIL, self::USER_PASSWORD, Role::USER);


        /**
         * Add other User
         */
        User::factory(7)->create();



        /**
         * Create User All Abilities
         */
        $this->createAllAbilities(self::USER_NAME);



    }





    private function createUserStatuses()
    {

        //Create UserStatus
        $userStatuses = [
            UserStatus::STATUS_ACTIVE_NAME,
            UserStatus::STATUS_INACTIVE_NAME,
        ];

        foreach ($userStatuses as $userStatus) {
            if (!UserStatus::where('name', $userStatus)->exists()) {
                UserStatus::factory()->create(['name' => $userStatus]);
            }
        }

    }


    private function createRoles()
    {

        $roles = [
            Role::ADMIN,
            Role::MANAGER,
            Role::USER,
        ];

        foreach ($roles as $roleName) {
            if (!Role::where('name', $roleName)->exists()) {
                Role::factory()->create([
                    'name' => $roleName,
                    'description' => "Rol " . $roleName,
                ]);
            }
        }

    }






    private function createAbilities()
    {

        $excludeTable = [
            'migrations',
            'failed_jobs',
            'password_resets',
            'personal_access_tokens',
        ];

        $connections = [
            'api',
        ];

        $arrModule = [];


        if(!Ability::where('name', '*')->exists()){
            Ability::factory()->create([
                'name' => '*',
                'label' => 'Todos permisos',
            ]);
        }



        foreach ($connections as $connection_name) {

            $connection = config("database.connections.{$connection_name}");
            $database = 'Tables_in_' . $connection['database'];
            $tables = DB::connection($connection_name)->select('SHOW TABLES');

            foreach ($tables as $k => $v) {

                $tableName = $v->{$database};

                if(!in_array($tableName, $excludeTable)){

                    $this->createModuleAbilities($tableName);

                }

            }

        }


    }


    public function createModuleAbilities($tableName)
    {

        if(!Ability::where('name', $tableName.EnumAbilitySuffix::LIST)->exists()){
            Ability::factory()->create([
                'name' => $tableName.EnumAbilitySuffix::LIST,
                'label' => 'Crea modulo ' . strtoupper($tableName.EnumAbilitySuffix::LIST),
            ]);
        }

        if(!Ability::where('name', $tableName.EnumAbilitySuffix::STORE)->exists()){
            Ability::factory()->create([
                'name' => $tableName.EnumAbilitySuffix::STORE,
                'label' => 'Crea modulo ' . strtoupper($tableName.EnumAbilitySuffix::STORE),
            ]);
        }
        if(!Ability::where('name', $tableName.EnumAbilitySuffix::SHOW)->exists()){
            Ability::factory()->create([
                'name' => $tableName.EnumAbilitySuffix::SHOW,
                'label' => 'Ver modulo ' . strtoupper($tableName.EnumAbilitySuffix::SHOW),
            ]);
        }
        if(!Ability::where('name', $tableName.EnumAbilitySuffix::UPDATE)->exists()){
            Ability::factory()->create([
                'name' => $tableName.EnumAbilitySuffix::UPDATE,
                'label' => 'Edita modulo '. strtoupper($tableName.EnumAbilitySuffix::UPDATE),
            ]);
        }
        if(!Ability::where('name', $tableName.EnumAbilitySuffix::DESTROY)->exists()){
            Ability::factory()->create([
                'name' => $tableName.EnumAbilitySuffix::DESTROY,
                'label' => 'Elimina modulo ' . strtoupper($tableName.EnumAbilitySuffix::DESTROY),
            ]);
        }

    }






    private function createRoleUser($user, $roleName)
    {

        $user = User::find($user->id);

        if($roleName == Role::ADMIN){
            $role = Role::where('name', Role::ADMIN)->first();
            $user->assignRole($role);
        }


        if($roleName == Role::MANAGER){
            $role = Role::where('name', Role::MANAGER)->first();
            $user->assignRole($role);
        }


        if($roleName == Role::USER){
            $role = Role::where('name', Role::USER)->first();
            $user->assignRole($role);
        }


    }


    /**
     * @param $name
     * @param $email
     * @param $password
     * @param $roleName
     * @return void
     */
    private function createUser($name, $email, $password, $roleName)
    {

        // Create User
        $userActiveId = UserStatus::where('name', UserStatus::STATUS_ACTIVE_NAME)->first()->id;


        $user = User::where('email', $email)->first();
        if (!$user) {
            $user = User::factory()->create([
                'name' => $name,
                'email' => $email,
                'email_verified_at' => now(),
                'password' => bcrypt($password), // password
                'remember_token' => NULL,
                'user_status_id' => $userActiveId,
            ]);
        }


        // Crete RoleUser
        $this->createRoleUser($user, $roleName);



        if($roleName == Role::MANAGER){

            // Create ability_role
            $abilityList = Ability::where('name', EnumUserPermissions::MODULE_ABILITIES_LIST)->first();
            $abilityStore = Ability::where('name', EnumUserPermissions::MODULE_ABILITIES_STORE)->first();
            $abilityShow = Ability::where('name', EnumUserPermissions::MODULE_ABILITIES_SHOW)->first();
            $abilityUpdate = Ability::where('name', EnumUserPermissions::MODULE_ABILITIES_UPDATE)->first();
            $abilityDelete = Ability::where('name', EnumUserPermissions::MODULE_ABILITIES_DESTROY)->first();

            $user->allowTo($abilityList);
            $user->allowTo($abilityStore);
            $user->allowTo($abilityShow);
            $user->allowTo($abilityUpdate);
            $user->allowTo($abilityDelete);

        }


    }



    /**
     *
     * Create All Abilities
     *
     * @param $name
     * @return void
     */
    private function createAllAbilities($name)
    {

        $user = User::where('name', $name)->first();

        $abilities = Ability::where('id', '>', 1)->get();


        foreach ($abilities as $ability) {

            AbilityUser::factory()->create([
                'user_id' => $user->id,
                'ability_id' => $ability->id,
            ]);

        }

    }



}
