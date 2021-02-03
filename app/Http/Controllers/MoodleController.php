<?php

namespace App\Http\Controllers;

use App\Models\ListIgnore;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MoodleController extends Controller
{
    public function service($id_suspended, $userid)
    {
        try {
            $userid         = $userid;
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
            }

            $result2        = DB::connection('mysql3')->select('select userid from mdl_role_assignments where roleid in (2, 3, 4)');

            $count2 = [];

            for ($i = 0; $i < count($result2); $i++) {
                if (!in_array($result2[$i]->userid, $count)) {
                    $count2[] = $result2[$i]->userid;
                }
            }

            for ($i = 0; $i < count($count2); $i++) {
                $id = $count2[$i];

                DB::connection('mysql3')->update('update mdl_user set suspended = ' . $id_suspended . ' where id =' . $id . '');
                $user2 = DB::connection('mysql3')->select('select firstname, lastname, username, email, institution from mdl_user where id = ' . $id . '');

                $firstname2      = $user2[0]->firstname;
                $lastname2       = $user2[0]->lastname;
                $username2       = $user2[0]->username;
                $email2          = $user2[0]->email;
                $institution2    = $user2[0]->institution;

                $this->reports($userid, $username2, $email2, $institution2, $firstname2, $lastname2);
            }

            return redirect()->route('moodle.index')->with('success', utf8_encode('Operação realizada com sucesso.'));
        } catch (\Throwable $th) {
            return redirect()->route('moodle.index')->with('error', utf8_encode('Erro desconhecido!'));
        }
    }

    public function lock()
    {
        return $this->service(1, 1);
    }

    public function unlock()
    {
        return $this->service(0, 0);
    }

    public function reports($userid, $username, $email, $institution, $firstname, $lastname)
    {
        try {
            $userid         = $userid;
            $username       = $username;
            $email          = $email;
            $institution    = $institution;
            $firstname      = $firstname;
            $lastname       = $lastname;

            $timezone   = new DateTimeZone('America/Sao_Paulo');
            $time       = new DateTime('now', $timezone);
            $time2      = date_format($time, 'Y/m/d H:i:s');

            DB::insert('insert into reports (userid,username, time, email, institution, firstname, lastname) values ( ?,?,?,?,?,?,?)', [
                $userid,
                $username,
                $time2,
                $email,
                $institution,
                $firstname,
                $lastname

            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function viewReports()
    {
        try {
            $results = DB::table('reports')->get();

            foreach ($results as $result) {
                $time = new DateTime($result->time);
                $time2 = date_format($time, 'd/m/Y H:i:s');
                $result->time = $time2;
            }

            return view('painel-admin.moodle.index', ['results' => $results]);
        } catch (\Throwable $th) {
            return redirect()->route('admin.index')->with('error', utf8_encode('Erro desconhecido!'));
        }
    }

    public function listIgnoreA(){
       
       $users = DB::connection('mysql2')->select('select id, username, firstname, lastname, email from mdl_user');

       return view('painel-admin.moodle.users', ['results' => $users, 'moodle' => 'A']);
    }
    public function listIgnoreB(){
       
       $users = DB::connection('mysql3')->select('select id, username, firstname, lastname, email from mdl_user');

       return view('painel-admin.moodle.users', ['results' => $users, 'moodle' => 'B']);
    }

    public function addIgnore(Request $request){
       
        $list = new ListIgnore();

        $list->id_user = $request->user_id;
        $list->username = $request->username;
        $list->firstname = $request->firstname;
        $list->lastname = $request->lastname;
        $list->email = $request->email;
        $list->moodle = $request->moodle;

        $list->save();

        
        $users = DB::connection('mysql2')->select('select id, username, firstname, lastname, email from mdl_user');

        return view('painel-admin.moodle.users', ['results' => $users, 'moodle' => $request->moodle]);
    }

    public function list(){

        $list = ListIgnore::orderby('id', 'desc')->get();

        return view('painel-admin.moodle.lista-users', ['results' => $list]);
    }

    public function listDelete($id){

        $item = ListIgnore::find($id);
        
       $item->delete();

      
        $list = ListIgnore::orderby('id', 'desc')->get();

        return view('painel-admin.moodle.lista-users', ['results' => $list]);
    }


}