<?php

namespace App\Http\Controllers;

class MoodleController extends Controller
{
    public function index()
    {
        return view('painel-admin.moodle.index');
    }

    public function service($id_suspended, $userid)
    {
        try {
            /*$userid         = $userid;
            $id_suspended   = $id_suspended;
            $result         = DB::connection('mysql2')->select('select userid from mdl_role_assignments where roleid in (2, 3, 4)');

            $count = [];

            for ($i = 0; $i < count($result); $i++) {
                if (!in_array($result[$i]->userid, $count)) {
                    $count[] = $result[$i]->userid;
                }
            }

            for ($i = 0; $i < count($count); $i++) {
                $id = $count[$i];
                DB::connection('mysql2')->update('update mdl_user set suspended = ' . $id_suspended . ' where id =' . $id . '');
                $user = DB::connection('mysql2')->select('select firstname, lastname, username, email, institution from mdl_user where id = ' . $id . '');
                $firstname      = $user[0]->firstname;
                $lastname       = $user[0]->lastname;
                $username       = $user[0]->username;
                $email          = $user[0]->email;
                $institution    = $user[0]->institution;

                $this->reports($userid, $username, $email, $institution, $firstname, $lastname);
            }*/
            return redirect()->route('moodle.index')->with('success', utf8_encode('Operação realizada com sucesso.'));

        } catch (\Throwable $th) {
            return redirect()->route('moodle.index')->with('error', utf8_encode('Erro desconhecido!'));
        }
    }

    public function lock()
    {
        $this->service(1, 1);
    }

    public function unlock()
    {
        $this->service(0, 0);
    }
}
