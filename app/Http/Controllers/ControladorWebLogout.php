<?php

namespace App\Http\Controllers;

use Session;

class ControladorWebLogout extends Controller
{
    public function logout()
    {
        Session::put("idcliente", "");
        return redirect("/");
    }
}
