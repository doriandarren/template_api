<?php

namespace Src\Api\Dev\Infrastructure\Controllers;



use App\Models\Abilities\Ability;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Src\Api\Shared\Domain\Enums\EnumUserPermissions;
use Src\Api\Shared\Infrastructure\Controllers\BaseController;



final class TestController extends BaseController
{





    /*********************************************************
     *
     * Busca los Tablas y columnas en Base datos
     *
     *********************************************************/
    public function __invokesdwdwdwd(Request $request)
    {


//        $columnNames = [
//            'customer_code',
//            'client_code',
//            'customer_parent'
//        ];



        $connections = [
            'api',
        ];

        foreach ($connections as $connection_name) {

            $connection = config("database.connections.{$connection_name}");
            $database = 'Tables_in_' . $connection['database'];
            $tables = DB::connection($connection_name)->select('SHOW TABLES');


            foreach ($tables as $k => $v) {

                $tableName = $v->{$database};

                if($tableName == 'users'){

                    echo $tableName . "<br>";

                    $columns = DB::connection($connection_name)
                        ->select("SELECT * FROM Information_Schema.Columns
                                    WHERE TABLE_NAME = '" . $tableName . "'"
                        );

                    echo "Hay " . count($columns) . " columnas en la tabla " . $tableName . "<br><br>";

                    $this->createLineString($columns, $tableName);

//                    $this->createMigrate($columns, $tableName);
//                    $this->createFormatToMigrate($columns, $tableName);


                    echo "<br><br>";

                }


            }
        }

    }



    private function createLineString($columns, $tableName)
    {

        foreach ($columns as $i => $column){
            echo $column->COLUMN_NAME . ' ';
            //echo "<br>";
        }

    }


    /*
    private function createMigrate($columns, $tableName)
    {


        $migrate = 'if (!Schema::hasTable(\'' . $tableName . '\')) {<br>';
        $migrate .= 'Schema::create(\'' . $tableName . '\', function (Blueprint $table) {<br>';


        foreach ($columns as $i => $column){


            if($column->DATA_TYPE == self::INT) {

                if($column->COLUMN_KEY == 'PRI') {
                    $migrate .= '$table->id()';
                }elseif($column->COLUMN_KEY == 'MUL'){
                    $migrate .= '$table->' . self::TO_UNSIGNEDBIGINT . '(\'' . $column->COLUMN_NAME . '\')';
                }else{
                    $migrate .= '$table->' . self::TO_BIGINTEGER . '(\'' . $column->COLUMN_NAME . '\')';
                }

            }elseif($column->DATA_TYPE == self::VARCHAR) {

                $migrate .= '$table->' . self::TO_STRING . '(\'' . $column->COLUMN_NAME . '\')';

            }elseif($column->DATA_TYPE == self::LONGTEXT){

                $migrate .= '$table->' . self::TO_LONGTEXT . '(\'' . $column->COLUMN_NAME . '\')';

            }elseif($column->DATA_TYPE == self::TINYINT){

                $migrate .= '$table->' . self::TO_TINYINT . '(\'' . $column->COLUMN_NAME . '\')';

            }elseif($column->DATA_TYPE == self::FLOAT){

                $migrate .= '$table->' . self::TO_FLOAT . '(\'' . $column->COLUMN_NAME . '\', 11, 2)';

            }elseif($column->DATA_TYPE == self::BIGINT){

                $migrate .= '$table->' . self::TO_BIGINT . '(\'' . $column->COLUMN_NAME . '\')';

            }elseif($column->DATA_TYPE == self::DOUBLE){

                $migrate .= '$table->' . self::TO_DOUBLE . '(\'' . $column->COLUMN_NAME . '\', 11, 2)';

            }else{
                $migrate .= '$table->' . $column->DATA_TYPE . '(\'' . $column->COLUMN_NAME . '\')';
            }





            //Is NULL
            if($column->IS_NULLABLE == 'YES'){
                $migrate .= '->nullable();<br>';
            }else{
                $migrate .= ';<br>';
            }

        }



        $migrate .= '<br>
                $table->timestamps();<br>
                $table->softDeletes();<br>
            });<br>
        }<br>
        ';



        echo $migrate;

    }


    private function createFormatToMigrate($columns, $tableName)
    {
        echo "<br><br>";

        foreach ($columns as $i => $column){

            echo '$customer->' . $column->COLUMN_NAME . ' = $customerOLD->'. $column->COLUMN_NAME . ';<br>';

        }

        echo '$customer->save();<br>';

    }

    */

    /**
     * END Busca los Tablas y columnas en Base datos
     */













    /*********************************************************
     *
     * PARA GENERAR ABILITIES
     *
     *********************************************************/

    // Crear para abstract class UserPermissions
    public function __invoke(Request $request)
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


        foreach ($connections as $connection_name) {

            $connection = config("database.connections.{$connection_name}");
            $database = 'Tables_in_' . $connection['database'];
            $tables = DB::connection($connection_name)->select('SHOW TABLES');

            foreach ($tables as $k => $v) {

                $tableName = $v->{$database};

                if(!in_array($tableName, $excludeTable)){

                    $modules = $this->createConstModulePrintScreen($tableName);

                    foreach ($modules as $module) {
                        $arrModule[] = $module;
                    }

                }

            }
        }


        echo "/**<br>";
        echo "* @return string[]<br>";
        echo "*/<br>";
        echo 'public static function getModules(): array<br>';
        echo '{<br>';
        echo 'return [<br>';

        foreach ($arrModule as $module) {
            echo 'self::' . $module . ',<br>';
        }

        echo '];<br>';
        echo '}<br>';


    }

    private function createConstModulePrintScreen($tableName)
    {

        //echo $tableName . "<br>";


        //$module = 'MODULE_' . strtoupper($tableName);
        $list = 'MODULE_' . strtoupper($tableName) . '_LIST';
        $store = 'MODULE_' . strtoupper($tableName) . '_STORE';
        $show = 'MODULE_' . strtoupper($tableName) . '_SHOW';
        $update = 'MODULE_' . strtoupper($tableName) . '_UPDATE';
        $destroy = 'MODULE_' . strtoupper($tableName) . '_DESTROY';


        echo '// ' . ucfirst($tableName) . "<br>";
        //echo 'const ' . $module . ' = \'' . $tableName . '\';' . "<br>";
        echo 'const ' . $list . ' = \'' . $tableName . '\' . EnumAbilitySuffix::LIST;' . "<br>";
        echo 'const ' . $store .' = \'' . $tableName . '\' . EnumAbilitySuffix::STORE;' . "<br>";
        echo 'const ' . $show . ' = \'' . $tableName . '\' . EnumAbilitySuffix::SHOW;' . "<br>";
        echo 'const ' . $update . ' = \'' . $tableName . '\' . EnumAbilitySuffix::UPDATE;' . "<br>";
        echo 'const ' . $destroy . ' = \'' . $tableName . '\' . EnumAbilitySuffix::DESTROY;' . "<br><br><br>";

        //return [$module, $list, $store, $show, $update, $destroy];
        return [$list, $store, $show, $update, $destroy];

    }






    //Guardar en DB
    public function index()
    {


        $alejandro = User::find(51);
//        $dorian = User::find(52);
//        $pedro = User::find(93);
//        $artur = User::find(13);
//        $alex = User::find(11);
//        $eze = User::find(45);



        foreach (EnumUserPermissions::getModules() as $module) {
            $this->createDBAbilities($module);
            $this->createModuleRoleAbilityByUser($alejandro, $module);
            //$this->createModuleRoleAbilityByUser($dorian, $module);
        }

        echo "Done!";

    }

    private function createDBAbilities($module)
    {

//        if(!Ability::where('name', $module)->exists() && !str_contains($module, ':')){
//            Ability::factory()->create([
//                'name' => $module,
//                'label' => 'Modulo Activo ' . strtoupper($module),
//            ]);
//        }

        if(!Ability::where('name', $module)->exists() && str_contains($module, 'list')){
            Ability::factory()->create([
                'name' => $module,
                'label' => 'Lista el modulo de ' . strtoupper(str_replace(':','_',$module)),
            ]);
        }

        if(!Ability::where('name', $module)->exists() && str_contains($module, 'store')){
            Ability::factory()->create([
                'name' => $module,
                'label' => 'Crea el modulo de ' . strtoupper(str_replace(':','_',$module)),
            ]);
        }
        if(!Ability::where('name', $module)->exists() && str_contains($module, 'update')){
            Ability::factory()->create([
                'name' => $module,
                'label' => 'Edita el modulo de ' . strtoupper(str_replace(':','_',$module)),
            ]);
        }
        if(!Ability::where('name', $module)->exists() && str_contains($module, 'show')){
            Ability::factory()->create([
                'name' => $module,
                'label' => 'Muestra el modulo de '. strtoupper(str_replace(':','_',$module)),
            ]);
        }
        if(!Ability::where('name', $module)->exists() && str_contains($module, 'destroy')){
            Ability::factory()->create([
                'name' => $module,
                'label' => 'Elimina el modulo de ' . strtoupper(str_replace(':','_',$module)),
            ]);
        }


    }


    private function createModuleRoleAbilityByUser($user, $module){

        // Create ability_role
        $abilityModule = Ability::where('name', $module)->first();

        $user->allowTo($abilityModule);

    }


    /**
     * END PARA GENERAR ABILITIES
     */







}
